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
            'name' => "VTV1",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Discovery",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "Cartoon Networks",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "HBO",
        ]);
        DB::table('channels')->insertOrIgnore([
            'name' => "ESPN"
        ]);
    }
}
