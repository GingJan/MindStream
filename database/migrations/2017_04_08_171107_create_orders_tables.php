<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sn', 14)->comment('20170409011210')->index();
            $table->char('buyer_uuid', 13)->index();
            $table->string('buyer_name', 7)->default('');;
            $table->unsignedTinyInteger('buyer_type')->comment('10:设计师,20:工程师,30用户');
            $table->char('seller_uuid', 13)->index();
            $table->string('seller_name', 7)->default('');
            $table->unsignedTinyInteger('seller_type')->comment('10:设计师,20:工程师,30用户');
            $table->unsignedInteger('goods_id')->comment('商品id');
            $table->string('goods_type', 15)->comment('商品类型:sketch,template');
            $table->double('price')->default(0);
            $table->string('preview_uri', 127)->default('')->comment('设计稿预览图uri');
            $table->unsignedTinyInteger('is_paid')->default(0)->comment('是否已经付款,1是,0否');
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
        Schema::dropIfExists('orders');
    }
}
