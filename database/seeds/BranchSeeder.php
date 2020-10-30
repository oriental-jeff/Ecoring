<?php

use Illuminate\Database\Seeder;
use App\Model\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name_th' => 'สาขาอ่อนนุช',
            'name_en' => 'Onnut',
            'address_th' => 'กกก',
            'address_en' => 'aaa',
            'telephone' => 'xxx-xxxxxxx, xxx-xxxxxxx',
            'office_hours' => '',
            'description_th' => '',
            'description_en' => '',
            'line' => '',
            'location' => '',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
          ]);
    }
}
