<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->char('engineer_uuid', 13)->index();
            $table->string('engineer_nickname')->default('');
            $table->double('price')->default(0)->comment('模板价格');
            $table->unsignedTinyInteger('status')->default(10)->comment('10-草稿（未发布状态）,20-发布/上架,30-下架');
            $table->string('file_uri', 127)->default('')->comment('html文件uri');
            $table->string('preview_uri', 127)->default('')->comment('设计稿预览图uri');
            $table->unsignedTinyInteger('audit_status')->default(10)->comment('审核状态,10——待审核,20——审核通过,30——审核不用过');
            $table->unsignedMediumInteger('sold_amount')->default(0)->comment('已销数量');
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
        Schema::dropIfExists('templates');
    }
}
