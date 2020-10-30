<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answer', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('title_th', 255)->nullable();
            $table->string('title_en', 255)->nullable();
            $table->mediumText('content_th')->nullable();
            $table->mediumText('content_en')->nullable();
            $table->tinyInteger('created_by');
            $table->tinyInteger('updated_by');
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
        Schema::dropIfExists('question_answer');
    }
}
