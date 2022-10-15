<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentYjLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_yj_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_id')->default(0)->comment('代理ID');
            $table->unsignedDecimal('yl_money',16,2)->default(0.00)->comment('盈利金额');
            $table->unsignedDecimal('money',16,2)->default(0.00)->comment('佣金');
            $table->string('last_month',10)->default('')->comment('最后发放佣金月份');
            $table->string('remark',255)->default('')->comment('备注');
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
        Schema::dropIfExists('agent_yj_logs');
    }
}
