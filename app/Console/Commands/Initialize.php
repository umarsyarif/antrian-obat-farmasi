<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Initialize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate database and run websockets';

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
     * @return mixed
     */
    public function handle()
    {
        Artisan::command('migrate:fresh', function () {
            $this->info("Migrate fresh!");
        });
        Artisan::command('websockets:serve', function () {
            $this->info("Websockets served!");
        });
    }
}
