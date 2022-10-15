<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberAgentAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_agent_applies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->comment('会员ID');
            $table->string('name', 20)->default('')->comment('真实姓名');
            $table->string('phone', 20)->default('')->comment('电话');
            $table->string('email', 20)->default('')->comment('电子邮件');
            $table->string('msn_qq', 32)->default('')->comment('联系方式');
            $table->string('reason')->default('')->comment('申请原因');
            $table->tinyInteger('status')->default(0)->comment('申请状态');
            $table->string('fail_reason')->default('')->comment('失败原因');
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
        Schema::dropIfExists('member_agent_applies');
    }
}
