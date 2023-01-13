<?php

namespace App\Commands;

use Larakit\ComposerUsage;
use LaravelZero\Framework\Commands\Command;

class InstallCashierCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:cashier';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs Laravel Cashier to the Laravel application.
        {--p|paddle : Installs the Paddle version of Cashier}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'laravel/cashier';

        if ($this->option('paddle')) {
            $package = $package.'-paddle';
        }

        $dev = false;

        $this->comment('Checking to see if package is already required...');

        $exists = ComposerUsage::check($package);

        if ($exists) {
            $this->error('Package already exists, returning...');

            return Command::SUCCESS;
        }

        $this->comment('Installing '.$package.'...');

        $output = ComposerUsage::require($package, $dev);

        $this->info($output);

        $this->comment($package.' installed successfully.');

        return Command::SUCCESS;
    }
}
