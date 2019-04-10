<?php

namespace App\Console;

use App\ArmyCostRankAllowance;
use App\ArmyRank;
use App\Faction;
use App\Unit;
use App\UnitUpgradeSlot;
use App\UpgradeType;
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
            Faction::prime_database();

            $upgrade_type_array = json_decode(file_get_contents(storage_path() . '/json/upgrade-types.json'), true);
            UpgradeType::prime_database($upgrade_type_array);

            $ranks_array = json_decode(file_get_contents(storage_path() . '/json/ranks.json'), true);
            ArmyRank::prime_database($ranks_array);

            $units_array = json_decode(file_get_contents(storage_path() . '/json/units.json'), true);
            // Split out the upgrade slots from the unit
            $unit_upgrade_slots = [];
            foreach ($units_array as $index => $unit_data) {
                $unit_upgrade_slots[] = ['unit_id' => $index + 1, 'upgrade_slots' => $unit_data['upgrade_slots']];
                unset($unit_data['upgrade_slots']);
            }
            Unit::prime_database($units_array);
            UnitUpgradeSlot::prime_database($unit_upgrade_slots);

            ArmyCostRankAllowance::primeDatabase();

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
