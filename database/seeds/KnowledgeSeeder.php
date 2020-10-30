<?php

use Illuminate\Database\Seeder;
use App\Model\Knowledge;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Knowledge::create([
            'title_th' => 'title_th',
            'title_en' => 'title_en',
            'content_th' => 'content_th',
            'content_en' => 'content_en',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
          ]);
    }
}
