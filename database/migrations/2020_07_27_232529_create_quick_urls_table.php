<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_urls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->comment('路由标识');
            $table->string('title')->default('')->comment('路由标题');
            $table->string('desc')->default('')->comment('描述');
            $table->string('type')->default('')->comment('路由类型');
            $table->string('url')->default('')->comment('路由地址');

            $table->boolean('is_open')->default(false)->comment('是否开放');
            $table->unsignedInteger('weight')->default(10)->comment('排序');

            $table->unique('name');
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
        Schema::dropIfExists('quick_urls');
    }
}
