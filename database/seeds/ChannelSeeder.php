<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::truncate();
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
