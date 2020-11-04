<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_conditions', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(0)->comment('0:step|1:discount|pricing');
            $table->integer('promotions_id');
            $table->decimal('condition')->default(0)->nullable();
            $table->decimal('discount')->default(0)->nullable();
            $table->decimal('discount_pc')->default(0)->nullable();
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
        Schema::dropIfExists('promotion_conditions');
    }
}
