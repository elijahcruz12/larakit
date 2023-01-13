<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Larakit\ComposerUsage;
use LaravelZero\Framework\Commands\Command;

class InstallLivewireCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:livewire
        {--view : Creates a base layouts.app file with boilerplate code.}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs Laravel Livewire';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'livewire/livewire';

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

        if ($this->option('view')) {
            // Get the app.blade.stub file
            $stub = file_get_contents(base_path('stubs/installer/composer_installer.stub'));

            Storage::makeDirectory(getcwd().'/resources/views/layouts');

            // Replace the view with the stub
            File::put(getcwd().'/resources/views/layouts/app.blade.php', $stub);
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
