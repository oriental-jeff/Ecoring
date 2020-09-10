<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      User::create([
        'email' => 'superadmin@am2bmarketing.co.th',
        'first_name' => 'SuperAdmin',
        'password' => Hash::make('12345678'),
        'created_by' => 1,
        'updated_by' => 1,
      ])->assignRole('super admin');


      User::create([
        'email' => 'admin@gmail.com',
        'first_name' => 'Admin',
        'password' => Hash::make('12345678'),
        'created_by' => 1,
        'updated_by' => 1,
      ])->assignRole('admin');

      User::create([   
        'email' => 'user@gmail.com',
        'first_name' => 'user',
        'password' => Hash::make('12345678'),
        'created_by' => 1,
        'updated_by' => 1,
      ])->assignRole('general user');
    
    
    }
}
