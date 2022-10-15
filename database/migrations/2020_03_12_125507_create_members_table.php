<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->unique()->comment('用户名');
            $table->string('password');
            $table->string('original_password')->comment('原始密码(用作api的密码)');
            $table->string('o_password')->nullable()->comment('登录密码');

            $table->string('nickname',100)->nullable()->comment('昵称');
            $table->string('realname', 50)->nullable()->comment('真实姓名');
            $table->string('email')->nullable()->comment('电子邮件');
            $table->string('phone')->nullable()->comment('电话号码');
            $table->string('qq')->nullable()->comment('QQ号码');
            $table->string('line')->nullable()->comment('Line');
            $table->string('facebook')->nullable()->comment('Facebook');
            $table->tinyInteger('gender')->default(0)->comment('性别0男1女');
            //$table->tinyInteger('is_daili')->default(0)->comment('是否是代理1为代理');
            
            $table->string('invite_code', 100)->unique()->comment('邀请注册码');
            $table->string('qk_pwd', 100)->nullable()->comment('取款密码');

            $table->unsignedDecimal('money',16,2)->default(0)->comment('中心账户余额');
            $table->unsignedDecimal('fs_money',16,2)->default(0)->comment('返水账户余额');
            $table->unsignedDecimal('ml_money',16,2)->default(0)->comment('码量余额');

            $table->unsignedDecimal('total_money',16,2)->default(0)->comment('平台总投注额');
            // $table->unsignedDecimal('total_slot_money',16,2)->default(0)->comment('平台电子总投注额');
            // $table->unsignedDecimal('total_live_money',16,2)->default(0)->comment('平台真人总投注额');

            $table->unsignedDecimal('score',16,2)->default(0)->comment('会员积分');

            $table->ipAddress('register_ip')->default('')->comment('注册IP');
            $table->string('register_area')->default('')->comment('注册地区');
            $table->string('register_site')->default('')->comment('注册站点');

            // $table->string('last_login_ip')->nullable()->comment('最后登录ip');
            // $table->timestamp('last_login_at')->nullable()->comment('最后登录时间');

            $table->tinyInteger('status')->default(1)->comment('状态');
            // $table->tinyInteger('is_login')->default(0)->comment('0 未登录 1已登录');
            
            // 该用户登录时是否在后台提示
            $table->tinyInteger('is_tips_on')->default(0)->comment('是否开启登录提示');
            $table->tinyInteger('is_in_on')->default(0)->comment('是否内部账号');
            //is_trans_on 是否开启自动转入
            $table->tinyInteger('is_trans_on')->default(0)->comment('是否开启自动转入');
            $table->tinyInteger('is_demo')->default(0)->comment('是否试玩账号');

            $table->string('lang')->default('zh_cn')->comment('语言类型');

            $table->unsignedInteger('top_id')->default(0)->comment('上级代理的代理id');
            $table->unsignedInteger('agent_id')->default(0)->comment('代理id');

            $table->unsignedDecimal('total_credit',16,2)->default(0.00)->comment('借呗可借总金额');
            $table->unsignedDecimal('used_credit',16,2)->default(0.00)->comment('借呗已借金额');

            $table->unsignedInteger('level')->default(0)->comment('VIP等级');
            $table->string('level_name')->default('')->comment('会员称号');

            // $table->unsignedInteger('slot_level')->default(0)->comment('电子VIP等级');
            // $table->unsignedInteger('live_level')->default(0)->comment('真人VIP等级');

            // $table->string('level',50)->default("")->comment('等级');

            // $table->string('agent_uri')->nullable()->comment('代理链接');
            // $table->string('agent_uri_pre')->nullable()->comment('代理链接前缀');

            // $table->string('last_session', 100)->nullable()->comment('');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index('invite_code');
        });

        // 会员银行卡信息
        /*
        Schema::create('member_banks',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->string('bank_username')->nullable()->comment('开户人名字');
            $table->string('bank_name')->nullable()->comment('银行名称');
            $table->string('bank_branch_name')->nullable()->comment('开户行网点');
            $table->string('bank_card')->nullable()->comment('银行卡号');
            $table->string('bank_address')->nullable()->comment('开户地址');
        });
        

        Schema::create('agents',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('agent_uri')->nullable()->comment('代理链接');
            $table->string('agent_uri_pre')->nullable()->comment('代理链接前缀');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
