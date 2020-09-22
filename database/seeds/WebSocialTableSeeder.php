<?php

use Illuminate\Database\Seeder;

class WebSocialTableSeeder extends Seeder
{
  public function run()
  {
    \DB::table('web_social')->delete();
    
    \DB::table('web_social')->insert(array (
      0 => 
      array (
        'id' => 1,
        'name' => 'facebook',
        'url' => 'https://www.facebook.com/xxx',
        'active' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => NOW(),
        'updated_at' => NOW(),
      ),

      1 => 
      array (
        'id' => 2,
        'name' => 'line',
        'url' => '#',
        'active' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => NOW(),
        'updated_at' => NOW(),
      ),
    ));
  }
}