<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutusTable extends Migration
{
  public function up()
  {
    Schema::create('about_us', function (Blueprint $table) {
      $table->id();
      $table->string('title_th');
      $table->string('title_en');
      $table->string('type_th')->nullable();
      $table->string('type_en')->nullable();
      $table->text('description1_th')->nullable();
      $table->text('description1_en')->nullable();
      $table->text('description2_th')->nullable();
      $table->text('description2_en')->nullable();
      $table->text('description3_th')->nullable();
      $table->text('description3_en')->nullable();
      $table->tinyInteger('active')->default(1);
      $table->integer('created_by');
      $table->integer('updated_by');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('about_us');
  }
}
