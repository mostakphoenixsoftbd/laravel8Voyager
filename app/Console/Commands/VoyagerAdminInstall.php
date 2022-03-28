<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VoyagerAdminInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyageradmin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install custom dummy data';

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
    public function handle(){

        if ($this->confirm('This will delete all current data, Are yo sure?'))
        {
            // return 0;
            $this->call('migrate:fresh',[
                '--seed' => true,
            ]);
            $this->call('db:seed', [
                '--class' => 'voyagerDatabaseSeeder'
            ]);

            $this->call('db:seed', [
                '--class' => 'voyagerDummyDatabaseSeeder'
            ]);
            
            $this->call('db:seed', [
                '--class' => 'MenuItemsTableSeederCustom'
            ]);
            $this->info('Dummy data has been inserted');
        }
        // $this->info('Nothing has been changed.');

    }
}
