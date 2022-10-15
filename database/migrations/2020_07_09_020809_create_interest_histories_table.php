<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_histories', function (Blueprint $table) {
            $table->id();
            //$table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            //$table->integer('plan_id')->default(0)->comment('方案ID');
            $table->unsignedInteger('member_plan_id')->default(0)->comment('会员购买方案ID');
            $table->unsignedDecimal('interest',16,2)->default(0.00)->comment('利息');
            $table->unsignedInteger('times')->default(0)->comment('利息次数');
            $table->timestamp('calc_at')->nullable()->comment('结算时间');
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
        Schema::dropIfExists('interest_histories');
    }
}
