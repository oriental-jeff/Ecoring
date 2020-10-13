<?php

use Illuminate\Database\Seeder;
use App\Model\Policy;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Policy::create([
            'title_th' => 'title_th',
            'title_en' => 'title_en',
            'description_th' => 'description_th',
            'description_en' => 'description_en',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
          ]);
    }
}
