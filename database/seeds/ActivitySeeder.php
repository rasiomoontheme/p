<?php

use App\Models\Activity;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=ActivitySeeder
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$data = factory(Activity::class)->times(20)->make();
        $activities = array(
            array(
                "id" => 1,
                "title" => "新会员首存",
                "subtitle" => "",
                "cover_image" => env('APP_URL')."/storage/uploads/activity/202004/24/activity_1587735370_drWjCzHVyo.png",
                "content" => "<p><img src=".env('APP_URL').".test/storage/uploads/editor/202004/24/editor_1587735447_1LFgyjRXAz.png\" alt=\"\" width=\"750\" height=\"194\" /></p>\n<p>例：会员首次存款888，即可申请获得128元奖金。</p>\n<p>流水计算方式：（本金 奖金）*流水倍数</p>",
                "type" => 3,
                "apply_type" => 2,
                "apply_url" => "",
                "apply_desc" => "<p>",
                "hall_image" => env('APP_URL')."/storage/uploads/activity/202004/24/activity_1587736138_dYCw0dMZoc.png",
                "hall_field" => "member_name,recharge_money",
                "start_at" => NULL,
                "end_at" => NULL,
                "date_desc" => "即日起",
                "is_open" => 1,
                "is_hot" => 0,
                "rule_content" => NULL,
                "weight" => 12,
                "created_at" => "2020-04-24 21:42:09",
                "updated_at" => "2020-04-24 21:49:02",
            ),
            array(
                "id" => 2,
                "title" => "公司入款比比赠送",
                "subtitle" => "",
                "cover_image" => env('APP_URL')."/storage/uploads/activity/202004/24/activity_1587736395_BpitTZC9bi.png",
                "content" => "<p><img src=".env('APP_URL').".test/storage/uploads/editor/202004/24/editor_1587736472_zuGT7du4w8.png\" alt=\"\" width=\"750\" height=\"130\" /></p>\n<p><img src=".env('APP_URL').".test/storage/uploads/editor/202004/24/editor_1587736481_4EdCuYJbtO.png\" alt=\"\" width=\"750\" height=\"188\" /></p>",
                "type" => 4,
                "apply_type" => 0,
                "apply_url" => "",
                "apply_desc" => "<p>会员无需提交申请，完成指定优惠入款方式后，系统将自动派发到会员账户。</p>",
                "hall_image" => NULL,
                "hall_field" => "",
                "start_at" => NULL,
                "end_at" => NULL,
                "date_desc" => "即日起",
                "is_open" => 1,
                "is_hot" => 0,
                "rule_content" => "<p><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>1.本活动以北京时间为计时区间，所获奖金 本金达到10倍流水即可申请提款；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>2.每位会员每日仅限申请一次；会员请在成功存款后，未进行任何投注前，前往<a href=\"https://9170pay.com/Activity\" target=\"_blank\" rel=\"noopener\"><span style=\"color: #f39c12;\">【优惠大厅】</span></a>提交申请；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>3.若会员存款后进行投注，则取消参与本活动资格；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>4.所有参与本活动的会员，不得同时参与其他存送活动；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>5.本活动仅限投注于真人视讯，其余游戏不得参与此优惠活动；单笔投注金额不得超过（本金 奖金）总额的70%；<br />6.所有参与本活动的会员，即表示您已同意<span style=\"color: #c0392b;\">《优惠规则与条款》</span>协议。</small></span></span></span></span></p>",
                "weight" => 10,
                "created_at" => "2020-04-24 21:54:46",
                "updated_at" => "2020-04-27 19:42:42",
            ),
            array(
                "id" => 3,
                "title" => "新实时反水",
                "subtitle" => "",
                "cover_image" => "https://cdn2.igsttech.com/Web.Portal/Image/Upload/Promotion/950f1bde5eb44803b569afd0cc70f8df.png",
                "content" => "<p><span style=\"color: #e67e22;\"><span style=\"font-size: 20px;\"><strong><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>电子/捕鱼/棋牌时时返水</small></span></span></span></strong></span></span></p>\n<p><img src=\"https://cdn2.igsttech.com/Web.Portal/Image/Upload/Promotion/a4d5aa6551b94544bf6eb07b9c382a37.png\" alt=\"\" width=\"750\" height=\"66\" /><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>查询方式：登录账号-- </small></span></span></span></span></p>",
                "type" => 1,
                "apply_type" => 0,
                "apply_url" => "",
                "apply_desc" => "<p><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>1.时时返水只需在投注页面右下方点击即可领取时时返水金额。<br />2.天天返水会员无需提交申请，结算与派发时间如下：</small></span></span></span></span></p>\n<p><img src=\"https://cdn2.igsttech.com/Web.Portal/Image/Upload/Promotion/ffbceef89d12487c8faae77dd8190d76.jpg\" alt=\"\" width=\"750\" height=\"100\" /></p>",
                "hall_image" => NULL,
                "hall_field" => "",
                "start_at" => NULL,
                "end_at" => NULL,
                "date_desc" => "即日起",
                "is_open" => 1,
                "is_hot" => 0,
                "rule_content" => "<p><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>1.本活动以北京时间为计时区间，所获返水仅需1倍流水即可申请提款;</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>2.若会员未领取时时返水，系统将在次日北京时间15:00自动派发；<br />3.所有参与本活动的会员，即表示您已同意<span style=\"color: #c0392b;\">《优惠规则与条款》</span>协议。</small></span></span></span></span></p>",
                "weight" => 10,
                "created_at" => "2020-04-24 22:06:32",
                "updated_at" => "2020-04-27 19:41:41",
            ),
            array(
                "id" => 4,
                "title" => "电子棋牌 VIP升级模式",
                "subtitle" => "",
                "cover_image" => env('APP_URL')."/storage/uploads/activity/202004/24/activity_1587737294_Lgxmim2yFx.png",
                "content" => "<p><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>即日起在金沙娱乐城的每一笔电子游艺、开元棋牌永久累积打码，累积到一定标准，即可升级，每升一级即可获得相对应的等级礼金，等级礼金最高可获得688000元，还可获得无门槛要求的周周俸禄、月月俸禄。让您的会员账号变成永久收益的有价值的会员账号！</small></span></span></span></span></p>",
                "type" => 4,
                "apply_type" => 3,
                "apply_url" => env('APP_URL')."/activity",
                "apply_desc" => "<p><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>会员无需提交申请，电子棋牌月俸禄将于北京时间每月4号12:00系统自动派发；<br />电子棋牌晋级礼金，电子棋牌周俸禄将于北京时间每周四12:00系统自动派发；</small></span></span></span></span></p>",
                "hall_image" => NULL,
                "hall_field" => "",
                "start_at" => NULL,
                "end_at" => NULL,
                "date_desc" => "即日起",
                "is_open" => 1,
                "is_hot" => 0,
                "rule_content" => NULL,
                "weight" => 10,
                "created_at" => "2020-04-24 22:15:00",
                "updated_at" => "2020-04-24 22:15:00",
            ),
            array(
                "id" => 5,
                "title" => "电子游艺 以小博大",
                "subtitle" => "",
                "cover_image" => NULL,
                "content" => "<p><img src=".env('APP_URL').".test/storage/uploads/editor/202004/24/editor_1587738000_7zSjjaN0A1.png\" /></p>\n<p><small>注：会员账户需低于5元方可申请本活动。</small><br /><small>例：会员存款50元，即可申请获得38元奖金，提款金额888元。</small></p>",
                "type" => 2,
                "apply_type" => 2,
                "apply_url" => "",
                "apply_desc" => NULL,
                "hall_image" => env('APP_URL')."/storage/uploads/activity/202004/24/activity_1587737808_QZuIAbY8T1.png",
                "hall_field" => "member_name,recharge_money",
                "start_at" => NULL,
                "end_at" => NULL,
                "date_desc" => "即日起",
                "is_open" => 1,
                "is_hot" => 0,
                "rule_content" => "<p><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>1.本活动以北京时间为计时区间，所获奖金 本金达到10倍流水即可申请提款；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>2.每位会员每日仅限申请一次；会员请在成功存款后，未进行任何投注前，前往<a href=\"https://9170pay.com/Activity\" target=\"_blank\" rel=\"noopener\"><span style=\"color: #f39c12;\">【优惠大厅】</span></a>提交申请；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>3.若会员存款后进行投注，则取消参与本活动资格；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>4.所有参与本活动的会员，不得同时参与其他存送活动；</small></span></span></span></span><br /><span style=\"font-size: 20px;\"><span style=\"margin: 0cm 0cm 0.0001pt; text-align: justify;\"><span style=\"font-family: Verdana,Geneva,sans-serif;\"><span style=\"line-height: 150%;\"><small>5.本活动仅限投注于电子游戏，※不可投注于：所有棋牌，捕鱼，桌面游戏、刮刮乐、21点、轮盘、百家乐、骰宝、视频扑克游戏、纸牌、街机游戏、所有Pontoon游戏、各种Craps游戏、赌场战争、娱乐场Holdem游戏、牌九、多旋转老虎机(地妖之穴、海洋公主、三倍利润、热带滚筒和部落生活) 、单轴老虎机、单线老虎机和六合彩，彩票大小，单双，质合，等50%概率游戏。<br />6.所有参与本活动的会员，即表示您已同意<span style=\"color: #c0392b;\">《优惠规则与条款》</span>协议。</small></span></span></span></span></p>",
                "weight" => 10,
                "created_at" => "2020-04-24 22:20:23",
                "updated_at" => "2020-04-27 19:40:48",
            ),
        );

        // Activity::insert($data->makeHidden('type_text')->toArray());
        Activity::insert($activities);

        // 轮播图
        $banners = array(
            array(
                "id" => 1,
                "title" => "首页轮播1",
                "description" => "",
                "url" => env('APP_URL')."/storage/uploads/banner/202004/24/banner_1587712011_dxRy1KVLzE.jpg",
                "groups" => "new1",
                "dimensions" => "1920*418",
                "weight" => 4,
                "is_open" => 1,
                "created_at" => "2020-04-24 15:07:06",
                "updated_at" => "2020-04-24 15:41:45",
            ),
            array(
                "id" => 2,
                "title" => "首页轮播2",
                "description" => "",
                "url" => env('APP_URL')."/storage/uploads/banner/202004/24/banner_1587712045_tSlATXa7H5.png",
                "groups" => "new1",
                "dimensions" => "1920*418",
                "weight" => 3,
                "is_open" => 1,
                "created_at" => "2020-04-24 15:07:40",
                "updated_at" => "2020-04-24 15:07:40",
            ),
            array(
                "id" => 3,
                "title" => "首页轮播3",
                "description" => "",
                "url" => env('APP_URL')."/storage/uploads/banner/202004/24/banner_1587712083_mEs4kWsFaJ.png",
                "groups" => "new1",
                "dimensions" => "1920*418",
                "weight" => 2,
                "is_open" => 1,
                "created_at" => "2020-04-24 15:08:13",
                "updated_at" => "2020-04-24 15:41:34",
            ),
            array(
                "id" => 4,
                "title" => "首页轮播4",
                "description" => "",
                "url" => env('APP_URL')."/storage/uploads/banner/202004/24/banner_1587712107_wFClYvsPF5.png",
                "groups" => "new1",
                "dimensions" => "1920*418",
                "weight" => 1,
                "is_open" => 1,
                "created_at" => "2020-04-24 15:08:32",
                "updated_at" => "2020-04-24 15:42:22",
            ),
            array(
                "id" => 5,
                "title" => "手机轮播1",
                "description" => "",
                "url" => "https://cdn2.igsttech.com/PortalManagement/Image/SlideShow/0cc1050567fe45f4918412e1c3dbe243.jpg",
                "groups" => "mobile1",
                "dimensions" => "",
                "weight" => 12,
                "is_open" => 1,
                "created_at" => "2020-04-27 20:06:33",
                "updated_at" => "2020-04-27 20:06:33",
            ),
            array(
                "id" => 6,
                "title" => "手机轮播2",
                "description" => "",
                "url" => "https://cdn2.igsttech.com/PortalManagement/Image/SlideShow/dd187e4349bc4507b0f3486e5a95a8e6.png",
                "groups" => "mobile1",
                "dimensions" => "",
                "weight" => 13,
                "is_open" => 1,
                "created_at" => "2020-04-27 20:07:25",
                "updated_at" => "2020-04-27 20:07:25",
            ),
            array(
                "id" => 7,
                "title" => "手机轮播3",
                "description" => "",
                "url" => "https://cdn2.igsttech.com/PortalManagement/Image/SlideShow/b41f5bc5182a4b349400287b868714bb.jpg",
                "groups" => "mobile1",
                "dimensions" => "",
                "weight" => 14,
                "is_open" => 1,
                "created_at" => "2020-04-27 20:07:54",
                "updated_at" => "2020-04-27 20:07:54",
            ),
            array(
                "id" => 8,
                "title" => "手机轮播4",
                "description" => "",
                "url" => "https://cdn2.igsttech.com/PortalManagement/Image/SlideShow/4f341fed8f6447f29cc165f512d7d731.jpg",
                "groups" => "mobile1",
                "dimensions" => "",
                "weight" => 15,
                "is_open" => 1,
                "created_at" => "2020-04-27 20:08:22",
                "updated_at" => "2020-04-27 20:08:22",
            ),
        );
        \App\Models\Banner::insert($banners);

        $yuebao_plans = array(
            array(
                "id" => 1,
                "SettingName" => "日利率0.1%年利率36%",
                "MinAmount" => 10,
                "MaxAmount" => 100000000,
                "SettleTime" => 24,
                "IsCycleSettle" => 1,
                "Rate" => 0.10,
                "TotalCount" => 100000000.00,
                "LimitInterest" => 1000000000.00,
                "LimitOrderIntervalTime" => 2,
                "InterestAuditMultiple" => 1.0,
                "LimitUserOrderCount" => 0,
                "is_open" => 1,
                "weight" => 10,
                "created_at" => "2020-07-08 17:34:01",
                "updated_at" => "2020-07-08 19:43:31",
            ),
        );

        foreach ($yuebao_plans as $item){
            \App\Models\YuebaoPlan::create($item);
        }


        // 超链接
        $urls = [
            ['id' => '1','name' => 'register','title' => '通用注册页','type' => 'index','url' => 'Register','is_open' => '1','weight' => '10',],
            ['id' => '2','name' => 'pc_slot','title' => '电脑电子游戏页','type' => 'web','url' => 'Lobby/Game','is_open' => '1','weight' => '10',],
            ['id' => '3','name' => 'pc_how_to_deposit','title' => '电脑存款帮助页','type' => 'web','url' => 'How/Deposit','is_open' => '1','weight' => '10',],
            ['id' => '4','name' => 'pc_how_to_withdrawal','title' => '电脑取款帮助页','type' => 'web','url' => 'How/Drawing','is_open' => '1','weight' => '10',],
            ['id' => '5','name' => 'pc_partner','title' => '电脑合作伙伴页','type' => 'web','url' => 'Partner','is_open' => '1','weight' => '10',],
            ['id' => '6','name' => 'pc_about_us','title' => '电脑关于我们页','type' => 'web','url' => 'AboutUS','is_open' => '1','weight' => '10',],
            ['id' => '7','name' => 'pc_contact','title' => '电脑联系我们页','type' => 'web','url' => 'Contact','is_open' => '1','weight' => '10',],
            ['id' => '8','name' => 'pc_guide','title' => '电脑规则与导航','type' => 'web','url' => 'Guide','is_open' => '1','weight' => '10',],
            ['id' => '9','name' => 'pc_wheel','title' => '电脑幸运大转盘','type' => 'web','url' => 'wheel','is_open' => '1','weight' => '10',],
            ['id' => '10','name' => 'activity_hall','title' => '电脑活动办理大厅','type' => 'index','url' => 'activity','is_open' => '1','weight' => '10',],
        ];

        foreach ($urls as $item){
            \App\Models\QuickUrl::create($item);
        }

        // 角落广告
        $advs = [
            ['id' => '1','name' => '左上角-第一张图','group' => '左上角','pic_url' => env('APP_URL').'/storage/uploads/asideAdv/202007/28/asideAdv_1595870440_p8cuxzdTR3.gif','pic_width' => '220.00','pic_height' => '133.00','vertical' => 'top','horizontal' => 'left','effect' => 'hover','is_open' => '1','weight' => '10',],
            ['id' => '2','name' => '左上角 - 悬浮图','group' => '左上角','pic_url' => env('APP_URL').'/storage/uploads/asideAdv/202007/28/asideAdv_1595871090_uZJWVaHLdT.jpg','pic_index' => '1','pic_width' => '220.00','pic_height' => '650.00','vertical' => 'top','horizontal' => 'left','effect' => 'hover','is_open' => '1','weight' => '10',],
            ['id' => '3','name' => '右上角 - 第一张图','group' => '右上角','pic_url' => env('APP_URL').'/storage/uploads/asideAdv/202007/28/asideAdv_1595919782_IMO1ONA9Bi.gif','pic_width' => '220.00','pic_height' => '133.00','url_id' => '10','vertical' => 'top','horizontal' => 'right','effect' => 'hover','is_open' => '1','weight' => '10',],
            ['id' => '4','name' => '右上角 - 悬浮图','group' => '右上角','pic_url' => env('APP_URL').'/storage/uploads/asideAdv/202007/28/asideAdv_1595919991_ergF6mC3C6.jpg','pic_width' => '220.00','pic_height' => '650.00','url_id' => '10','vertical' => 'top','horizontal' => 'right','effect' => 'hover','is_open' => '1','weight' => '10',],
            ['id' => '5','name' => '左下角 - 幸运大转盘','group' => '左下角','pic_url' => env('APP_URL').'/storage/uploads/asideAdv/202007/28/asideAdv_1595927993_faCia5SWCB.gif','pic_width' => '164.00','pic_height' => '160.00','url_id' => '9','vertical' => 'bottom','horizontal' => 'left','is_open' => '1','weight' => '10',],
        ];

        foreach ($advs as $item){
            \App\Models\AsideAdv::create($item);
        }
    }
}
