<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_apis', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('member_id')->comment('会员ID');
            $table->string('api_name')->comment('接口名称');
            $table->string('username', 100)->comment('平台账号');
            $table->string('password', 150)->comment('平台密码');
            $table->string('api_token')->default('')->comment('接口Token');
            $table->string('game_token')->default('')->comment('游戏token');
            $table->unsignedDecimal('money', 16,2)->default(0)->comment('平台余额');

            $table->timestamp('last_login_at')->nullable()->comment('上次登录时间');

            $table->string('description')->default('')->comment('描述');
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
        Schema::dropIfExists('member_apis');
    }
}
