<?php

use Illuminate\Database\Seeder;
use App\Model\Categories;

class CategorySeeder extends Seeder
{
  public function run()
  {
    Categories::create([
      'name_th' => 'เครื่องประดับ',
      'name_en' => 'Accessories',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'นาฬิกา',
      'name_en' => 'Watch',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'จักรยาน',
      'name_en' => 'Bicycles',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'กระเป๋า',
      'name_en' => 'Bags',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'รองเท้า',
      'name_en' => 'Shoes',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'กางเกง',
      'name_en' => 'Pants',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'เสื้อผ้า',
      'name_en' => 'Shirts',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Categories::create([
      'name_th' => 'เฟอร์นิเจอร์',
      'name_en' => 'Furnitures',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);
  }
}
