<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('游戏标题');
            $table->string('subtitle')->default('')->comment('游戏副标题');
            $table->string('web_pic')->default('')->comment('电脑端图片');
            $table->string('mobile_pic')->default('')->comment('手机端图片');
            $table->string('logo_url')->default('')->comment('pc 下拉展示logo');
            // $table->unsignedInteger('api_id')->default(0)->comment('API数据ID');
            $table->string('api_name')->comment('API接口标识');
            $table->string('class_name')->default('')->comment('前端样式标识，主要用于同一个类型接口多个游戏时');
            $table->unsignedTinyInteger('game_type')->default(1)->comment('游戏类型');
            $table->string('params')->default('')->comment('进入游戏参数');
            $table->unsignedTinyInteger('is_open')->default(0)->comment('0上线1下线');
            $table->unsignedInteger('weight')->default(10)->comment('排序');
            $table->tinyInteger('client_type')->default(0)->comment('0 都支持，1 PC，2 手机');
            $table->string('tags')->nullable()->comment('标签（多选）');
            $table->string('remark')->default('')->comment('备注');
            $table->string('lang_json')->default('')->comment('多语言json');
            $table->string('lang')->default('common')->comment('语言类型');
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
        Schema::dropIfExists('api_games');
    }
}
