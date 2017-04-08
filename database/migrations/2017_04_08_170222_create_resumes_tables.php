<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->char('user_uuid', 13)->index();
            $table->string('name', 7)->default('');
            $table->string('phone', 11)->default('');
            $table->string('email', 31)->default('');
            $table->string('school', 31)->default('');
            $table->string('degree', 7)->default('');
            $table->unsignedTinyInteger('age')->default(20);
            $table->char('sex', 1)->default('u')->comment('u:未知,m:男,f:女');
            $table->string('want_job')->default('')->comment('意向岗位');
            $table->string('major', 31)->default('')->comment('专业');
            $table->string('skill', 127)->default('')->comment('技能');
            $table->string('experience', 255)->default('')->comment('工作经验');
            $table->string('intro', 255)->default('')->comment('个人简介');
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
        Schema::dropIfExists('resumes');
    }
}
