<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('web_info', function (Blueprint $table) {
        $table->id();
        $table->string('name_th')->nullable();
        $table->string('name_en')->nullable();
        $table->text('description_th')->nullable();
        $table->text('description_en')->nullable();
        $table->string('copyright_th')->nullable();
        $table->string('copyright_en')->nullable();
        $table->string('company_name_th')->nullable();
        $table->string('company_name_en')->nullable();
        $table->string('company_tax_code')->nullable();
        $table->text('company_address_th')->nullable();
        $table->text('company_address_en')->nullable();
        $table->string('company_tel')->nullable();
        $table->string('company_fax')->nullable();
        $table->string('company_email')->nullable();
        $table->string('company_gmap_location')->nullable();
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
      Schema::dropIfExists('web_info');
    }
  }
