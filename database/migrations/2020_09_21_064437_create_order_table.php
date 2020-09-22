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
            $table->integer('payments_id');
            $table->string('code')->unique();
            $table->integer('logistics_id');
            $table->integer('users_id');
            $table->decimal('total_amount');
            $table->float('total_weight');
            $table->decimal('discount');
            $table->integer('delivery_charge');
            $table->decimal('vat');
            $table->integer('status')->default(0)->comment('ordered|payment|preparing|delivered');
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
    }
}
