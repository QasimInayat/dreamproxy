<?php

namespace App\Console\Commands;

use App\Models\Modem;
use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ModemActivate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modem:activate {modem_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attiva la connessione internet su uno specifico modem';

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
     * @return Application|ResponseFactory|Response|void
     */
    public function handle()
    {
        $modem = Modem::where('id', (int) $this->argument('modem_id'))->firstOrFail();
        if(!Modem::changeIp($modem)) {
            return response([
                'error' => 'An error occurred during the ip change. Try later'
            ], 403);
        };
    }
}
