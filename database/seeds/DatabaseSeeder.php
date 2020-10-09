<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  { 
    $this->call([
      MenusTableSeeder::class,
      RoleSeeder::class,
      UserSeeder::class,
      WebInfoSeeder::class,
      WebSocialTableSeeder::class,
      PagesTableSeeder::class,
      AboutUsSeeder::class,
      AboutUsSeeder::class,
      CategorySeeder::class,
      WarehouseSeeder::class,
    ]);
    $this->command->info('Main table seeded!');

    $path = 'app/StarterKit/area.sql';
    // DB::unprepared(file_get_contents($path));
    // $this->command->info('Area table seeded!');

  }
}
