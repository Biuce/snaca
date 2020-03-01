<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('long_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('position_id')->comment('广告位置id');
            $table->unsignedInteger('shop_id')->comment('渠道id');
            $table->string('name', 128)->unique()->comment('广告名称');
            $table->string('path')->default('')->comment('视频地址');
            $table->tinyInteger('time')->default(0)->comment('时长');
            $table->decimal('price', 10, 2)->default(0.00)->comment('价格');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 1 开启 2 不开启');
            $table->timestamps();

            $table->comment = '视频广告表';
        });
//        DB::statement("ALTER TABLE `ads` comment '广告表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
