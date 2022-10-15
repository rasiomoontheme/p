<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(0)->comment('会员ID');
            $table->integer('user_id')->default(0)->comment('管理员ID');
            $table->integer('pid')->default(0)->comment('上条站内信的ID');
            $table->string('title')->comment('站内信标题');
            $table->string('url')->default('')->comment('跳转url');
            $table->text('content')->comment('内容');
            $table->unsignedTinyInteger('status')->default(0)->comment('处理状态，0待处理，1已处理，2标记处理');
            $table->unsignedTinyInteger('visible_type')->default(1)->comment('可见类型');
            $table->unsignedTinyInteger('send_type')->default(1)->comment('1管理员发送，2会员发送');
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
        Schema::dropIfExists('messages');
    }
}
