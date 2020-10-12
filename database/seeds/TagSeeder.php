<?php

use Illuminate\Database\Seeder;
use App\Model\Tags;

class TagSeeder extends Seeder
{
  public function run()
  {
    Tags::create([
      'name_th' => 'กระเป๋า',
      'name_en' => 'Bag',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Tags::create([
      'name_th' => 'เสื้อผ้า',
      'name_en' => 'Shirt',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);
  }
}
