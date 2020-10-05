<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_user')->truncate();
        $this->call([
            DepartmentSeeder::class,
            ChannelSeeder::class,
            SupplierSeeder::class,
            CategorySeeder::class,
            EquipmentTemplateSeeder::class,
            EquipmentSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
