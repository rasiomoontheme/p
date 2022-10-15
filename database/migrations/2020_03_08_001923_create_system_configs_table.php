<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('')->comment('配置英文标识');
            $table->string('title')->default('')->comment('配置标题');
            $table->string('config_group')->nullable()->default('basic')->comment('配置分组');
            $table->string('type')->default('text')->comment('配置类型');
            $table->text('value')->comment('配置值');
            $table->string('data_config')->default('')->comment('数据源，在config.platform配置中');
            $table->string('link_html')->default('')->comment('跳转地址html');
            $table->string('description')->default('')->default('')->comment('配置描述');
            $table->boolean('is_open')->default(true)->comment('是否开放');
            $table->unsignedTinyInteger('weight')->default(0)->comment('权重');
            $table->string('lang',50)->default('common')->comment('语言类型');
            $table->timestamps();

            $table->unique(['name','lang']);
            $table->index('name');
            $table->index('is_open');
            $table->index('config_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_configs');
    }
}
