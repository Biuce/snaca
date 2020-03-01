<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('long_ad_positions', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键id');
            $table->string('ad_name', 64)->unique()->comment('广告位名称');
            $table->tinyInteger('time')->default(0)->comment('时长');
            $table->string('img_size', 128)->default('')->comment('图片/视频尺寸');
            $table->tinyInteger('status')->default(1)->comment('状态 1 开启 2 不开启');
            $table->rememberToken()->comment('token');
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
        Schema::dropIfExists('ad_position');
    }
}
