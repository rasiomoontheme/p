<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentInviteRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_invite_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->unsignedInteger('invite_id')->default(0)->comment('代理邀请链接ID');
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
        Schema::dropIfExists('agent_invite_records');
    }
}
