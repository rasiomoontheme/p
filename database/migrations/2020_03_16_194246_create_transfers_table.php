<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_no')->nullable();
            $table->string('api_name')->default('')->comment('API接口');
            $table->integer('member_id')->comment('用户ID');
            $table->tinyInteger('transfer_type')->default(0)->comment('0 转入游戏 1转出游戏');
            // $table->tinyInteger('type')->default(1)->comment('转换类型 1 中心账户转入MG账户');
            
            $table->unsignedDecimal('money', 16, 2)->default(0)->comment('用户填写的转换金额');
            $table->unsignedDecimal('diff_money', 16,2)->default(0)->comment('差价金额，即红利');
            $table->unsignedDecimal('real_money', 16,2)->default(0)->comment('实际转换金额');
            $table->unsignedDecimal('before_money', 16,2)->default(0)->comment('转账前的金额');
            $table->unsignedDecimal('after_money', 16,2)->default(0)->comment('转账后的金额');
            
            $table->string('money_type')->default('money')->comment('会员金额字段，money或fs_money');

            // $table->string('transfer_in_account')->nullable()->comment('转入账户');
            // $table->string('transfer_out_account')->nullable()->comment('转出账户');
            // $table->tinyInteger('status')->default(0);
            
            $table->text('result')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
