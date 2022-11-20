<?php

namespace App\Http\Controllers;

use App\Models\Modem;
use App\Models\User;
use App\Models\UsersModem;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeController extends Controller
{

    /**
     * @return void
     */
    public function handle()
    {

        echo "OK";
        die();

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, env('STRIPE_SECRET_KEY')
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'invoice.finalized':
                $this->invoiceFinalized($event->data->object);
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }

    /**
     * @param object $data
     * @return bool|void
     */
    private function invoiceFinalized(object $data)
    {

        // @todo fare la fattura
        $buyedProduct = $data->lines->data[0];
        $buyedDays =  $data->lines->data[0]->price->metadata['days'];

        // Recupero l'utente
        $user = User::where('customer_id', $data->customer)->firstOrFail();

        // Cerco un modem disponibile
        $availableModems = Modem::getAvailableModem($buyedProduct->quantity);

        // Nessun modem disponibile, mando una mail di warning
        if (!$availableModems) {
            Mail::send('emails.noModemAvailable', [
                'user_id' => $user->id,
                'product' => $buyedProduct, // @todo
                'days' => $buyedDays // @todo
            ], function($m) {
                $m->from('noreply@dreamproxy.it');
            });
            return true;
        }

        // Eseguo il delivery dei modem comprati, impostando la scadenza
        for($i=0;$i<$buyedProduct->quantity;$i++) {

            /** @var Modem $availableModem */
            $availableModem = $availableModems[$i];

            // Recupero l'indirizzo ip del modem

            $userModem = new UsersModem();
            $userModem->user_id = $user->id;
            $userModem->modem_id = $availableModem->id;
            $userModem->username = 'dreamproxy-'.$availableModem->id.'-' . $user->id;
            $userModem->password = Crypt::encrypt(Str::random(8));
            $userModem->lastIpChange = Carbon::now();
            $userModem->current_ip = ''; //@todo fare e chiamare script per recupero ip esterno
            $userModem->expire_date = Carbon::now()->addDays($buyedDays);
            $userModem->save();
        }

        // @todo mail di ringraziamento utente

    }

    /**
     * @return Application|ResponseFactory|Response
     * @throws ApiErrorException
     */
    public function createSetupIntent()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        $setupIntent = $stripe->setupIntents->create([
            'customer' => Auth::user()->stripe_customer_id,
            'payment_method_types' => ['card']
        ]);

        return response([
            'setup_intent' => $setupIntent->client_secret
        ]);
    }

}
