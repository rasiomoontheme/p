<?php

use App\Models\SystemNotice;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=SystemNoticeSeeder
class SystemNoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        $data = factory(SystemNotice::class)->times(20)->make();
        SystemNotice::insert($data->toArray());
         */

        $data = [
            ['title' => '电子升级大厅公告1','content' => '免息借呗重磅升级；升级模式1级即可申请无利息借贷，0抵押，0担保！最高可借1880000元','group_name' => '电子升级大厅','is_open' => '1',],
            ['title' => '信用借呗','content' => '友情提醒：逾期未还款的会员系统将暂停发放电子棋牌升级模式周俸禄、月俸禄和真人升级模式月俸禄，直至还清后再正常派送。','group_name' => '信用借呗','is_open' => '1',],
            ['title' => '信用借呗','content' => '信用就是价值，价值就是金钱！因为信用，所以简单！','group_name' => '信用借呗','is_open' => '1',],
            ['title' => '信用借呗','content' => '温馨提示：【免息借呗】 单一会员最高可借款￥1880000元，0担保、0抵押、0利息，信用就是价值，价值就是金钱！','group_name' => '信用借呗','is_open' => '1',],
            ['title' => '真人升级大厅公告','content' => '永久累积视讯打码升级，等级礼金+月俸禄【终生领取】尊享时时返水，等级越高账号交易价值越高~','group_name' => '真人升级大厅','is_open' => '1',],
        ];

        foreach ($data as $item){
            SystemNotice::create($item);
        }
    }
}
