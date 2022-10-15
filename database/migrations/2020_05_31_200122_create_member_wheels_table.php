<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberWheelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_wheels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->unsignedInteger('award_id')->default(0)->comment('奖品ID');
            $table->string('award_desc')->default('')->comment('奖品描述');
            $table->unsignedTinyInteger('status')->default(0)->comment('领取状态');
            $table->unsignedInteger('user_id')->default(0)->comment('操作管理员ID');
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
        Schema::dropIfExists('member_wheels');
    }
}
