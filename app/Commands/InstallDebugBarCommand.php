<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Larakit\ComposerUsage;
use LaravelZero\Framework\Commands\Command;

class InstallDebugBarCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:debugbar';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs barryvdh\'s Laravel Debugbar';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'barryvdh/laravel-debugbar';

        $this->comment('Checking to see if package is already required...');

        $exists = ComposerUsage::check($package);

        if ($exists) {
            $this->error('Package already exists, returning...');

            return Command::SUCCESS;
        }

        $this->comment('Installing barryvdh/laravel-debugbar...');

        $output = ComposerUsage::require($package, true);

        $this->info($output);

        $this->comment('Barryvdh/laravel-debugbar installed successfully.');

        return Command::SUCCESS;
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
