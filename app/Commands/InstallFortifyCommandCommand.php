<?php

namespace DummyNamespace;

use Illuminate\Console\Scheduling\Schedule;
use Larakit\RunProcess;
use LaravelZero\Framework\Commands\Command;
use Larakit\ComposerUsage;

class InstallFortifyCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:fortify
        {--c|config : Installs the config file}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs ____ to the laravel application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'laravel/fortify';

        $dev = false;

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

                if($this->option('config')){
                    $this->info(RunProcess::run(['php', 'artisan', 'vendor:publish', '--provider="Laravel\Fortify\FortifyServiceProvider"']));
                }

                return Command::SUCCESS;
    }
}
