<?php

use Illuminate\Database\Seeder;
use App\Model\Grades;

class GradeSeeder extends Seeder
{
  public function run()
  {
    Grades::create([
      'name_th' => 'A',
      'name_en' => 'A',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Grades::create([
      'name_th' => 'B',
      'name_en' => 'B',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Grades::create([
      'name_th' => 'C',
      'name_en' => 'C',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);
  }
}
