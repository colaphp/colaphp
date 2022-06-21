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
        Schema::create('auth_rules', function (Blueprint $table) {
            $table->id();
            $table->string('group')-comment('规则分组');
            $table->string('rule')->unique()->comment('规则标识（唯一）');
            $table->string('description')->comment('规则描述');
            $table->tinyInteger('type')->comment('验证类型');
            $table->tinyInteger('status')->comment('状态：1正常，0禁用');
            $table->string('condition')->comment('规则表达式，为空表示存在就验证，不为空表示按照条件验证');
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
        Schema::dropIfExists('auth_rules');
    }
};
