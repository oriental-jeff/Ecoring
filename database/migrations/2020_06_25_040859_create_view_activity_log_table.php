<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('view_activity_log', function (Blueprint $table) {
          $table->id();
          $table->string('model')->comment('news, activities, student project, hall of frame');
          $table->integer('model_id');
          $table->string('action')->comment('view , share');
          $table->string('description');
          $table->integer('action_by')->comment('who is action');
          $table->timestamps();
      });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_activity_log');
    }
}
