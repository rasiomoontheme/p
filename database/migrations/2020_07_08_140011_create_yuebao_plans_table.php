<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYuebaoPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yuebao_plans', function (Blueprint $table) {
            $table->id();
            $table->string('SettingName')->default('')->comment('计划标题');
            $table->unsignedInteger('MinAmount')->default(0)->comment('最低购买金额');
            $table->unsignedInteger('MaxAmount')->default(0)->comment('最高购买金额');
            $table->unsignedInteger('SettleTime')->default(0)->comment('结算时间');
            $table->boolean('IsCycleSettle')->default(false)->comment('是否循环结算/单次结算');
            $table->unsignedDecimal('Rate',16,2)->default(0.00)->comment('利率');
             $table->unsignedDecimal('TotalCount',16,2)->default(0.00)->comment('计划总金额');
            // $table->unsignedDecimal('RemainingCount',16,2)->default(0.00)->comment('可购买总金额');
            $table->unsignedDecimal('LimitInterest',16,2)->default(0.00)->comment('会员封顶利息');
            $table->unsignedInteger('LimitOrderIntervalTime')->nullable()->comment('限制订单间隔时间');
            $table->unsignedDecimal('InterestAuditMultiple',16,1)->default(1.0)->comment('利息码量倍数');
            $table->integer('LimitUserOrderCount')->default(-1)->comment('会员最大购买总金额');
            $table->boolean('is_open')->default(false)->comment('是否开放');
            $table->unsignedInteger('weight')->default(10)->comment('排序');
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
        Schema::dropIfExists('yuebao_plans');
    }
}
