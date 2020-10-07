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
        'name' => 'Product',
        'route_name' => 'frontend.product',
        'title_th' => 'สินค้า',
        'title_en' => 'Product',
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
        'name' => 'Payment',
        'route_name' => 'frontend.payment',
        'title_th' => 'การชำระเงิน',
        'title_en' => 'Payment',
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

      3 => 
      array (
        'id' => 4,
        'parent_id' => 0,
        'name' => 'Auction',
        'route_name' => 'frontend.auction',
        'title_th' => 'ประมูล',
        'title_en' => 'Auction',
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