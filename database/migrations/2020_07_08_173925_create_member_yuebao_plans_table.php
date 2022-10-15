<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberYuebaoPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_yuebao_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->integer('plan_id')->default(0)->comment('方案ID');
            $table->unsignedInteger('amount')->default(0)->comment('购买金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态');
            $table->timestamp('drawing_at')->nullable()->comment('提现时间');
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
        Schema::dropIfExists('member_yuebao_plans');
    }
}
