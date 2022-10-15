<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('任务标题');
            $table->unsignedTinyInteger('condition_type')->default(0)->comment('升级条件'); // 单笔充值，累计充值，累计提款，累计盈亏，累计流水
            $table->unsignedInteger('condition_number')->default(0)->comment('满足条件的次数');
            $table->unsignedDecimal('condition_money',16,2)->default(0.00)->comment('满足条件的金额');
            $table->unsignedInteger('condition_day')->default(1)->comment('满足条件的天数'); // (充值)

            $table->unsignedTinyInteger('award_type')->default(0)->comment('奖励类型');

            //$table->unsignedInteger('award_number')->default(1)->comment('奖励次数');
            $table->string('award_content')->default('')->comment('奖励内容');
            $table->tinyInteger('level')->default(0)->comment('晋升等级，有该参数表示是系统设置的活动，不显示在任务列表');
            $table->string('level_award_type')->default('')->comment('晋升等级奖励类型');

            //$table->unsignedInteger('award_per_day')->default(1)->comment('奖励间隔天数');
            //$table->string('award_name')->default('')->comment('奖励称号');
            $table->string('remark')->default('')->comment('备注信息');
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
        Schema::dropIfExists('tasks');
    }
}
