<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('api_id')->default(0)->comment('分接api_id');
            $table->string('api_name', 150)->comment('平台名称');
            $table->string('api_title', 150)->nullable()->comment('平台描述名称');
            $table->unsignedDecimal('api_money', 16, 2)->default(0)->comment('接口余额');
            $table->tinyInteger('is_demo')->default(0)->comment('0正式 1测试');
            $table->string('prefix', 50)->nullable()->comment('账号前缀');
            $table->string('lang')->default('zh_cn')->comment('币种');
            $table->string('lang_list',255)->default('')->comment('支持语言');
            $table->unsignedTinyInteger('is_open')->default(0)->comment('0上线1下线');
            $table->unsignedInteger('weight')->default(10)->comment('排序');
            $table->string('remark')->default('')->comment('备注');
            $table->string('icon_url')->default('')->comment('icon');
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
        Schema::dropIfExists('apis');
    }
}
