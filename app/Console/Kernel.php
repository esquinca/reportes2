<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
      Commands\estadoserver::class,
      Commands\bytesxdia::class,
      Commands\usuarioxdia::class,
      Commands\mostapxdia::class,
      Commands\roguedevices::class,
      Commands\wlanxdia::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->command('estado:server')->daily();
      $schedule->command('usuario:dia')->daily();
      $schedule->command('bytes:dia')->daily();
      $schedule->command('ap:dia')->daily();
      $schedule->command('wlan:dia')->daily();
      $schedule->command('rougue:mes')->monthly();
      //$schedule->command('survey:nps')->monthly(1,'1:00');
      $schedule->command('termination:nps')->daily();
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
