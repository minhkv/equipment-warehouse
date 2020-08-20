<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            'name' => "minh khong",
            'email' => "minhqctb194@gmail.com",
            'password' => Hash::make('secret123')
        ]);
        factory(User::class, 5)->create();
    }
}
