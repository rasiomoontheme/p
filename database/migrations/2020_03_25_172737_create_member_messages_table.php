<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->comment('会员ID');
            $table->integer('message_id')->comment('消息ID');
            $table->tinyInteger('is_read')->default(0)->comment('是否已读');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->unique(['member_id','message_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_messages');
    }
}
