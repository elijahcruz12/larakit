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
        {--a|all: Make the installer use both composer and npm}';

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

        if(!$this->option('composer') && !$this->option('npm') && !$this->option('all')){
            $composer = $this->ask('Does the installer require composer?');
            $npm = $this->ask('Does the installer require npm?');
        }
        else {
            $composer = $this->option('composer');
            $npm = $this->option('npm');
            if($this->option('all')){
                $composer = true;
                $npm = true;
            }
        }

        if($composer && $npm){
            $this->error('NPM Installs not ready just yet.');
            return Command::FAILURE;
        }
        elseif($composer && !$npm){
            $composer_stub = get_file_content(base_path('/stubs/installer/composer_installer.stub'));
            $composer_stub = str_replace('dummy-name', $name, $composer_stub);

            $nameToCamel = Str::camel($name);
            $filename = 'Install' . $nameToCamel . 'Command.php';
            file_put_contents(base_path('/app/Commands/' . $filename));
        }
        elseif(!$composer && $npm){
            $this->error('NPM Installs not ready just yet.');
            return Command::FAILURE;
        }
        else {
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
