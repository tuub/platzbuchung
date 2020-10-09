<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class InitApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platzbuchung:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if (getenv('ADMIN_USER') && getenv('ADMIN_PASSWORD')) {
            $this->info('Admin User set.');
            $user = User::create([
                'username' => getenv('ADMIN_USER'),
                'barcode' => 'xxx'
            ]);
        }
    }
}
