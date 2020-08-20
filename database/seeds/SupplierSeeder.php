<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insertOrIgnore([
            'name' => "Sony",
            'address' => "Hà Nội"
        ]);
        DB::table('suppliers')->insertOrIgnore([
            'name' => "Nikon",
            'address' => "Bắc Ninh"
        ]);
        DB::table('suppliers')->insertOrIgnore([
            'name' => "GoPro",
            'address' => "Thái Bình"
        ]);
        DB::table('suppliers')->insertOrIgnore([
            'name' => "DJI",
            'address' => "Hà Nội"
        ]);
        DB::table('suppliers')->insertOrIgnore([
            'name' => "Brinno",
            'address' => "Hà Nội"
        ]);
    }
}
