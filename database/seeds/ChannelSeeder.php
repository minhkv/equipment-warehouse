<?php

use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Cinehome",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Tuổi Trẻ - Quốc Tế",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Đạo Tràng",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Kỹ Thuật",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Biên Tập",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Sub"
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng IT-CLIP"
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Dựng"
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Phòng Marketing"
        ]);
    }
}
