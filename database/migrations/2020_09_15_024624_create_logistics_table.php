<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_th', 250);
            $table->string('name_en', 250);
            $table->string('period');
            $table->decimal('base_price');
            $table->tinyInteger('active')->default(1)->comment('0:Inactive|1:Active');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        Schema::create('logistic_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('logistisc_id');
            $table->float('weight_from');
            $table->float('weight_to');
            $table->decimal('price');
            $table->date('start_at');
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
        Schema::dropIfExists('logistics');
    }
}
