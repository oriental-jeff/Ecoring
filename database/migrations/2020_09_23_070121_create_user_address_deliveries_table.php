<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressDeliveriesTable extends Migration
{
  public function up()
  {
    Schema::create('user_address_deliveries', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->tinyInteger('default')->default(0);
      $table->string('full_name')->nullable();
      $table->text('address');
      $table->integer('province_id');
      $table->integer('district_id');
      $table->integer('sub_district_id');
      $table->string('postcode', 100);
      $table->string('telephone');
      $table->timestamps();
      $table->softDeletes('deleted_at', 0);
      $table->index('user_id');
    });
  }

  public function down()
  {
    Schema::dropIfExists('user_address_deliveries');
  }
}
