<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drawings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_no')->comment('交易流水号');
            $table->integer('member_id')->comment('会员ID');
            $table->string('name')->comment('收款人姓名');
            $table->unsignedDecimal('money',16 ,2)->default(0)->comment('提款金额');
            $table->string('account')->comment('账户 支付宝账户 微信账户 银行卡号');
            
            $table->unsignedDecimal('before_money', 16, 2)->default(0)->comment('提款前金额');
            $table->unsignedDecimal('after_money', 16, 2)->default(0)->comment('提款后金额');
            $table->unsignedDecimal('score',16,2)->default(0)->comment('积分');
            $table->unsignedDecimal('counter_fee', 16 , 2)->default(0)->comment('手续费');
            $table->string('fail_reason')->nullable()->comment('失败原因');
            $table->string('member_bank_info')->default('')->comment('用户银行数据json');
            $table->string('member_remark')->default('')->comment('用户提款备注');
            // $table->string('bank_name')->nullable()->comment('银行名称');
            // $table->string('bank_card')->nullable()->comment('银行卡号');
            // $table->string('bank_address')->nullable()->comment('开户地址');

            $table->timestamp('confirm_at')->nullable()->comment('确认提款成功时间');
            $table->tinyInteger('status')->default(1)->comment('1待确认2成功3失败');
            $table->integer('user_id')->default(0)->comment('管理员ID');

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
        Schema::dropIfExists('drawings');
    }
}
