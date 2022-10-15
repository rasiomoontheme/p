<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->unsignedInteger('days')->default(0)->comment('签到设置天数');
            // 签到累计天数 还是 连续天数
            $table->unsignedDecimal('bonus_money',16,2)->default(0.00)->comment('奖励金额');
            $table->unsignedInteger('serial_days')->default(0)->comment('连续签到天数');
            $table->unsignedInteger('total_days')->default(0)->comment('累计签到天数');
            $table->tinyInteger('type')->default(0)->comment('-2表示连续签到奖励，-1表示累计签到奖励，0表示普通签到，1，表示累计签到领奖，2表示连续签到领奖');
            $table->tinyInteger('state')->default(0)->comment('领取状态，0表示待确认，1表示已确认，-1表示拒绝');
            $table->string('lang')->default('zh_cn')->comment('语言币种');
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
        Schema::dropIfExists('daily_bonuses');
    }
}
