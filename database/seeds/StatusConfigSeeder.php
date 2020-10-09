<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_config')->insert([
            'id' => 1,
            'status_id' => 0,
            'type' => 'order',
            'name_th' => 'รอการชำระเงิน',
            'name_en' => 'Waiting for payment',
        ]);
        DB::table('status_config')->insert([
            'id' => 2,
            'status_id' => 1,
            'type' => 'order',
            'name_th' => 'รอการตรวจสอบ',
            'name_en' => 'Waiting to be verify',
        ]);
        DB::table('status_config')->insert([
            'id' => 3,
            'status_id' => 2,
            'type' => 'order',
            'name_th' => 'ยกเลิกคำสั่งซื้อ',
            'name_en' => 'Cancel order',
        ]);
        DB::table('status_config')->insert([
            'id' => 4,
            'status_id' => 3,
            'type' => 'order',
            'name_th' => 'ชำระเงินแล้ว',
            'name_en' => 'Paid',
        ]);
        DB::table('status_config')->insert([
            'id' => 5,
            'status_id' => 4,
            'type' => 'order',
            'name_th' => 'กำลังจัดเตรียมสินค้า',
            'name_en' => 'Preparing the product',
        ]);
        DB::table('status_config')->insert([
            'id' => 6,
            'status_id' => 5,
            'type' => 'order',
            'name_th' => 'จัดส่งสินค้า',
            'name_en' => 'Delivery',
        ]);
    }
}
