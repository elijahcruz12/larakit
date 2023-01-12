<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class InstallListCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'install:list';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Lists all the items you can install via the "install" command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $composer_items = [
            ['debugbar', 'barryvdh/laravel-debugbar'],
            ['idehelper', 'barryvdh/laravel-ide-helper'],
            ['ide-helper', 'barryvdh/laravel-ide-helper'],
            ['livewire', 'livewire/livewire'],
        ];

        $this->info('Composer Installed Items');

        $this->table(['Command Name', 'Package Name'], $composer_items);
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
