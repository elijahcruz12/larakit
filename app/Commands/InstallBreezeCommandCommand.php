<?php

namespace DummyNamespace;

use Illuminate\Console\Scheduling\Schedule;
use Larakit\RunProcess;
use LaravelZero\Framework\Commands\Command;
use Larakit\ComposerUsage;

class InstallBreezeCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:breeze
        {--dark : Adds dark mode support to Breeze}
        {--vue : Adds Vue to Breeze}
        {--react: Adds React to Breeze}
        {--ssr: Adds Inertia SSR support to Breeze}
        {--api: Scaffolds an authentication API for breeze}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Installs Laravel Breeze to the Laravel application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $package = 'laravel/breeze';

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

                $command = ['php', 'artisan', 'breeze:install'];

                if($this->option('react')){
                    $command[] = 'react';
                }
                if($this->option('vue')) {
                    $command[] = 'vue';
                }
                if($this->option('api')){
                    $command[] = 'api';
                }

                if($this->option('dark')){
                    $command[]= '--dark';
                }

                if($this->option('ssr')) {
                    $command[] = '--ssr';
                }

                $this->info(RunProcess::run($command));


                $this->comment($package . ' installed successfully.');

                return Command::SUCCESS;
    }
}
