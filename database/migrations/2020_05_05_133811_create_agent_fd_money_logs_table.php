<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentFdMoneyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_fd_money_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0)->comment('玩家会员ID');
            $table->unsignedDecimal('member_rate',16,2)->default(0.00)->comment('会员返点点位');
            $table->unsignedInteger('agent_member_id')->default(0)->comment('代理ID');
            $table->unsignedDecimal('agent_member_rate',16,2)->default(0.00)->comment('代理返点点位');
            $table->unsignedInteger('child_member_id')->default(0)->comment('下级会员ID');
            $table->unsignedDecimal('child_member_rate',16,2)->default(0.00)->comment('下级会员返点点位');
            $table->unsignedTinyInteger('game_type')->default(1)->comment('游戏类型');
            $table->unsignedDecimal('bet_amount',16,2)->default(0.00)->comment('投注金额');
            $table->unsignedDecimal('fd_money',16,2)->default(0.00)->comment('返点金额');
            $table->unsignedDecimal('money_before',16,2)->default(0.00);
            $table->unsignedDecimal('money_after',16,2)->default(0.00);
            $table->string('record_billno')->default('')->comment('游戏记录订单号');
            $table->string('remark')->default('')->comment('备注');
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
        Schema::dropIfExists('agent_fd_money_logs');
    }
}
