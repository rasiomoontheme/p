<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInviteRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('invite_id')->default(0)->comment('邀请注册表ID');
            $table->unsignedInteger('game_type')->default(0)->comment('游戏类型');
            $table->decimal('rate',16,2)->default(0.00)->comment('返点点位');
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
        Schema::dropIfExists('invite_rates');
    }
}
