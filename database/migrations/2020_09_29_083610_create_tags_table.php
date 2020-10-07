<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_th');
            $table->string('name_en');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('products_id');
            $table->integer('tags_id');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('tags');
        Schema::dropIfExists('product_tags');
    }
}
