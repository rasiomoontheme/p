<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->unsignedTinyInteger('game_type')->default(1)->comment('游戏类型');
            $table->unsignedTinyInteger('level')->default(0)->comment('反水等级');
            $table->unsignedTinyInteger('type')->default(1)->comment('类型');
            $table->string('name',50)->default('')->comment('等级名称');
            $table->decimal('quota',16,2)->default(0.00)->comment('额度');
            $table->decimal('rate',16,2)->default(0.00)->comment('反水比例');
            $table->string('lang')->default('zh_cn')->comment('币种');
            // $table->unique(['game_type','level','type','member_id']);
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
        Schema::dropIfExists('fs_levels');
    }
}
