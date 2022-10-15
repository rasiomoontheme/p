<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rowid', 150)->default(0)->comment('');
            $table->string('billNo', 150)->index()->nullable()->comment('注单流水号');
            $table->string('api_name')->default(1)->index()->comment('接口平台标识');
            
            $table->integer('member_id')->nullabe()->comment('用户 ID');
            $table->string('name', 50)->nullabe()->comment('玩家账号');
            $table->string('playerName', 50)->index()->comment('玩家各平台账号');

            $table->unsignedDecimal('betAmount', 16, 2)->nullable()->default(0.00)->comment('投注金额');
            $table->unsignedDecimal('validBetAmount', 16 ,2)->nullable()->default(0.00)->comment('有效投注额度');
            $table->unsignedDecimal('netAmount', 16, 2)->default(0.00)->comment('玩家输赢额度');

            $table->char('status',10)->default('X')->comment('注单状态，X表示未结算');
            $table->unsignedInteger('gameType')->index()->nullable()->comment('游戏类型');

            $table->string('roundNo')->nullable()->comment('场次信息（包含局号、场次、桌号等），赛事编号');
            $table->string('playDetail')->nullable()->default(0)->comment('游戏玩法、种类，体育的运动项目，隊伍賭注方式，电子的产品代码，游戏代码');
            $table->string('wagerDetail')->default('')->comment('下注明细包括会员投注的号码，赔率');
            $table->string('gameResult')->default('')->comment('游戏开奖结果');

            $table->timestamp('betTime')->nullable()->index()->comment('投注时间');
            // $table->timestamp('betTime')->nullable()->index()->comment('注单投注时间');
            $table->timestamp('lastUpdateTime')->nullable()->comment('注单更新时间');
            $table->timestamp('confirmTime')->nullable()->comment('注单结算时间');

            $table->timestamp('recalcuTime')->nullable()->comment('注单重新派彩时间');
            $table->string('stringex', 100)->nullable()->comment('注单结果明细描述');

            $table->text('result')->nullable()->comment('返回信息');
            $table->string('remark')->default('')->comment('备注信息');

            $table->unsignedTinyInteger('is_fs')->default(0)->comment('是否发放返水');
            $table->unsignedTinyInteger('is_fd')->default(0)->comment('是否发放返点');
            $table->unsignedTinyInteger('is_ml_use')->default(0)->comment('是否计算码量');
            /*

            $table->integer('playType')->nullable()->default(0)->comment('游戏玩法');
            $table->string('currency', 10)->nullable()->comment('货币类型');
            $table->string('tableCode', 10)->nullable()->comment('桌子编号');
            $table->string('loginIP', 20)->nullable()->comment('玩家IP');
            $table->string('recalcuTime')->nullable()->comment('注单重新派彩时间');
            $table->string('platformId', 10)->nullable()->comment('平台编号');
            $table->string('platformType', 10)->nullable()->comment('平台类型');
            $table->string('stringex', 100)->nullable()->comment('产品附注(通常为空)');
            $table->text('remark')->nullable()->comment('返回信息');
            $table->string('round', 10)->nullable();
            $table->integer('copyFlag')->nullable()->default(0)->index('copyFlag')->comment('更新标志');
            $table->string('filePath', 40)->nullable()->comment('文件路径');
            $table->string('cpzl', 100)->nullable()->comment('彩票种类');
            $table->string('wfmz', 100)->nullable()->comment('玩法名字');
            $table->string('xzhm', 100)->nullable()->comment('下注号码');

            $table->string('odds', 50)->nullable()->comment('赔率');
            $table->string('oddsType', 50)->nullable()->comment('赔率类型');
            $table->string('eventName', 150)->nullable()->comment('赛事名称');
            $table->string('betStatus', 50)->nullable()->comment('注单状态');
            $table->decimal('netPnl', 16,2)->default(0)->comment('净输赢');
            $table->string('settleTime', 50)->nullable()->comment('结算时间');
            $table->string('zTeam', 50)->nullable()->comment('主队');
            $table->string('kTeam', 50)->nullable()->comment('客队');

            $table->string('prefix', 10)->nullable()->index('prefix')->comment('站点前缀');
            */

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
        Schema::dropIfExists('game_records');
    }
}
