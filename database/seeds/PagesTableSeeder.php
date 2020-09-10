<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
  public function run()
  {
    \DB::table('pages')->delete();
    
    \DB::table('pages')->insert(array (
      0 => 
      array (
        'id' => 1,
        'parent_id' => 0,
        'name' => 'Home',
        'route_name' => 'frontend.home',
        'title_th' => 'หน้าแรก',
        'title_en' => 'Home',
        'meta_title_th' => '',
        'meta_title_en' => '',
        'meta_description_th' => '',
        'meta_description_en' => '',
        'meta_keyword_th' => '',
        'meta_keyword_en' => '',
        'created_at' => NOW(),
        'updated_at' => NOW(),
        'created_by' => 1,
        'updated_by' => 1,
        'deleted_at' => NULL,
      ),

      1 => 
      array (
        'id' => 2,
        'parent_id' => 0,
        'name' => 'About',
        'route_name' => 'frontend.about',
        'title_th' => 'เกี่ยวกับเรา',
        'title_en' => 'About',
        'meta_title_th' => '',
        'meta_title_en' => '',
        'meta_description_th' => '',
        'meta_description_en' => '',
        'meta_keyword_th' => '',
        'meta_keyword_en' => '',
        'created_at' => NOW(),
        'updated_at' => NOW(),
        'created_by' => 1,
        'updated_by' => 1,
        'deleted_at' => NULL,
      ),

      2 => 
      array (
        'id' => 3,
        'parent_id' => 0,
        'name' => 'Gallery',
        'route_name' => 'frontend.gallery',
        'title_th' => 'ผลงาน',
        'title_en' => 'Gallery',
        'meta_title_th' => '',
        'meta_title_en' => '',
        'meta_description_th' => '',
        'meta_description_en' => '',
        'meta_keyword_th' => '',
        'meta_keyword_en' => '',
        'created_at' => NOW(),
        'updated_at' => NOW(),
        'created_by' => 1,
        'updated_by' => 1,
        'deleted_at' => NULL,
      ),

    ));
  }
}