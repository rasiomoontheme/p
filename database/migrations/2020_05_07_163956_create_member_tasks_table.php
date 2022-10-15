<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id')->default(0)->comment('任务ID');
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->unsignedTinyInteger('status')->default(2)->comment('奖励发放状态');
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
        Schema::dropIfExists('member_tasks');
    }
}
