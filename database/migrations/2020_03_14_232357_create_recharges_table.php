<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_no')->comment('交易流水号');
            $table->integer('member_id')->comment('用户id');
            $table->string('name')->nullable()->comment('充值人名称、昵称');

            // $table->unsignedDecimal('origin_money',16 ,2)->default(0)->comment('折算前充值金额');
            // $table->unsignedDecimal('forex',16,2)->default(0)->comment('交易（折算）比例');
            $table->string('lang')->default('zh_cn')->comment('语言币种类型');

            $table->unsignedDecimal('money',16 ,2)->default(0)->comment('充值金额');
            //$table->tinyInteger('payment_type')->default(1)->comment('支付类型');
            $table->string('payment_type')->default('')->comment('支付类型');
            $table->string('account')->comment("支付账户");
            $table->string('payment_desc')->nullable()->comment("转账类型描述");
            $table->string('payment_detail',500)->default('')->comment('收款账号详情');
            $table->string('payment_pic')->default('')->comment('付款凭证');
            $table->tinyInteger('status')->default(1)->comment('支付状态');
            $table->unsignedDecimal('diff_money', 16, 2)->default(0)->comment('赠送金额');
            $table->unsignedDecimal('before_money', 16, 2)->default(0)->comment('充值前金额');
            $table->unsignedDecimal('after_money', 16, 2)->default(0)->comment('充值后金额');
            $table->unsignedDecimal('score',16,2)->default(0)->comment('积分');
            $table->string('fail_reason')->nullable()->comment('失败原因');
            $table->timestamp('hk_at')->nullable()->comment('客户填写的汇款时间');
            $table->timestamp('confirm_at')->nullable()->comment('确认转账时间');
            $table->integer('user_id')->default(0)->comment('管理员ID');
            $table->timestamps();

            $table->index('status');
            $table->index('payment_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recharges');
    }
}
