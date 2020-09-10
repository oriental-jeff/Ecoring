<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTable extends Migration
{
  public function up()
  {
    Schema::create('geographies', function (Blueprint $table) {
      $table->id();
      $table->string('name_th');
      $table->string('name_en');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });

    Schema::create('provinces', function (Blueprint $table) {
      $table->id();
      $table->integer('geography_id');
      $table->string('code', 10);
      $table->string('name_th');
      $table->string('name_en');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });

    Schema::create('amphures', function (Blueprint $table) {
      $table->id();
      $table->integer('province_id');
      $table->string('code', 10);
      $table->string('name_th');
      $table->string('name_en');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });

    Schema::create('districts', function (Blueprint $table) {
      $table->id();
      $table->integer('amphure_id');
      $table->string('zip_code', 10);
      $table->string('name_th');
      $table->string('name_en');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });
  }

  public function down()
  {
    Schema::dropIfExists('geographies');
    Schema::dropIfExists('provinces');
    Schema::dropIfExists('amphures');
    Schema::dropIfExists('provinces');
  }
}
