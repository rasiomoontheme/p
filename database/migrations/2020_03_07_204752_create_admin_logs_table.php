<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->string('url')->default('')->comment('操作URL');
            $table->text('data')->nullable()->comment('操作数据');
            $table->ipAddress('ip')->default('')->comment('操作IP');
            $table->string('address')->default('')->comment('真实地址');
            $table->string('ua')->default('')->comment('操作环境');
            $table->tinyInteger('type')->default(0)->comment('操作类型');
            $table->string('description')->default('')->comment('说明');
            $table->string('remark')->default('')->comment('备注说明');
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
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
        Schema::dropIfExists('admin_logs');
    }
}
