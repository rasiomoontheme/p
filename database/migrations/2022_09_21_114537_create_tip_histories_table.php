<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tip_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('product_type');
            $table->integer('game_type');
            $table->integer('game_id')->nullable();
            $table->integer('game_provider')->nullable();
            $table->string('transfer_code');
            $table->string('transaction_id');
            $table->decimal('amount',16,2);
            $table->dateTime('tip_time')->nullable();
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
        Schema::dropIfExists('tip_histories');
    }
}
