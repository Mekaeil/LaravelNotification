<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Provider;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;
use Mekaeil\LaravelNotification\Entities\NotificationType;

class MasterNotificationProviderTableSeeder extends Seeder
{
    protected $providers = array();

    private function getProviders()
    {
        return $this->providers;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $this->command->info('=============================================================');
        $this->command->info('       NOTIFICATION MODULE: INSERT NOTIFICATION PROVIDER DATA');
        $this->command->info('=============================================================');
        $this->command->info("\n");

        foreach($this->getProviders() as $provider)
        {
            //// CHECK NOTIFICATION TYPE
            /////////////////////////////////////////////////////////////////////////////////////
            if (!$findType = NotificationType::where('name', $provider['type'])->first()) {
                $this->command->alert("ERROR!!! THIS NOTIFICATION TYPE <<  $provider[type] >> NOT VALID!");
                continue;
            }

            if($findProvider = NotificationProvider::where('name', $provider['name'])->first())
            {
                $findProvider->update([
                    'name'          => $provider['name'],
                    'display_name'  => $provider['display_name'],
                    'type_id'       => $findType->id,
                    'status'        => $provider['status'],
                    'class_name'    => $provider['class_name'],
                    'data'          => $provider['data'],
                ]);
                
                $this->command->info("THIS NOTIFICATION PROVIDER << $provider[name] >> UPDATED SUCCESSFULLY!");
                continue;
            }

            NotificationProvider::create([
                'name'          => $provider['name'],
                'display_name'  => $provider['display_name'],
                'type_id'       => $findType->id,
                'status'        => $provider['status'],
                'class_name'    => $provider['class_name'],
                'data'          => $provider['data'],
            ]);
            $this->command->info("THIS NOTIFICATION PROVIDER << $provider[name] >> CREATED SUCCESSFULLY!");

        }


        $this->command->info("\n");
        $this->command->info('=============================================================');
        $this->command->info('              INSERTING NOTIFICATION PROVIDER DATA FINALIZED!');
        $this->command->info('=============================================================');
        $this->command->info("\n");

    }
}
