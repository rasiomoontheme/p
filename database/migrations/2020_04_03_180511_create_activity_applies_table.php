<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_applies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->unsignedInteger('user_id')->default(0)->comment('管理员ID');
            $table->unsignedInteger('activity_id')->default(0)->comment('活动ID');
            //$table->string('data_field')->default('')->comment('需要填写的字段');
            $table->string('data_content')->default('')->comment('填写的字段内容');
            $table->tinyInteger('status')->default(0)->comment('申请状态');
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
        Schema::dropIfExists('activity_applies');
    }
}
