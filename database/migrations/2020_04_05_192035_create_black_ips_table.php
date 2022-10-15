<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlackIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('black_ips', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('ip')->comment('IP地址');
            $table->tinyInteger('is_open')->default(1)->comment('是否开启');
            $table->string('remark')->default('')->comment('备注信息');
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
        Schema::dropIfExists('black_ips');
    }
}
