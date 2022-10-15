<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 50)->default('')->comment('收款账号');
            $table->string('name',50)->default('')->comment('收款人姓名');
            $table->string('desc')->default('')->comment('描述');
            $table->string('type',20)->default('')->comment('类型，在线支付，银行卡支付，扫码支付');
            $table->string('qrcode')->default('')->comment('二维码图片');
            $table->string('memo')->default('')->comment('支付时的备注信息');
            $table->string('params')->default('')->comment('扩展字段');
            $table->unsignedDecimal('rate',16,2)->default(0.00)->comment('赠送比例');
            $table->unsignedInteger('min')->default(0)->comment('最低充值额度（折算后）');
            $table->unsignedInteger('max')->default(0)->comment('最高充值额度（折算后）');
            $table->unsignedTinyInteger('is_open')->default(1)->comment('是否开启');
            $table->string('lang')->default('zh_cn')->comment('语言类型');
            // $table->unsignedDecimal('forex',16,2)->default(1.00)->comment('交易比例');
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
        Schema::dropIfExists('payments');
    }
}
