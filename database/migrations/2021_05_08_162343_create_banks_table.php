<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('key')->default('')->unique()->comment('标识');
            $table->string('name')->default('')->comment('名称');
            $table->string('url')->default('')->comment('官网');
            $table->string('lang')->default('zh_cn')->comment('币种');
            $table->boolean('is_open')->default(true)->comment('是否开启');
            $table->unsignedInteger('weight')->default(10)->comment('权重');
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
        Schema::dropIfExists('banks');
    }
}
