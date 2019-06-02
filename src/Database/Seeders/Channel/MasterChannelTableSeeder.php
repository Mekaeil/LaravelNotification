<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Channel;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Mekaeil\LaravelNotification\Entities\NotificationChannel;

class MasterChannelTableSeeder extends Seeder
{
    protected $channels = [];

    private function getChannels()
    {
        return $this->channels;
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
        $this->command->info('       NOTIFICATION MODULE: INSERT NOTIFICATION CHANNEL DATA');
        $this->command->info('=============================================================');
        $this->command->info("\n");

        foreach($this->getChannels() as $channel)
        {
            if($findChannel = NotificationChannel::where('name', $channel['name'])->first())
            {
                $findChannel->update([
                    'name'          => $channel['name'],
                    'display_name'  => $channel['display_name'],
                    'description'   => $channel['description'],
                    'status'        => $channel['status'],
                ]);
                $this->command->info("THIS CHANNEL << $channel[name] >> UPDATED SUCCESSFULLY.");
                continue;
            }

            NotificationChannel::create([
                'name'          => $channel['name'],
                'display_name'  => $channel['display_name'],
                'description'   => $channel['description'],
                'status'        => $channel['status'],
            ]);
            $this->command->info("THIS CHANNEL << $channel[name] >> CREATED SUCCESSFULLY.");

        }

        $this->command->info("\n");
        $this->command->info('=============================================================');
        $this->command->info('              INSERTING NOTIFICATION CHANNEL DATA FINALIZED!');
        $this->command->info('=============================================================');
        $this->command->info("\n");
        
    }
}
