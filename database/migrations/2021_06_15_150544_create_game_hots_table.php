<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameHotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_hots', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->comment('名称');
            $table->text('desc')->nullable()->comment('描述');
//            $table->string('en_name', 100)->comment('名称');
//            $table->text('en_desc')->nullable()->comment('描述');
//            $table->string('tw_name', 100)->comment('名称');
//            $table->text('tw_desc')->nullable()->comment('描述');
//            $table->string('th_name', 100)->comment('名称');
//            $table->text('th_desc')->nullable()->comment('描述');
//            $table->string('vi_name', 100)->comment('名称');
//            $table->text('vi_desc')->nullable()->comment('描述');

            $table->text('icon_path')->nullable()->comment('选中前 icon');
            $table->text('icon_path2')->nullable()->comment('选中后 icon');
            $table->string('api_name', 50)->comment('接口名称');
            $table->string('lang', 50)->comment('语种');
            $table->text('jump_link')->nullable()->comment('跳转链接');
            $table->tinyInteger('is_new_window')->default(0)->comment('是否新窗口打开，1是0否');
            $table->tinyInteger('game_type')->default(1)->comment('游戏类型');
            $table->tinyInteger('type')->default(1)->comment('展示位置类型 1热门游戏模块2首页分类游戏');
            $table->string('game_code', 50)->nullable()->comment('游戏入口参数');
            $table->text('img_url')->nullable()->comment('大图');


            $table->tinyInteger('is_online')->default(1)->comment('1上线0下线');
            $table->unsignedInteger('sort')->default(100)->comment('排序');
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
        Schema::dropIfExists('game_hots');
    }
}
