<?php

use Illuminate\Database\Seeder;
use App\Model\WebInfo;

class WebInfoSeeder extends Seeder
{
  public function run()
  {
    WebInfo::create([
      'name_th' => 'Ecoring Thailand',
      'name_en' => 'Ecoring Thailand',
      'description_th' => 'บริษัทจัดจำหน่ายสินค้ามือหนึ่งและมือสองสภาพดีจากประเทศญี่ปุ่น จัดจำหน่ายในรูปแบบทั้งปลีกและส่ง อาทิเช่น กระเป๋าแบรนด์เนม เฟอร์นิเจอร์ เครื่องครัว เครื่องประดับ เสื้อผ้า รองเท้า ของเล่น กีต้าร์ อุปกรณ์กอล์ฟ จักรยาน ฯลฯ',
      'description_en' => '(en)บริษัทจัดจำหน่ายสินค้ามือหนึ่งและมือสองสภาพดีจากประเทศญี่ปุ่น จัดจำหน่ายในรูปแบบทั้งปลีกและส่ง อาทิเช่น กระเป๋าแบรนด์เนม เฟอร์นิเจอร์ เครื่องครัว เครื่องประดับ เสื้อผ้า รองเท้า ของเล่น กีต้าร์ อุปกรณ์กอล์ฟ จักรยาน ฯลฯ',
      'copyright_th' => 'Copyright © 2020 All Rights Reserved.',
      'copyright_en' => 'Copyright © 2020 All Rights Reserved.',
      'company_name_th' => 'บริษัท เอโค ริง (ไทยแลนด์) จำกัด',
      'company_name_en' => 'Eco Ring (Thailand) Co., Ltd.',
      'company_address_th' => '3/8 Soi Sukhumvit49, Klongton-Nua, Wattana, Bangkok 10110',
      'company_address_en' => '3/8 Soi Sukhumvit49, Klongton-Nua, Wattana, Bangkok 10110',
      'company_tel' => '02-118-6096',
      'company_email' => 'admin@ecoringthailand.com',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

  }
}
