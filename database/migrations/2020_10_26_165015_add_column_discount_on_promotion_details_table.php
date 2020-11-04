<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDiscountOnPromotionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotion_details', function (Blueprint $table) {
            $table->decimal('discount')->after('price')->nullable();
            $table->decimal('discount_pc')->after('discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotion_details', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('discount_pc');
        });
    }
}
