<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->id();
            $table->string('home_team_name')->default('')->comment('主队名称');
            $table->string('home_team_name_en')->default('')->comment('主队名称英文');
            $table->string('home_team_img')->default('')->comment('主队图片');
            $table->unsignedDecimal('home_odds',16,2)->default(0.00)->comment('主队赔率');

            $table->string('visiting_team_name')->default('')->comment('客队名称');
            $table->string('visiting_team_name_en')->default('')->comment('客队名称英文');
            $table->string('visiting_team_img')->default('')->comment('客队图片');
            $table->unsignedDecimal('visiting_odds',16,2)->default(0.00)->comment('客队赔率');

            // $table->unsignedDecimal('let_ball',16,2)->default(0.00)->comment('让球');
            $table->string('let_ball')->default(0)->comment('让球');

            $table->string('match_cup')->default('')->comment('比赛名称');
            $table->string('match_cup_en')->default('')->comment('比赛名称英文');

            $table->timestamp('match_at')->nullable()->comment('比赛时间');

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
        Schema::dropIfExists('sports');
    }
}
