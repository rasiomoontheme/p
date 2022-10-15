<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('用户名');
            //$table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('密码');
            $table->string('create_ip',128)->nullable()->comment('注册ip');
            $table->rememberToken();
            $table->string('google_secret')->default('')->comment('谷歌秘钥');
            $table->tinyInteger('status')->default(1)->comment('状态: 1 正常, -1禁止');
            $table->string('lang')->default('zh_cn')->comment('语言类型');
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
        Schema::dropIfExists('users');
    }
}
