<?php

namespace App\Models;

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
     * @return boolean
     */
    static function changeIp(Modem $modem)
    {

        $httpUrl = sprintf('%s://%s:%s/cgi-bin/changeip.cgi?modemid=%s&apn=%s&wwan=%s&iptype=%s&bands=%s',
            $modem->server->protocol,
            $modem->server->address,
            $modem->server->port,
            $modem->modem_id,
            $modem->apn == '--' ? '' : $modem->apn,
            $modem->port,
            $modem->ip_type == '--' ? 'ipv4' : $modem->ip_type,
            implode("%20", json_decode($modem->bands))
        );

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $httpUrl);
        $statusCode = $response->getStatusCode();

        return $statusCode === 200;
    }

    /**
     * @param Modem $modem
     * @return bool
     * @throws GuzzleException
     */
    static function getPublicIp(Modem $modem)
    {
        $httpUrl = sprintf('%s://%s:%s/cgi-bin/getPublicIp.cgi?modemid=%s',
            $modem->server->protocol,
            $modem->server->address,
            $modem->server->port,
            $modem->modem_id,
        );

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $httpUrl);
        $statusCode = $response->getStatusCode();

        return $statusCode === 200;
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
}
