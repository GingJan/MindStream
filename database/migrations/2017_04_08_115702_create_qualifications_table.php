<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->index();
            $table->string('credentials',127)->default('')->comment('认证证书');
            $table->unsignedTinyInteger('type')->comment('申请的类型:10设计师,20工程师');
            $table->unsignedTinyInteger('audit_status')->default(0)->comment('认证审核状态');
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
        Schema::dropIfExists('qualifications');
    }
}
