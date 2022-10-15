<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('agent_member_id')->default(0)->comment('代理的会员ID');
            $table->string('token')->default('')->comment('邀请token');
            $table->tinyInteger('is_open')->default(0)->comment('1开启，0关闭');
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
        Schema::dropIfExists('agent_invites');
    }
}
