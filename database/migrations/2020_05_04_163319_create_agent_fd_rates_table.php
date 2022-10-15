<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentFdRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_fd_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级代理ID');
            $table->unsignedInteger('member_id')->default(0)->comment('当前会员ID');
            $table->unsignedTinyInteger('game_type')->default(1)->comment('游戏类型');
            $table->unsignedTinyInteger('type')->default(1)->comment('点位类型');
            $table->unsignedDecimal('rate',16,2)->default(0.00)->comment('返点比例');
            $table->string('remark')->default('')->comment('备注');
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
        Schema::dropIfExists('agent_fd_rates');
    }
}
