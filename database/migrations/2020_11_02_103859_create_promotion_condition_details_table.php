<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionConditionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('promotion_details');
        Schema::dropIfExists('promotion_conditions');
        Schema::create('promotion_conditions', function (Blueprint $table) {
            $table->id();
            $table->integer('promotion_types_id');
            $table->integer('promotions_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->unique(['promotion_types_id', 'promotions_id']);
        });
        Schema::create('promotion_condition_details', function (Blueprint $table) {
            $table->id();
            $table->integer('promotion_conditions_id');
            $table->decimal('condition')->default(0)->nullable();
            $table->decimal('discount')->default(0)->nullable();
            $table->decimal('discount_pc')->default(0)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
        Schema::create('promotion_details', function (Blueprint $table) {
            $table->id();
            $table->integer('promotion_conditions_id');
            $table->integer('products_id');
            $table->decimal('price')->default(0);
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
        Schema::dropIfExists('promotion_condition_details');
        Schema::dropIfExists('promotion_details');
    }
}
