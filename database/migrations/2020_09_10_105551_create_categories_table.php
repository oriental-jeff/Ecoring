<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_th');
      $table->string('name_en');
      $table->integer('created_by');
      $table->integer('updated_by');
      $table->timestamps();
      $table->softDeletes('deleted_at', 0);
    });
  }

  public function down()
  {
    Schema::dropIfExists('categories');
  }
}
