<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet_histories', function (Blueprint $table) {
            $table->id();
            $table->string('bet_id')->comment('Id lượt đặt cược');
            $table->string('bet_ref_no');
            $table->string('bet_product')->nullable();
            $table->string('api_name')->comment('Provider code');
            $table->integer('member_id')->comment('id người chơi')->default(-1);
            $table->string('member_name')->comment('name người chơi');
            $table->string('bet_game_id')->comment('ID game từ nhà cái')->nullable();
            $table->dateTime('bet_start_time')->nullable()->comment('Thời gian bắt đầu đặt cược ');
            $table->dateTime('bet_end_time')->nullable()->comment('Thời gian kết thúc đặt cược ');
            $table->unsignedDecimal('bet',16,2);
            $table->unsignedDecimal('turnover',16,2)->comment('Tiền kiếm được dự kiến');
            $table->unsignedDecimal('payout',16,2)->nullable()->default(0);
            $table->unsignedDecimal('commission',16,2)->default(1)->comment('Tổng số tiền cược')->nullable();
            $table->tinyInteger('status')->default(1)->comment('Trạng thái đặt cược: 1 hợp lệ, 2 đang cược, 3 k hợp lệ');
            $table->tinyInteger('result_bet_status')->comment('Kết quả đặt cược: 1 WIN, 2 LOSE, 3 DRAW')->nullable();
            $table->string('versionkey');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bet_histories');
    }
}