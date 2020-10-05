<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'stocker']);
        Role::create(['name' => 'user']);
    }
}
