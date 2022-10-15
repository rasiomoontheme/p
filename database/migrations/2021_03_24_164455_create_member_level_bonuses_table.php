<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberLevelBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_level_bonuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->unsignedInteger('level')->default(0)->comment('等级');
            $table->unsignedInteger('type')->default(0)->comment('领取奖励类型');
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
        Schema::dropIfExists('member_level_bonuses');
    }
}
