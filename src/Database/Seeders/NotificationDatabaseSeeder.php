<?php

namespace Mekaeil\LaravelNotification\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Mekaeil\LaravelNotification\Database\Seeders\Type\NotificationTypeTableSeeder;
use Mekaeil\LaravelNotification\Database\Seeders\Template\TemplateNotificationTableSeeder;
use Mekaeil\LaravelNotification\Database\Seeders\Provider\NotificationProviderTableSeeder;
use Mekaeil\LaravelNotification\Database\Seeders\Channel\ChannelTableSeeder;

class NotificationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /*
        |--------------------------------------------------------------------------
        |  NOTIFICATION TYPE
        |--------------------------------------------------------------------------
        |
        */            
            $this->call(NotificationTypeTableSeeder::class);

        /*
        |--------------------------------------------------------------------------
        |  NOTIFICATION PROVIDER
        |--------------------------------------------------------------------------
        |
        */              
            $this->call(NotificationProviderTableSeeder::class);

        /*
        |--------------------------------------------------------------------------
        |  NOTIFICATION TEMPLATE
        |--------------------------------------------------------------------------
        |
        */
            $this->call(TemplateNotificationTableSeeder::class);

        /*
        |--------------------------------------------------------------------------
        |  NOTIFICATION CHANNELS
        |--------------------------------------------------------------------------
        |
        */
            $this->call(ChannelTableSeeder::class);

        
    }
}
