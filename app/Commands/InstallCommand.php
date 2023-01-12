<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    private string $package = '';

    private bool $dev = false;

    private bool $isComposer = true;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install
        {name : The name of what you want to install}
        {--force : Force the operation to run even if}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installed packages for your projects';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        switch ($name) {
            case 'debugbar':
                $this->package = 'barryvdh/laravel-debugbar';
                $this->dev = true;
                break;
            case 'ide-helper':
            case 'idehelper':
                $this->package = 'barryvdh/laravel-ide-helper';
                $this->dev = true;
                break;
            case 'livewire':
                $this->package = 'livewire/livewire';
                $this->dev = false;
                break;
        }
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

    /**
     * Checks to see if the package is already installed via Composer
     *
     * @param  string|null  $package
     * @return bool
     */
    private function check_composer(string $package = null): bool
    {
        $process = new Process(['composer', 'show']);
        $process->run();

        $output = $process->getOutput();

        return strpos($output, $package) !== false;
    }

    /**
     * Installed the selected Composer Package
     *
     * @return bool
     */
    private function installComposerPackage(): bool
    {
        $exists = $this->check_composer($this->package);

        if ($exists) {
            return false;
        }

        $command = ['composer', 'require'];
        if ($this->dev) {
            $command[] = '--dev';
        }
        $command[] = $this->package;
        $this->info('Running: '.implode(' ', $command));
        $process = new Process($command);
        $process->run();
        $this->info($process->getOutput());

        return true;
    }
}
