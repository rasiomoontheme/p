<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsideAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aside_advs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->comment('名称');
            $table->string('group')->default('')->comment('分组名');
            $table->string('pic_url')->default('')->comment('图片地址');
            $table->unsignedInteger('pic_index')->default(0)->comment('图片索引');
            $table->unsignedDecimal('pic_width')->default(0)->comment('图片宽，单位px');
            $table->unsignedDecimal('pic_height')->default(0)->comment('图片高，单位px');
            $table->integer('url_id')->default(0)->comment('跳转地址ID');

            $table->string('effect')->default('')->comment('特效');
            $table->string('vertical')->default('')->comment('垂直位置');
            $table->string('horizontal')->default('')->comment('水平位置');

            $table->string('remark')->default('')->comment('备注');
            $table->string('lang')->default('zh_cn')->comment('语言类型');
            $table->boolean('is_open')->default(false)->comment('是否开放');
            $table->unsignedInteger('weight')->default(10)->comment('排序');
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
        Schema::dropIfExists('aside_advs');
    }
}
