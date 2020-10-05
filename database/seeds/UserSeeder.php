<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $adminRole = Role::where('name', 'admin')->first();
        $stockerRole = Role::where('name', 'stocker')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => "Admin User",
            'email' => "admin@gmail.com",
            'password' => Hash::make('secret123')
        ]);
        $stocker = User::create([
            'name' => "Author User",
            'email' => "stocker@gmail.com",
            'password' => Hash::make('secret123')
        ]);
        $user = User::create([
            'name' => "Generic User",
            'email' => "user@gmail.com",
            'password' => Hash::make('secret123')
        ]);
        $admin->roles()->attach($adminRole);
        $stocker->roles()->attach($stockerRole);
        $user->roles()->attach($userRole);

        factory(User::class, 10)->create()->each(function($u) {
            $userRole = Role::where('name', 'user')->first();
            $u->roles()->attach($userRole);
        });
    }
}
