<?php

use Illuminate\Database\Seeder;
use App\Model\Warehouses;

class WarehouseSeeder extends Seeder
{
  public function run()
  {
    Warehouses::create([
      'name' => 'Center',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Warehouses::create([
      'name' => 'Ecommerce',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);

    Warehouses::create([
      'name' => 'Auction',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => NOW(),
      'updated_at' => NOW(),
    ]);
  }
}
