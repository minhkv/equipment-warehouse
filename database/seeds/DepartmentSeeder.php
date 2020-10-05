<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::truncate();
        Department::create(['name' => "Phòng Cinehome",]);
        Department::create(['name' => "Phòng Tuổi Trẻ - Quốc Tế",]);
        Department::create(['name' => "Phòng Đạo Tràng",]);
        Department::create(['name' => "Phòng Kỹ Thuật",]);
        Department::create(['name' => "Phòng Biên Tập",]);
        Department::create(['name' => "Phòng Sub"]);
        Department::create(['name' => "Phòng IT-CLIP"]);
        Department::create(['name' => "Phòng Dựng"]);
        Department::create(['name' => "Phòng Marketing"]);
    }
}
