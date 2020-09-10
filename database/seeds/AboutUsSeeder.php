<?php

use Illuminate\Database\Seeder;
use App\Model\AboutUs;

class AboutUsSeeder extends Seeder
{
  public function run()
  {
    AboutUs::create([
      'title_th' => 'Project Base',
      'title_en' => 'Project Base',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);
  }
}
