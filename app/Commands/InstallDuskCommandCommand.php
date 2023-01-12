<?php

namespace DummyNamespace;

use Illuminate\Console\Scheduling\Schedule;
use Larakit\RunProcess;
use LaravelZero\Framework\Commands\Command;
use Larakit\ComposerUsage;

class InstallDuskCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:dusk';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs Laravel Dusk to the Laravel application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'laravel/dusk';

        $dev = true;

                $this->comment('Checking to see if package is already required...');

                $exists = ComposerUsage::check($package);

                if ($exists) {
                    $this->error('Package already exists, returning...');

                    return Command::SUCCESS;
                }

                $this->comment('Installing ' . $package . '...');

                $output = ComposerUsage::require($package, $dev);

                $this->info($output);

                $this->comment($package . ' installed successfully.');

                $command = ['php', 'artisan', 'breeze', 'install'];

                $this->info(RunProcess::run($command));

                return Command::SUCCESS;


    }
}
