<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => "Chân máy ảnh"
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Đèn FLASH"
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Khung gắn cho máy ảnh"
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Tủ chống ẩm"
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Thẻ nhớ"
        ]);

        DB::table('categories')->insertOrIgnore([
            'name' => "Dây cáp kết nối",
        ]);
    
        DB::table('categories')->insertOrIgnore([
            'name' => "Pin",
        ]);
    
        DB::table('categories')->insertOrIgnore([
            'name' => "Sạc pin",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Túi đựng máy ảnh",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Dây đeo",
        ]);
        DB::table('categories')->insertOrIgnore([
            'name' => "Ống kính",
        ]);
    }
}
