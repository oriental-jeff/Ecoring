<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebSocialTable extends Migration
{
  public function up()
  {
    Schema::create('web_social', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('url')->nullable();
      // $table->string('image');
      $table->tinyInteger('active')->default(1);
      $table->integer('created_by');
      $table->integer('updated_by');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('web_social');
  }
}
