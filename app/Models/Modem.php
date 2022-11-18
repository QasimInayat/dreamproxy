<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modem extends Model
{
    use HasFactory;

    function server()
    {
        return $this->hasOne(Server::class, 'id', 'server_id');
    }

    /**
     * @param Modem $modem
     * @return boolean | object
     * @throws GuzzleException
     */
    static function changeIp(Modem $modem)
    {

        $httpUrl = sprintf('%s://%s:%s/cgi-bin/changeip.cgi?modemid=%s&apn=%s&iptype=%s&bands=%s',
            $modem->server->protocol,
            $modem->server->address,
            $modem->server->port,
            $modem->modem_id,
            $modem->apn == '--' ? '' : $modem->apn,
            $modem->ip_type == '--' ? 'ipv4' : $modem->ip_type,
            !empty($modem->bands) ? implode("%20", json_decode($modem->bands)) : null
        );

        $client = new Client();
        $response = $client->request('GET', $httpUrl);
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            return false;
        }

        return json_decode($response->getBody());
    }

    /**
     * @param Modem $modem
     * @return bool | object
     * @throws GuzzleException
     */
    static function getPublicIp(Modem $modem)
    {
        $httpUrl = sprintf('%s://%s:%s/cgi-bin/getPublicIp.cgi?wwan=%s',
            $modem->server->protocol,
            $modem->server->address,
            $modem->server->port,
            $modem->port,
        );

        print_r($httpUrl);
        die();

        $client = new Client();
        $response = $client->request('GET', $httpUrl);
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            return false;
        }

        return json_decode($response->getBody());
    }

    /**
     * @param $quantity
     * @return false | array
     */
    public static function getAvailableModem($quantity)
    {
        $availableModem = Modem::where('available', true)
            ->leftJoin('users_modem', 'modems.id', 'users_modem.modem_id')
            ->whereNull('users_modem.id')
            ->limit($quantity)
            ->get();

        // Fallisce nel caso in cui non trovo la quantita' minima che mi serve
        if (count($availableModem) != $quantity) return false;

        // Se trovo la quantita' minimia esco con i modem trovati
        return $availableModem;
    }

    /**
     * @param $interface
     * @return int
     * @throws \Exception
     */
    public static function getPortFromWanInterface($interface): int
    {
        switch ($interface) {
            case 'wwan0':
                return 8000;
            case 'wwan1':
                return 8001;
            case 'wwan2':
                return 8002;
            case 'wwan3':
                return 8003;
            case 'wwan4':
                return 8004;
            case 'wwan5':
                return 8005;
            case 'wwan6':
                return 8006;
            case 'wwan7':
                return 8007;
            case 'wwan8':
                return 8008;
            case 'wwan9':
                return 8009;
            default:
                throw new \Exception("invalid wan port");
        }
    }
}
