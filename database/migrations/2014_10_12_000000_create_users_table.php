<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->string('email')->unique()->comment('电子邮箱');
            $table->timestamp('email_verified_at')->nullable()->comment('电子邮箱验证时间');
            $table->string('mobile')->unique()->comment('手机号码');
            $table->timestamp('mobile_verified_at')->nullable()->comment('手机号码验证时间');
            $table->string('username')->unique()->comment('用户名');
            $table->string('password')->comment('密码');
            $table->rememberToken();
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
};
