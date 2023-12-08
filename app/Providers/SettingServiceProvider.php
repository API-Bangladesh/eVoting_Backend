<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\SettingServiceManager;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('setting', function ($app) {
            $setting = Setting::first();
            return new SettingServiceManager($app, $setting);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
