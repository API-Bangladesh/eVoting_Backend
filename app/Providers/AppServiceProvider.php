<?php

namespace App\Providers;

use App\Models\EmailLog;
use App\Models\FailedJob;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);

        $this->syncEmailLogStatus();
    }

    /**
     * Sync email log status
     *
     * Here we are checking the failed_jobs exists or not,
     * If exist we will update email log status to "failed" and then
     * remove failed_jobs entry.
     *
     * @return void
     */
    private function syncEmailLogStatus()
    {
        DB::beginTransaction();

        try {
            $query = FailedJob::query();

            if ($query->count() > 0) {
                $failedJobs = $query->get();

                foreach ($failedJobs as $failedJob) {
                    $jobContent = unserialize(json_decode($failedJob->payload)->data->command);
                    $email = optional($jobContent->mailable)->to[0]['address'];
                    $subject = optional($jobContent->mailable)->subject;

                    if (empty($email) && empty($subject)) {
                        continue;
                    }

                    $query = EmailLog::query();
                    $query->where('to', $email);
                    $query->where('subject', $subject);
                    $emailLog = $query->latest()->first();

                    $emailLog->status = EmailLog::STATUS_FAILED;
                    $emailLog->update();

                    $failedJob->delete();
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();

            report($exception);
        }

        DB::commit();
    }
}
