<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Larakit\ComposerUsage;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Process;

class InstallIdeHelperCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:ide-helper
        {--run: Run the ide-helper}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs barryvdh\'s laravel-ide-helper command.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'barryvdh/laravel-ide-helper';

        $this->comment('Checking to see if package is already required...');

        $exists = ComposerUsage::check($package);

        if ($exists) {
            $this->error('Package already exists, returning...');

            return Command::SUCCESS;
        }

        $this->comment('Installing barryvdh/laravel-ide-helper...');

        $output = ComposerUsage::require($package, true);

        $this->info($output);

        $this->comment('barryvdh/laravel-ide-helper installed successfully.');

        if ($this->option('run')) {
            $this->comment('Running the ide-helper commands');
            $firstProcess = new Process(['php', 'artisan', 'ide-helper:generate']);
            $firstProcess->run();
            $this->info($firstProcess->getOutput());

            $secondProcess = new Process(['php', 'artisan', 'ide-helper:meta']);
            $secondProcess->run();
            $this->info($secondProcess->getOutput());

            $thirdProcess = new Process(['php', 'artisan', 'ide-helper:meta', '-N']);
            $thirdProcess->run();
            $this->info($thirdProcess->getOutput());
        }

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
