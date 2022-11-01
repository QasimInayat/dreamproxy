<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;

class ServerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $server = new Server();
        $server->protocol = 'http';
        $server->address = '94.33.53.6';
        $server->port = 8888;
        $server->status = 'ENABLED';
        $server->save();
    }
}
