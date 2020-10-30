<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTestSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();
    foreach (range(1,100) as $index) {
      DB::table('products')->insert([
        'categories_id' => $faker->numberBetween($min = 1, $max = 5),
        'grades_id' => $faker->numberBetween($min = 1, $max = 3),
        'sku' => $faker->numberBetween($min = 10000, $max = 90000),
        'name_th' => $faker->word,
        'name_en' => $faker->word,
        'description_th' => $faker->text($maxNbChars = 200),
        'description_en' => $faker->text($maxNbChars = 200),
        'info_th' => $faker->text($maxNbChars = 200),
        'info_en' => $faker->text($maxNbChars = 200),
        'full_price' => $faker->numberBetween($min = 2000, $max = 5000),
        'price' => $faker->numberBetween($min = 100, $max = 2000),
        'weight' => $faker->numberBetween($min = 1, $max = 1000),
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => NOW(),
        'updated_at' => NOW(),
      ]);
    }
  }
}
