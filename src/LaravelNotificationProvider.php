<?php

namespace Mekaeil\LaravelNotification;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

use Mekaeil\LaravelNotification\Providers\SMS\SMSContracts;
use Mekaeil\LaravelNotification\Providers\SMSProvider;

class LaravelNotificationProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        ////    CHECK IF ROUTE EXISTS IN BASE PROJECT USE IT 
        if (file_exists(app_path('/../routes/route.notification.php')))
        {
            $this->loadRoutesFrom(app_path('/../routes/route.notification.php'));
        }
        else{
            $this->loadRoutesFrom(__DIR__ . '/Routes/route.notification.php');
        }

        ////    SET VIEW'S ROUTE
        // $this->loadViewsFrom(__DIR__ . '/Views', 'LaravelNotification');

        ////    SET MIGRATIONS'S ROUTE
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        ////    SET CONFIG'S ROUTE
        $this->mergeConfigFrom(__DIR__ . '/Config/laravel-notification.php','laravel-notification');


        /// PUBLISH SECTION
        ////////////////////////////////////////////////////////////////////////////////////////////////////

            /// ROUTE
            $this->publishes([
                __DIR__ . '/Routes/route.notification.php' => app_path('/../routes/route.notification.php'),
            ]);

            /// CONFIG
            $this->publishes([
                __DIR__ . '/Config/laravel-notification.php' => config_path('laravel-notification.php'),
            ]);


        ///  PUBLISH LANGUAGE FILES
        ////////////////////////////////////////////////////////////////////////////////////////////////////

            // $this->publishes([
            //     __DIR__ . '/lang/en/laravelNotification.php' => resource_path('/lang/en/laravelNotification.php'),
            // ]);

            // $this->publishes([
            //     __DIR__ . '/lang/fa/laravelNotification.php' => resource_path('/lang/fa/laravelNotification.php'),
            // ]);

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('notification', function(){
            return new NotificationService();
        });

        //// IF WE WANT USE SMS PROVIDER WITHOUT NOTIFICATION FACADE
        //////////////////////////////////////////////////////////////
        // $this->app->bind(SMSContracts::class, SMSProvider::class);
    

    }
}
