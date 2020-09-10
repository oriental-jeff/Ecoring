<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
  public function run()
  {
    \DB::table('menus')->delete();
    
    \DB::table('menus')->insert(array (
      0 => 
      array (
        'id' => 1,
        'page_id' => 1,
        'position' => 'main',
        'parent_id' => NULL,
        'is_child' => NULL,
        'level' => 1,
        'name_th' => 'หน้าหลัก',
        'name_en' => 'Home',
        'icon' => NULL,
        'sort' => 1,
        'active' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ),
      1 => 
      array (
        'id' => 2,
        'page_id' => 2,
        'position' => 'main',
        'parent_id' => NULL,
        'is_child' => NULL,
        'level' => 1,
        'name_th' => 'เกี่ยวกับเรา',
        'name_en' => 'About',
        'icon' => NULL,
        'sort' => 2,
        'active' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ),
      2 => 
      array (
        'id' => 3,
        'page_id' => 3,
        'position' => 'main',
        'parent_id' => NULL,
        'is_child' => NULL,
        'level' => 1,
        'name_th' => 'ผลงาน',
        'name_en' => 'Gallery',
        'icon' => NULL,
        'sort' => 3,
        'active' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ),
      3 => 
      array (
        'id' => 4,
        'page_id' => 4,
        'position' => 'main',
        'parent_id' => NULL,
        'is_child' => NULL,
        'level' => 1,
        'name_th' => 'เงื่อนไขการสมัคร',
        'name_en' => 'Submission Requirements',
        'icon' => NULL,
        'sort' => 4,
        'active' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ),
    ));
  }
}