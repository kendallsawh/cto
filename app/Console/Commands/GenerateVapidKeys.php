<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Minishlink\WebPush\VAPID;

class GenerateVapidKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:vapid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates VAPID keys for web push notifications';

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
     */
    public function handle()
    {
        $keys = VAPID::createVapidKeys(); // Generate VAPID keys
        $this->info("Public Key: " . $keys['publicKey']);
        $this->info("Private Key: " . $keys['privateKey']);

        // Optionally, you can also set these directly in your .env file or save them somewhere else.
    
    }
}
