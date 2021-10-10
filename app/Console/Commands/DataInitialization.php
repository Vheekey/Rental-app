<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DataInitialization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Migration and Data for Initialization';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $this->info('All necessary migrations and seeders completed successfully');
    }
}
