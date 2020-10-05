<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::truncate();
        DB::table('suppliers')->insertOrIgnore([
            'name' => "Canon",
            'address' => "Hà Nội"
        ]);
        DB::table('suppliers')->insertOrIgnore([
            'name' => "Nikon",
            'address' => "Bắc Ninh"
        ]);
        DB::table('suppliers')->insertOrIgnore([
            'name' => "Sony",
            'address' => "Hà Nội"
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
