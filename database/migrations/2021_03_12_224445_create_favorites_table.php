<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id')->default(0)->comment('会员ID');
            $table->string('api_name', 100)->nullable()->comment('接口标识');
            $table->unsignedTinyInteger('game_type')->default(1)->comment('游戏类型');
            $table->string('model_name')->default('')->comment('关联模型');
            $table->unsignedInteger('model_id')->default(0)->comment('模型ID');
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
        Schema::dropIfExists('favorites');
    }
}
