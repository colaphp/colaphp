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
        Schema::create('auth_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('角色名称');
            $table->string('description')->comment('角色描述');
            $table->string('rules')->comment('用户组拥有的规则id，多个规则","隔开');
            $table->tinyInteger('status')->comment('状态：1正常，0禁用');
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
        Schema::dropIfExists('auth_roles');
    }
};
