<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditPayRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_pay_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->unsignedDecimal('money',16,2)->default(0)->comment('操作金额');
            $table->string('type')->default('')->comment('类型（借款/还款）');
            $table->unsignedInteger('borrow_day')->default(0)->comment('借款天数');
            $table->dateTime('dead_at')->nullable()->comment('还款截止时间');
            $table->unsignedTinyInteger('status')->default(1)->comment('审核状态，1待处理，2通过，3拒绝');
            $table->unsignedTinyInteger('is_return')->default(0)->comment('是否归还');
            $table->unsignedTinyInteger('is_overdue')->default(0)->comment('是否逾期');
            $table->unsignedTinyInteger('is_read')->default(0)->comment('管理员是否知晓');
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
        Schema::dropIfExists('credit_pay_records');
    }
}
