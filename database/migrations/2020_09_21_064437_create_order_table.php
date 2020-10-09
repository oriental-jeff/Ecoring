<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// AAA YYYYMMDD-NNNN
// table -> generate number
// INC, TYPE, YYYY, MM, NNNN

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('logistics_id');
            $table->integer('users_id');
            $table->decimal('total_amount');
            $table->float('total_weight');
            $table->decimal('discount');
            $table->integer('delivery_charge');
            $table->string('telephone');
            $table->text('address');
            $table->integer('sub_district_id');
            $table->integer('district_id');
            $table->integer('province_id');
            $table->integer('postcode');
            $table->decimal('vat');
            $table->string('tracking_no')->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        Schema::create('auto_format_number', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('yyyy');
            $table->integer('mm');
            $table->integer('last_num');
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
        Schema::dropIfExists('order');
        Schema::dropIfExists('auto_format_number');
    }
}
