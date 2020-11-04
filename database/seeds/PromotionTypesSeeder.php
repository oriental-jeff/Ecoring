<?php

use Illuminate\Database\Seeder;
use App\Model\PromotionTypes;

class PromotionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PromotionTypes::create([
          'name' => 'ขั้นบันได',
          'created_by' => 1,
          'updated_by' => 1,
          'created_at' => NOW(),
          'updated_at' => NOW(),
        ]);
        PromotionTypes::create([
          'name' => 'ส่วนลด',
          'created_by' => 1,
          'updated_by' => 1,
          'created_at' => NOW(),
          'updated_at' => NOW(),
        ]);
        PromotionTypes::create([
          'name' => 'เมื่อซื้อครบ',
          'created_by' => 1,
          'updated_by' => 1,
          'created_at' => NOW(),
          'updated_at' => NOW(),
        ]);
    }
}
