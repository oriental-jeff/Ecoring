<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTable extends Migration
{
  public function up()
  {
    Schema::create('branch', function (Blueprint $table) {
      $table->id();
      $table->string('name_th');
      $table->string('name_en');
      $table->text('address_th')->nullable();
      $table->text('address_en')->nullable();
      $table->string('telephone')->nullable();
      $table->string('office_hours')->nullable();
      $table->text('description_th')->nullable();
      $table->text('description_en')->nullable();
      $table->string('line')->nullable();
      $table->text('location')->nullable();
      $table->tinyInteger('active')->default(1);
      $table->integer('created_by');
      $table->integer('updated_by');
      $table->timestamps();
      $table->softDeletes('deleted_at', 0);
    });
  }

  public function down()
  {
    Schema::dropIfExists('branch');
  }
}
