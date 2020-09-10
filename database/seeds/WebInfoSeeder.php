<?php

use Illuminate\Database\Seeder;
use App\Model\WebInfo;

class WebInfoSeeder extends Seeder
{
  public function run()
  {
    WebInfo::create([
      'name_th' => 'Project Base',
      'name_en' => 'Project Base',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

  }
}
