<?php

namespace Mekaeil\LaravelNotification\Database\Seeders\Template;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Mekaeil\LaravelNotification\Entities\NotificationTemplate;
use Mekaeil\LaravelNotification\Entities\NotificationType;

class MasterTemplateNotificationTableSeeder extends Seeder
{
    protected $templates;

    private function getTemplates()
    {
        return $this->templates;
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
        $this->command->info('       NOTIFICATION MODULE: INSERT NOTIFICATION TEMPLATE DATA');
        $this->command->info('=============================================================');
        $this->command->info("\n");

        foreach($this->getTemplates() as $template)
        {
            //// CHECK NOTIFICATION TYPE
            /////////////////////////////////////////////////////////////////////////////////////
            if(! $findTemplateType= NotificationType::where('name', $template['type'])->first())
            {
                $this->command->alert("ERROR!!! THIS NOTIFICATION TYPE << $template[type] >> NOT VALID!");
                continue;
            }

            //// CREATE OR UPDATE NOTIFICATION TEMPLATE
            /////////////////////////////////////////////////////////////////////////////////////
            if( $findTemplate = NotificationTemplate::where('name', $template['name'])->first())
            {
                $findTemplate->update([
                    'type_id'       => $findTemplateType->id,
                    'name'          => $template['name'],
                    'display_name'  => $template['display_name'],
                    'status'        => $template['status'],
                    'class_name'    => $template['class_name'],
                    'can_delete'    => isset($template['can_delete']) ? $template['can_delete'] : true,
                    'data'          => $template['data'],
                ]);

                $this->command->info("THIS NOTIFICATION TEMPLATE << $template[name] >> UPDATED SUCCESSFULLY!");

                continue;
            }

            NotificationTemplate::create([
                'type_id'       => $findTemplateType->id,
                'name'          => $template['name'],
                'display_name'  => $template['display_name'],
                'status'        => $template['status'],
                'class_name'    => $template['class_name'],
                'can_delete'    => isset($template['can_delete']) ? $template['can_delete'] : true,
                'data'          => $template['data'],
            ]);
            $this->command->info("THIS NOTIFICATION TEMPLATE << $template[name] >> CREATED SUCCESSFULLY!");

            
        }


        $this->command->info("\n");
        $this->command->info('=============================================================');
        $this->command->info( '             INSERTING NOTIFICATION TEMPLATE DATA FINALIZED!');
        $this->command->info('=============================================================');
        $this->command->info("\n");

    }
}
