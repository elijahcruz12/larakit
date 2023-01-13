<?php

namespace App\Commands;

use Larakit\ComposerUsage;
use LaravelZero\Framework\Commands\Command;

class InstallHorizonCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:horizon';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs Laravel Horizon to the Laravel application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'laravel/horizon';

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
