<?php

namespace App\Console\Commands;

use App\Models\Modem;
use App\Models\Server;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ModemUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modem:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiorna lo stato di tutti i modem di tutti i server collegati';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $serverList = Server::where('status', 'ENABLED')->get();
        foreach ($serverList as $server) {
            $serverInfo = $this->getServerInfo($server->protocol, $server->address, $server->port);

            foreach ($serverInfo as $modem) {

                // Determino il modem ID dal dbus-path
                $matches = [];
                $re = '/(\d+)(?!.*\d)/m';
                $modem_id = $modem['modem']['dbus-path'];
                preg_match($re, $modem_id, $matches);
                $modem_id = $matches[0];

                $device_identifier = $modem['modem']['generic']['device-identifier'];
                $imei = $modem['modem']['3gpp']['imei'];
                $operator_code = $modem['modem']['3gpp']['operator-code'];
                $operator_name = $modem['modem']['3gpp']['operator-name'];
                $model = $modem['modem']['generic']['model'];
                $signal_quality = $modem['modem']['generic']['signal-quality']['value'];
                $state = $modem['modem']['generic']['state'];
                $revision = $modem['modem']['generic']['revision'];
                $port = $modem['modem']['generic']['ports'][1];
                $port = explode(" ", $port)[0];
                $apn = $modem['modem']['3gpp']['eps']['initial-bearer']['settings']['apn'];
                $ipType = $modem['modem']['3gpp']['eps']['initial-bearer']['settings']['ip-type'];
                $password = $modem['modem']['3gpp']['eps']['initial-bearer']['settings']['password'];
                $username = $modem['modem']['3gpp']['eps']['initial-bearer']['settings']['user'];

                $modemInfo = Modem::where('device_identifier', $device_identifier)->first();
                if(!$modemInfo) {
                    $modemInfo = new Modem();
                    $modemInfo->device_identifier = $device_identifier;
                    $modemInfo->apn = '';
                    $modemInfo->bands = '';
                }

                $modemInfo->server_id = $server->id;
                $modemInfo->imei = $imei;
                $modemInfo->modem_id = $modem_id;
                $modemInfo->operator_code = $operator_code;
                $modemInfo->operator_name = $operator_name;
                $modemInfo->model = $model;
                $modemInfo->signal_quality = $signal_quality;
                $modemInfo->state = $state;
                $modemInfo->revision = $revision;
                $modemInfo->port = $port;
                $modemInfo->ip_type = $ipType;
                $modemInfo->password = $password;
                $modemInfo->username = $username;
                $modemInfo->last_seen = Carbon::now();

                // Se lo status è registered eseguo subito la connessione
                // ed aggiorno l'ip pubblico del modem al cliente
                if($state === 'registered') {
                    Modem::changeIp($modemInfo); // cambiando ip si connette :)
                    $modemInfo->state = 'connected';
                }

                $modemInfo->save();

            }
        }
        return 0;
    }

    /**
     * @param $protocol
     * @param $ipAddr
     * @param $port
     * @return array
     */
    private function getServerInfo($protocol, $ipAddr, $port) {
        $client = new Client();
        $response = $client->request('GET', sprintf("%s://%s:%s/%s",
            $protocol,
            $ipAddr,
            $port,
            'cgi-bin/aboutme.cgi'
        ));
        return json_decode($response->getBody(), true);
    }
}
