<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insertOrIgnore([
            'name' => "Máy ảnh",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Máy quay",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Máy ghi âm",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Dây kết nối",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Chân máy"
        ]);
    }
}
