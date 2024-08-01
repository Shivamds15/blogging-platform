<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'caches:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear various caches including cache, queue, config, view, and route caches in one go';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing cache...');
        $this->call('cache:clear');

        $this->info('Clearing config cache...');
        $this->call('config:clear');

        $this->info('Clearing queue cache...');
        $this->call('queue:flush');

        $this->info('Clearing view cache...');
        $this->call('view:clear');

        $this->info('Clearing route cache...');
        $this->call('route:clear');

        $this->info('All caches cleared successfully!');

        return 0;
    }
}
