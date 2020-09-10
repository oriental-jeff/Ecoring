<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('page_id');
            $table->string('position', 100)->default('main');
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('is_child')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->string('name_th');
            $table->string('name_en');
            $table->string('icon')->nullable();
            $table->tinyInteger('sort');
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('menus');
    }
}
