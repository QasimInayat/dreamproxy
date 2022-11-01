<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Stripe\Customer;
use Stripe\StripeClient;

class BillingController extends Controller
{

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function save(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'surname' => 'string|required',
            'company' => 'string|required',
            'address' => 'string|required',
            'country_id' => 'required|exists:countries,id',
            'city' => 'string|required',
            'postal_code' => 'numeric|required',
            'province_id' => ['exists:provinces,id', Rule::requiredIf(function() use ($request) {
                return $request->input('country') == 110;
            })],
            'vat' => 'string|required',
            'fiscal_code' => 'string|nullable',
            'unique_code' => ['string', Rule::requiredIf(function() use ($request) {
                // Se cliente italiano, obbligatorio almeno uno tra unique_code o pec
                if($request->input('country') == 110 && empty($request->input('pec'))) {
                    return true;
                }
                // per tutti gli altri non obbligatorio
                return false;
            })],
            'pec' => ['string', Rule::requiredIf(function() use ($request) {
                // Se cliente italiano, obbligatorio almeno uno tra unique_code o pec
                if($request->input('country') == 110 && empty($request->input('unique_code'))) {
                    return true;
                }
                // per tutti gli altri non obbligatorio
                return false;
            })],
        ]);

        $billing = Billing::where('user_id', Auth::id())->first();
        if(!$billing) {
            $billing = new Billing();
            $billing->user_id = Auth::id();
        }

        $billing->name = $request->input('name');
        $billing->surname = $request->input('surname');
        $billing->company = $request->input('company');
        $billing->address = $request->input('address');
        $billing->country_id = $request->input('country_id');
        $billing->city = $request->input('city');
        $billing->province_id = $request->input('province_id') ?? null;
        $billing->postal_code = $request->input('postal_code') ?? null;
        $billing->vat = $request->input('vat');
        $billing->fiscal_code = $request->input('fiscal_code') ?? null;
        $billing->pec = $request->input('pec') ?? null;
        $billing->unique_code = $request->input('unique_code') ?? null;
        $billing->save();

        // Se non ho ancora il customer_id di stripe lo creo
        $user = Auth::user();
        if(empty($user->stripe_customer_id)) {
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
            $stripeCustomer = $stripe->customers->create([
                'email' => $user->email
            ]);
            $user->stripe_customer_id = $stripeCustomer->id;
            $user->update();
        }

        return response(['status' => 'ok']);

    }

    /**
     * @return Application|ResponseFactory|Response
     */
    function get(){
        $billing = Billing::where('user_id', Auth::id())->with('country')->with('province')->first();
        return response($billing);
    }
}
