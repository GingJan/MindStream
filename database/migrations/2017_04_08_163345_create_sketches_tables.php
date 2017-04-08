<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSketchesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sketches', function (Blueprint $table) {
            $table->increments('id');
            $table->char('designer_uuid', 13)->index();
            $table->string('designer_nickname')->default('');
            $table->double('price')->default(0)->comment('设计稿价格');
            $table->unsignedTinyInteger('purpose')->default(20)->comment('用途:10-销售,20-展示(不可购买)');
            $table->unsignedTinyInteger('status')->default(10)->comment('10-草稿（未发布状态）,20-发布/上架,30-下架');
            $table->string('origin_uri', 127)->default('')->comment('设计稿原件uri');
            $table->string('preview_uri', 127)->default('')->comment('设计稿预览图uri');
            $table->unsignedTinyInteger('audit_status')->default(10)->comment('审核状态,10——待审核,20——审核通过,30——审核不用过');
            $table->unsignedTinyInteger('is_sold')->default(0)->comment('是否已经销售:1是,0否');
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
        Schema::dropIfExists('sketches');
    }
}
