<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('product_type');
            $table->integer('game_type');
            $table->integer('game_id')->nullable();
            $table->integer('game_provider')->nullable();
            $table->string('game_round_id')->nullable();
            $table->string('game_period_id')->nullable();
            $table->string('transfer_code');
            $table->string('transaction_id');
            $table->unsignedDecimal('amount',16,2);
            $table->decimal('win_loss',16,2)->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->dateTime('return_stake_time')->nullable();
            $table->dateTime('result_time')->nullable();
            $table->dateTime('cancel_time')->nullable();
            $table->dateTime('rollback_time')->nullable();
            $table->text('order_detail')->nullable();
            $table->text('game_type_name')->nullable();
            $table->text('section')->nullable();
            $table->text('ip')->nullable();
            $table->tinyInteger('status')->default(2);
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
        Schema::dropIfExists('transaction_histories');
    }
}
