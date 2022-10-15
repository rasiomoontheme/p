<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('标题');
            // $table->string('cover_image')->default('');
            $table->string('description')->default('')->comment('描述');
            $table->string('url')->default('')->comment('地址');
            $table->string('groups')->nullable()->comment('分组');
            $table->string('dimensions')->default('')->comment('宽高');
            $table->string('jump_link')->default('')->comment('跳转链接');
            $table->boolean('is_new_window')->default(0)->comment('是否新窗口打开，1是0否');
            $table->unsignedInteger('weight')->default(10)->comment('权重');
            $table->boolean('is_open')->default(true)->comment('是否启用');
            $table->string('lang')->default('zh_cn')->comment('语言类型');
            $table->timestamps();

            $table->index('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
