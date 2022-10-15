<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->comment('会员ID');
            $table->string('card_no', 150)->comment('卡号');
            // $table->tinyInteger('card_type')->default(1)->comment('卡类型 储蓄卡');
            // $table->integer('bank_type')->comment('银行ID');
            $table->string('bank_type')->comment('银行ID');
            $table->string('phone', 50)->nullable()->comment('办卡预留手机号');
            $table->string('owner_name', 150)->comment('持卡人姓名');
            $table->string('bank_address')->default('')->comment('开户行地址');
            $table->string('remark')->default('');
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
        Schema::dropIfExists('member_banks');
    }
}
