<?php

namespace App\Console;

use App\Console\Commands\CmdSendEmailTemplate;
use App\Http\Controllers\EmailTemplateController;
use App\Models\EmailTemplate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

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
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () use ($schedule) {
            $query = EmailTemplate::query();
            $query->where('schedule_date', Carbon::today());
            $query->where('schedule_time', Carbon::now());
            $emailTemplates = $query->get();

            // Sending email template
            foreach ($emailTemplates as $emailTemplate) {
                try {
                    (new EmailTemplateController())->sendEmailTemplate($emailTemplate->id);
                } catch (\Exception $exception) {
                    logger("----------------- Scheduler Error: Email Template is not Sending :(");
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
