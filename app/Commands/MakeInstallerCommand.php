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
        {--N|npm : Make the installer install the package via NPM}';

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

        $composer = $this->option('composer');
        $npm = $this->option('npm');

        if ($composer && $npm) {
            $this->error('Package installer cannot install more than one package at a time yet.');

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
            $npm_stub = file_get_contents(base_path('/stubs/installer/npm_installer.stub'));
            $npm_stub = str_replace('dummy-name', $name, $npm_stub);
            $className = 'Install'.Str::ucfirst($name).'Command';

            $npm_stub = str_replace('DummyClass', $className, $npm_stub);

            $filename = $className.'.php';

            $file_location = base_path('/app/Commands/'.$filename);

            file_put_contents($file_location, $npm_stub);
            $this->info('Successfully created '.$filename.'.');
        } else {
            $this->error('You must select the type of installer or use the proper flag.');

            return Command::FAILURE;
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
