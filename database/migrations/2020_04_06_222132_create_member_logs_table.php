<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->ipAddress('ip')->default('')->comment('操作IP');
            $table->string('address')->default('')->comment('真实地址');
            $table->string('ua')->default('')->comment('操作环境');
            $table->tinyInteger('type')->default(0)->comment('操作类型');
            $table->string('access_token',500)->default('')->comment('登录token');
            $table->string('description')->default('')->comment('说明');
            $table->string('remark')->default('')->comment('备注说明');
            $table->softDeletes();
            $table->timestamps();

            $table->index('member_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_logs');
    }
}
