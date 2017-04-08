<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid', 13)->unique()->comment('唯一标识符');
            $table->string('nickname', 15)->default('');
            $table->string('name', 7)->default('');
            $table->string('city', 7)->default('');
            $table->string('good_at', 31)->default('')->comment('用于设计师填写');
            $table->char('sex', 1)->default('u')->comment('u:未知,m:男,f:女');
            $table->char('phone', 11)->default('');
            $table->string('email', 31)->default('');
            $table->string('intro', 255)->default('');
            $table->string('working_years', 7)->default('')->comment('用户可不填');
            $table->unsignedTinyInteger('is_enabled')->default(1);
            $table->unsignedTinyInteger('type')->comment('用户类型:10设计师,20工程师,30普通用户');
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
        Schema::dropIfExists('users');
    }
}
