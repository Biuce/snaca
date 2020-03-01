<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('long_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->unsignedInteger('video_id')->comment('视频广告id(ads表id)');
            $table->unsignedInteger('shop_id')->comment('渠道id');
            $table->unsignedInteger('ad_id')->comment('广告id(广告位置id)');
            $table->unsignedInteger('agency_id')->comment('代理商id');
            $table->unsignedInteger('brand_id')->comment('品牌id');
            $table->string('order_no', 128)->default('')->unique()->comment('订单号');
            $table->string('path')->default('')->comment('视频/图片地址');
            $table->string('video_name', 128)->unique()->comment('视频广告名称(ads表name)');
            $table->decimal('ad_price', 10, 2)->default(0.00)->comment('商品金额');
            $table->decimal('total_price', 10, 2)->default(0.00)->comment('订单实际金额');
            $table->decimal('discount', 10, 2)->default(0.00)->comment('折扣比例');
            $table->decimal('platform_money', 10, 2)->default(0.00)->comment('平台金额');
            $table->decimal('agency_money', 10, 2)->default(0.00)->comment('分销商金额');
            $table->decimal('person_money', 10, 2)->default(0.00)->comment('个人金额');
            $table->tinyInteger('platform_per')->default(0)->comment('平台百分比');
            $table->tinyInteger('agency_per')->default(0)->comment('分销商百分比');
            $table->tinyInteger('person_per')->default(0)->comment('个人百分比');
            $table->tinyInteger('order_status')->default(1)->comment('订单状态(1 待审核 2 审核失败 3 审核成功)');

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
        Schema::dropIfExists('order');
    }
}
