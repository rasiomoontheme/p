<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->nullable()->comment('标题 系统公告 活动公告');
            $table->string('content')->nullable()->comment('公告内容');
            $table->text('text_content')->nullable()->comment('富文本内容');
            $table->string('group_name')->default('首页')->comment('分组名');
            $table->integer('weight')->default(0)->comment('权重');
            $table->string('url')->nullable()->commnet('跳转链接');
            $table->unsignedInteger('is_app')->default(0)->comment('是否是APP公告');
            $table->unsignedTinyInteger('is_open')->default(1)->comment('是否启用0上线 1下线');
            $table->string('lang')->default('zh_cn')->comment('语言类型');
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
        Schema::dropIfExists('system_notices');
    }
}
