<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modem extends Model
{
    use HasFactory;
    public $table = 'modem';

    function server() {
        return $this->hasOne(Server::class, 'id', 'server_id');
    }

    /**
     * @param Server $server
     * @param Modem $modem
     * @return boolean
     */
    static function changeIp(Modem $modem) {

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
}
