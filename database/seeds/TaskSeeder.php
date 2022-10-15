<?php

use Illuminate\Database\Seeder;

// php artisan db:seed --class=TaskSeeder
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tasks = array(
            array(
                "id" => 1,
                "title" => "单笔充值满100，奖金3元",
                "condition_type" => 1,
                "condition_number" => 1,
                "condition_money" => 100.00,
                "condition_day" => 1,
                "award_type" => 2,
                "award_content" => "{\"money\":\"1\",\"money_times\":\"3\",\"money_per_day\":\"1\"}",
                "remark" => "",
            ),
            array(
                "id" => 2,
                "title" => "游戏流水达到888，奖励10元",
                "condition_type" => 6,
                "condition_number" => 0,
                "condition_money" => 888.00,
                "condition_day" => 1,
                "award_type" => 2,
                "award_content" => "{\"money\":\"10\",\"money_times\":\"1\",\"money_per_day\":\"1\"}",
                "remark" => "",
            ),
            array(
                "id" => 3,
                "title" => "累计提款100，奖励1块",
                "condition_type" => 3,
                "condition_number" => 0,
                "condition_money" => 100.00,
                "condition_day" => 1,
                "award_type" => 2,
                "award_content" => "{\"money\":\"1\",\"money_times\":\"1\",\"money_per_day\":\"1\"}",
                "remark" => "",
            ),
        );

        foreach ($tasks as $item) App\Models\Task::create($item);

        $member_tasks = array(
            array(
                "id" => 1,
                "task_id" => 1,
                "member_id" => 1,
                "status" => 2,
            ),
            array(
                "id" => 2,
                "task_id" => 2,
                "member_id" => 1,
                "status" => 2,
            ),
            array(
                "id" => 3,
                "task_id" => 3,
                "member_id" => 1,
                "status" => 2,
            ),
        );

        foreach ($member_tasks as $item) App\Models\MemberTask::create($item);

        // payments
        $payments = array(
            array(
                "id" => 1,
                "account" => "",
                "name" => "",
                "desc" => "优选支付通道，支付宝转账，存款秒到账",
                "type" => "online_alipay",
                "qrcode" => "",
                "memo" => "",
                "params" => "{\"account_id\":\"897890\",\"key\":\"dhui0df9034io43klj4lk234\",\"url\":\"http:\\/\\/www.baidu.com\"}",
                "rate" => 0.00,
                "min" => 300,
                "max" => 1000,
                "is_open" => 1,
            ),
            array(
                "id" => 2,
                "account" => "622100120023112",
                "name" => "张三",
                "desc" => "公司入款笔笔存送3%，无上限",
                "type" => "company_bankpay",
                "qrcode" => "",
                "memo" => "测试",
                "params" => "{\"bank_type\":\"ABC\",\"bank_address\":null}",
                "rate" => 3.00,
                "min" => 0,
                "max" => 0,
                "is_open" => 1,
            ),
            array(
                "id" => 3,
                "account" => "123456@qq.com",
                "name" => "张三",
                "desc" => "支付宝扫码支付",
                "type" => "company_alipay",
                "qrcode" => env('APP_URL')."/storage/uploads/payment/202005/13/payment_1589383431_rRQbV9oE3s.png",
                "memo" => "测试",
                "params" => "",
                "rate" => 3.00,
                "min" => 0,
                "max" => 0,
                "is_open" => 1,
            ),
            array(
                "id" => 4,
                "account" => "541100234212001",
                "name" => "张三",
                "desc" => "备用银行卡",
                "type" => "company_bankpay",
                "qrcode" => "",
                "memo" => "",
                "params" => "{\"bank_type\":\"COMM\",\"bank_address\":null}",
                "rate" => 0.00,
                "min" => 1,
                "max" => 1000,
                "is_open" => 1,
            ),
            array(
                "id" => 5,
                "account" => "",
                "name" => "",
                "desc" => "==强烈推荐==优选支付通道，存款秒到账",
                "type" => "online_alipay",
                "qrcode" => "",
                "memo" => "",
                "params" => "{\"account_id\":\"123512\",\"key\":\"sadgj78juhnjkdsa\",\"url\":\"http:\\/\\/www.baidu.com\"}",
                "rate" => 0.00,
                "min" => 300,
                "max" => 10000,
                "is_open" => 1,
            ),
            array(
                "id" => 6,
                "account" => "",
                "name" => "",
                "desc" => "==强烈推荐==优选支付通道，存款秒到账",
                "type" => "online_alipay",
                "qrcode" => "",
                "memo" => "",
                "params" => "{\"account_id\":\"e34563453\",\"key\":\"21qweqw42342353456\",\"url\":\"http:\\/\\/www.baidu.com\"}",
                "rate" => 0.00,
                "min" => 200,
                "max" => 300,
                "is_open" => 1,
            ),
            array(
                "id" => 7,
                "account" => "",
                "name" => "",
                "desc" => "银联快捷支付",
                "type" => "online_union_quick",
                "qrcode" => "",
                "memo" => "",
                "params" => "{\"account_id\":\"5242423\",\"key\":\"qwedgdfbxc\",\"url\":\"http:\\/\\/www.baidu.com\"}",
                "rate" => 0.00,
                "min" => 100,
                "max" => 10000,
                "is_open" => 1,
            ),
        );

        foreach ($payments as $item) App\Models\Payment::create($item);

    }
}
