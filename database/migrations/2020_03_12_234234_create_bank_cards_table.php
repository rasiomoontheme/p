<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_no', 150)->comment('卡号');
            $table->tinyInteger('card_type')->default(1)->comment('卡类型 储蓄卡');
            $table->string('bank_type')->default('')->comment('银行ID');
            $table->string('phone', 50)->nullable()->comment('办卡预留手机号');
            $table->string('owner_name', 150)->comment('持卡人姓名');
            $table->string('bank_address')->default('')->comment('开户行地址');
            $table->tinyInteger('is_open')->default(1)->comment('是否启用0 上线1下线');
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
        Schema::dropIfExists('bank_cards');
    }
}
