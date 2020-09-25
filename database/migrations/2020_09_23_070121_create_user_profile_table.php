<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
  public function up()
  {
    Schema::create('user_profile', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->tinyInteger('sex')->nullable()->comment('1:men, 2:women');
      $table->date('birthday');
      $table->string('telephone');
      $table->text('address');
      $table->integer('province_id');
      $table->integer('district_id');
      $table->integer('sub_district_id');
      $table->string('postcode', 100);
      $table->tinyInteger('current_address')->default(1);
      $table->tinyInteger('receive_info')->default(0);
      $table->tinyInteger('privacy_confirm')->default(0);
      $table->timestamps();
      $table->index('user_id');
    });
  }

  public function down()
  {
    Schema::dropIfExists('user_profile');
  }
}
