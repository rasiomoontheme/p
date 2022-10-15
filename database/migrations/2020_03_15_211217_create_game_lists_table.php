<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_lists', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('api_name', 100)->nullable()->comment('游戏名称，对应productCode');

            $table->string('name', 100)->nullable()->comment('游戏中文名称');
            $table->string('en_name', 100)->nullable()->comment('英文名称');

            // $table->string('tcg_game_type')->default('')->comment('TCG游戏类型');
            // $table->unsignedTinyInteger('tcg_product_type')->nullable('TCG产品编号');
            $table->tinyInteger('game_type')->default(3)->comment('游戏类型');
            $table->string('game_code', 100)->nullable()->comment('游戏ID，对应tcgGameCode或者游戏名');

            $table->string('img_path')->nullable()->comment('图片路径');
            $table->string('img_url')->nullable()->comment('图片地址');

            // $table->tinyInteger('type')->default(1)->comment('游戏分类'); 全部是1
            $table->tinyInteger('client_type')->default(1)->comment('0 都支持，1 PC，2 手机');
            $table->string('platform')->default('')->comment('支持环境');
            $table->string('param_remark')->default('')->comment('参数补充');

            $table->tinyInteger('is_open')->default(1)->comment('是否开放');
            $table->unsignedTinyInteger('weight')->default(1)->comment('权重');
            $table->string('tags')->nullable()->comment('标签（多选）');

            $table->unique(['api_name','game_code','game_type']);

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
        Schema::dropIfExists('game_lists');
    }
}
