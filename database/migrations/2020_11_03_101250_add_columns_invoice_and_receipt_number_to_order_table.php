<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInvoiceAndReceiptNumberToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->string('inv_number', 30)->after('inv_sent_last')->nullable()->comment('เลขที่ใบแจ้งหนี้');
            $table->string('rcpt_number', 30)->after('rcpt_sent_last')->nullable()->comment('เลขที่ใบเสร็ขรับเงิน');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn(['inv_number', 'rcpt_number']);
        });
    }
}
