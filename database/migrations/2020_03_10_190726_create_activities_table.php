<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->string('title')->default('')->comment('标题');
            $table->string('subtitle')->default('')->comment('副标题');

            $table->string('cover_image')->nullable()->comment('封面图片');
            $table->text('content')->nullable()->comment('活动说明');

            $table->unsignedTinyInteger('type')->default(3)->comment('活动类型');
            $table->tinyInteger('apply_type')->default(0)->comment('申请方式');
            $table->string('apply_url')->default('')->comment('申请地址');
            $table->text('apply_desc')->nullable()->comment('申请描述');

            $table->string('hall_image')->nullable()->comment('大厅封面图');
            $table->string('hall_field')->default('')->comment('活动大厅申请需要填写的信息');

            $table->timestamp('start_at')->nullable()->comment('活动开始时间');
            $table->timestamp('end_at')->nullable()->comment('活动截止时间');
            $table->string('date_desc')->default('')->comment('活动时间描述');

            $table->boolean('is_open')->default(true)->comment('0上线1下线');
            $table->boolean('is_hot')->default(false)->comment('0正常1热门');
            $table->boolean('is_app')->default(false)->comment('是否app');
            $table->string('lang')->default('zh_cn')->comment('语言类型');

            $table->text('rule_content')->nullable()->comment('活动规则');
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
        Schema::dropIfExists('activities');
    }
}
