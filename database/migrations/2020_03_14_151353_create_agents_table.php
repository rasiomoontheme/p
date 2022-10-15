<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id')->comment('会员ID');
            // $table->string('agent_uri')->nullable()->comment('代理链接');
            $table->string('agent_pc_uri')->nullable()->comment('代理链接（PC）');
            $table->string('agent_wap_uri')->nullable()->comment('代理链接(WAP)');

            $table->string('agent_uri_pre')->nullable()->comment('代理链接前缀');
            $table->string('apply_data')->default('')->comment('申请信息');
            $table->string('remark')->default('')->comment('备注');
            $table->softDeletes();
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
        Schema::dropIfExists('agents');
    }
}
