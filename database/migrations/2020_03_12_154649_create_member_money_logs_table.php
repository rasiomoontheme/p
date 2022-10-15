<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberMoneyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_money_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->unsignedDecimal('money',16,2)->default(0)->comment('操作金额');
            $table->unsignedDecimal('money_before',16,2)->default(0)->comment('操作前金额');
            $table->unsignedDecimal('money_after',16,2)->default(0)->comment('操作后金额');

            $table->enum('money_type',['money','fs_money','total_money','ml_money','score','total_credit','used_credit'])->default('money')->comment('金额类型，中心钱包，返水钱包，平台总投注额，会员积分');
            $table->tinyInteger('number_type')->default(1)->comment('数量类型，1加，-1减');
            $table->unsignedTinyInteger('operate_type')->comment('金额变动类型');
            $table->unsignedInteger('user_id')->default(0)->comment('管理员ID');

            $table->string('model_name')->default('')->comment('关联模型');
            $table->unsignedInteger('model_id')->default(0)->comment('模型ID');

            $table->string('description')->default('')->comment('操作描述');
            $table->string('remark')->default('')->comment('操作备注');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_money_logs');
    }
}
