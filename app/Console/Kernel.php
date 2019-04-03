<?php

namespace App\Console;

use App\ArmyRank;
use App\Unit;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // TODO: Remove and allow editing for admin in frontend.
        $schedule->call(function() {
            $units_array = json_decode(file_get_contents(storage_path() . '/json/units.json'), true);
            Unit::prime_database($units_array);

            $ranks_array = json_decode(file_get_contents(storage_path() . '/json/ranks.json'), true);
            ArmyRank::prime_database($ranks_array);
        })->everyMinute()->name("import-units")->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
