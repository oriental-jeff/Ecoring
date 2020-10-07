<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageBannerTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('banners', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('page_id');
        $table->string('type', 30)->comment('static, slide');
        $table->tinyInteger('position');

        $table->index('page_id');
      });

      Schema::create('banner_detail', function (Blueprint $table) {
        $table->id();
        $table->integer('banner_id');
        $table->string('type', 30)->default('image')->comment("image, youtube");
        $table->string('url')->nullable()->comment('embed, onclick image link');
        $table->integer('created_by');
        $table->integer('updated_by');
        $table->timestamps();

        $table->index('banner_id');
      });

      Schema::create('pages', function (Blueprint $table) {
        $table->id();
        $table->integer('parent_id');
        $table->string('name', 100);
        $table->string('route_name')->nullable();;
        $table->string('title_th')->nullable();
        $table->string('title_en')->nullable();
        $table->string('meta_title_th')->nullable();
        $table->string('meta_title_en')->nullable();
        $table->string('meta_description_th')->nullable();
        $table->string('meta_description_en')->nullable();
        $table->string('meta_keyword_th')->nullable();
        $table->string('meta_keyword_en')->nullable();
        $table->integer('created_by');
        $table->integer('updated_by');
        $table->timestamps();
        $table->softDeletes('deleted_at', 0);

        $table->index('parent_id');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
      Schema::dropIfExists('banners');
      Schema::dropIfExists('banner_detail');
      Schema::dropIfExists('pages');

    }
  }
