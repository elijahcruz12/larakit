<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use LaravelZero\Framework\Commands\Command;

class MakeInstallerCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:installer
        {name : The name of the package}
        {--C|composer : Make the installer install the package via composer}
        {--N|npm : Make the installer install the package via NPM}
        {--A|all: Make the installer use both composer and npm}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates a new Installer Command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $composer = true;
        $npm = false;

        $this->info('NPM Installs are not ready yet.');

        if ($composer && $npm) {
            $this->error('NPM Installs not ready just yet.');

            return Command::FAILURE;
        } elseif ($composer && ! $npm) {
            $composer_stub = file_get_contents(base_path('/stubs/installer/composer_installer.stub'));
            $composer_stub = str_replace('dummy-name', $name, $composer_stub);

            $className = 'Install'.Str::ucfirst($name).'Command';

            $composer_stub = str_replace('DummyClass', $className, $composer_stub);

            $filename = $className.'.php';

            $file_location = base_path('/app/Commands/'.$filename);

            file_put_contents($file_location, $composer_stub);
            $this->info('Successfully created '.$filename.'.');
        } elseif (! $composer && $npm) {
            $this->error('NPM Installs not ready just yet.');

            return Command::FAILURE;
        } else {
            $this->error('You must select the type of installer or use the proper flag.');

            return Command::FAILURE;
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
}
