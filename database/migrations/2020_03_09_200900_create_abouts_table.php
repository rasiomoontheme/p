<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('')->comment('标题');
            $table->string('subtitle')->default('')->comment('副标题');
            $table->string('cover_image')->nullable()->comment('封面图片');
            $table->text('content')->comment('内容');
            $table->unsignedTinyInteger('type')->default(1)->comment('类型');
            $table->string('lang')->default('zh_cn')->comment('语言类型');
            $table->boolean('is_open')->default(true)->comment('是否开启');
            $table->boolean('is_hot')->default(false)->comment('是否热门');
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
        Schema::dropIfExists('abouts');
    }
}
