<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYjLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yj_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('level')->default(0)->unique()->comment('佣金等级');
            $table->string('name',50)->default('')->comment('等级名称');
            $table->unsignedInteger('active_num')->default(0)->comment('下线活跃人数');
            $table->decimal('min',16,2)->default(0.00)->comment('额度');
            $table->decimal('rate',16,2)->default(0.00)->comment('佣金比例');
            $table->string('lang')->default('zh_cn')->comment('币种');
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
        Schema::dropIfExists('yj_levels');
    }
}
