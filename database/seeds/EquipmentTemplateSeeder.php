<?php

use Illuminate\Database\Seeder;
use App\EquipmentTemplate;
use App\Equipment;
class EquipmentTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = factory(EquipmentTemplate::class, 10)
                    ->create()
                    ->each(function($template) {
                        $template->equipments()->createMany(factory(Equipment::class, 7)->make()->toArray());
                    });
    }
}
