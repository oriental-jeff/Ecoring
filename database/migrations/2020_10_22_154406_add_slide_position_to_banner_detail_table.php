<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlidePositionToBannerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner_detail', function (Blueprint $table) {
            $table->tinyInteger('slide_position')->after('banner_id')->default(1)->comment('Slide Position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner_detail', function (Blueprint $table) {
            $table->dropColumn('slide_position');
        });
    }
}
