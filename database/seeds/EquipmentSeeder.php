<?php

use Illuminate\Database\Seeder;
use App\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::insert([
            [
                'template_id' => 1,
                'price' => 18290000,
                'supplier_id' => 1,
                'size' => '45mm',
                'location' => '1',
                'condition' => 5,
            ],
        ]);
        
    }
}
