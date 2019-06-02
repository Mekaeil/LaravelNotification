<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Type;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Mekaeil\LaravelNotification\Entities\NotificationType;

class MasterTypeTableSeeder extends Seeder
{
    protected $types;

    protected function getTypes()
    {
        return $this->types;
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
        $this->command->info('           NOTIFICATION MODULE: INSERT NOTIFICATION TYPE DATA');
        $this->command->info('=============================================================');
        $this->command->info("\n");

        foreach($this->getTypes() as $type)
        {
            if($findType = NotificationType::where('name', $type['name'])->first())
            {
                $this->command->info("THIS NOTIFICATION TYPE << $type[name] >> EXISTED! UPDATE...");
                $findType->update([
                    'name'          => $type['name'],
                    'display_name'  => $type['display_name'],
                ]);

                continue;
            }

            NotificationType::create([
                'name'          => $type['name'],
                'display_name'  => $type['display_name'],
            ]);
            $this->command->info("<< $type[name] >> CREATED SUCCESSFULL.");

        }

        $this->command->info("\n");
        $this->command->info('=============================================================');
        $this->command->info('            INSERTING NOTIFICATION TYPE DATA FINALIZED!');
        $this->command->info('=============================================================');
        $this->command->info("\n");

    }
}
