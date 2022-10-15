<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('level')->default(0)->comment('VIP等级');
            $table->string('level_name')->default('')->comment('等级名称');
            $table->unsignedDecimal('deposit_money')->default(0.00)->comment('晋升所需存款金额');
            $table->unsignedDecimal('bet_money')->default(0.00)->comment('晋升所需投注金额');
            $table->unsignedDecimal('level_bonus')->default(0.00)->comment('晋升礼金');
            $table->unsignedDecimal('day_bonus')->default(0.00)->comment('每日礼金');
            $table->unsignedDecimal('week_bonus')->default(0.00)->comment('每周礼金');
            $table->unsignedDecimal('month_bonus')->default(0.00)->comment('每月礼金');
            $table->unsignedDecimal('year_bonus')->default(0.00)->comment('每年礼金');
            $table->unsignedDecimal('credit_bonus')->default(0.00)->comment('借呗额度奖励');
            $table->unsignedTinyInteger('levelup_type')->default(0)->comment('晋升条件类型：0存款额达标,1投注额达标,2所有达标，3任一个达标');
            $table->string('lang')->default('zh_cn')->comment('币种');
            $table->timestamps();

            $table->unique(['level','lang']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_configs');
    }
}
