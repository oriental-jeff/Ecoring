<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentnotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orders_code');
            $table->string('bank_accounts_id');
            $table->string('fullname');
            $table->string('contact');
            $table->string('email');
            $table->dateTime('payment_datetime');
            $table->tinyInteger('status')->default(0)->comment('0:new|1:done');
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
        Schema::dropIfExists('paymentnotifications');
    }
}
