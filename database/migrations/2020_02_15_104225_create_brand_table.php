<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('long_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand_name', 128)->unique()->default('')->comment('品牌名称');
            $table->string('brand_image', 128)->default('')->comment('品牌图片');
            $table->tinyInteger('status')->default(1)->comment('状态 1 开启 2 关闭');
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
        Schema::dropIfExists('brand');
    }
}
