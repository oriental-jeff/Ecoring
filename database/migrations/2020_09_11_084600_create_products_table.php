<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categories_id');
            $table->integer('grades_id');
            $table->string('sku')->nullable();
            $table->string('name_th', 250);
            $table->string('name_en', 250);
            $table->text('description_th')->nullable();
            $table->text('description_en')->nullable();
            $table->text('info_th')->nullable();
            $table->text('info_en')->nullable();
            $table->decimal('full_price');
            $table->decimal('price');
            $table->float('weight')->comment('gsm');
            $table->tinyInteger('recommend')->default(0)->comment('0:Nothing|1:Recommend');
            $table->tinyInteger('active')->default(1)->comment('0:Inactive|1:Active');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
