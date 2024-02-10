<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the shop DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ( ! app()->isProduction()) {
            $this->info('Refreshing the shop DB...');
            Storage::deleteDirectory('images/products');
            Storage::makeDirectory('images/products');
            $this->call('migrate:fresh', ['--seed' => true]);
            $this->info('Finished refreshing the shop DB.');

            return self::SUCCESS;
        }

        $this->error('You are not allowed to refresh the shop DB in production.');

        return self::FAILURE;
    }
}
