<?php

use App\Models\SystemConfig;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=SystemConfigSeeder
class SystemConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * \App\Models\SystemConfig::create()
     * @return void
     */
    public function run()
    {
        $data = [
            // remote_api
            ['name' => 'remote_api_domain','title' => '分接API域名','config_group' => 'remote_api','type' => 'text','value' => 'http://api.topapis.com:8077','is_open' => '0',],
            ['name' => 'remote_api_id','title' => '分接API的ID','config_group' => 'remote_api','type' => 'text','value' => 'api_id','is_open' => '0',],
            ['name' => 'remote_api_key','title' => 'api_key','config_group' => 'remote_api','type' => 'text','value' => '7IhTuVvMp86e9PShe2MohqjpzTC0nHgh','is_open' => '0',],
            ['name' => 'remote_api_prefix','title' => '分接API的前缀','config_group' => 'remote_api','type' => 'text','value' => '1ia','is_open' => '0',],

            ['name' => 'mobile_category_json','title' => '手机首页图标配置','config_group' => 'basic','type' => 'text','value' => '[{"title":"热门","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Hot.png","weight":"10","is_open":"true"},{"title":"电子","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Slot.png","weight":"9","is_open":"true"},{"title":"真人","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Live.png","weight":"8","is_open":"true"},{"title":"捕鱼","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Fish.png","weight":"7","is_open":"true"},{"title":"棋牌","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Board.png","weight":"6","is_open":"true"},{"title":"体育","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Sport.png","weight":"5","is_open":"true"},{"title":"彩票","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Lottery.png","weight":"4","is_open":"true"}]','is_open' => '0',],
            ['name' => 'wheels_setting_json','title' => '轮盘抽奖次数条件设置','config_group' => 'basic','type' => 'text','value' => ''],
            ['name' => 'activity_type_json','title' => '活动类型设置','config_group' => 'basic','type' => 'text','value' => ''],
            // ['name' => 'wheels_award_json','title' => '轮盘抽奖奖励设置','config_group' => 'basic','type' => 'text','value' => ''],

            ['name' => 'redbag_setting_json','title' => '红包抽奖次数条件设置','config_group' => 'basic','type' => 'text','value' => ''],
            ['name' => 'redbag_size_setting_json','title' => '红包大小设置','config_group' => 'basic','type' => 'text','value' => ''],
            ['name' => 'redbag_desc_setting_json','title' => '红包说明设置','config_group' => 'basic','type' => 'text','value' => ''],
            ['name' => 'daili_active_money_json','title' => '活跃会员充值金额设置','config_group' => 'basic','type' => 'text','value' => ''],
            ['name' => 'drawing_money_size_json','title' => '提款最低/最高金额设置','config_group' => 'basic','type' => 'text','value' => ''],


            ['name' => 'is_redbag_open','title' => '是否开启红包','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '1',],
//            ['name' => 'redbag_min_money','title' => '红包最小金额','config_group' => 'activity','type' => 'number','value' => '3','is_open' => '1',],
//            ['name' => 'redbag_max_money','title' => '红包最大金额','config_group' => 'activity','type' => 'number','value' => '10','is_open' => '1',],
            //           ['name' => 'redbag_day_times','title' => '每日抢红包次数','config_group' => 'activity','type' => 'number','value' => '3','is_open' => '1',],
            ['name' => 'is_daily_bonus_open','title' => '是否开启签到','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '1',],
            ['name' => 'is_daily_bonus_auto','title' => '签到是否自动领奖','config_group' => 'activity','type' => 'boolean','value' => '1','link_html' => '<a href="javascript:;" data-url="/admin/dailybonuses" data-title="签到设置" class="js-create-tab multitabs">【Mở cài đặt đăng nhập】</a>','is_open' => '1',],
            ['name' => 'activity_money_type','title' => '活动奖励发放钱包类型','config_group' => 'activity','type' => 'select','value' => 'money','is_open' => '1','data_config' => 'platform.config_money_type',],
            ['name' => 'member_fs_money_type','title' => '会员反水发放钱包','config_group' => 'activity','type' => 'select','value' => 'fs_money','is_open' => '1','data_config' => 'platform.config_money_type'],

            ['name' => 'is_realtime_fs_mode','title' => '是否开启时时反水模式','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '1'],

            ['name' => 'activity_yuebao_plan_enable','title' => '是否开放余额宝方案购买','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '1'],
            ['name' => 'activity_yuebao_enable','title' => '是否开放余额宝','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '1'],

            ['name' => 'activity_wheel_is_open','title' => '是否开启幸运大转盘活动','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '1'],

            ['name' => 'is_system_maintenance','title' => '是否开启系统维护','config_group' => 'system','type' => 'boolean','value' => '0','is_open' => '1',],
            ['name' => 'system_maintenance_whitelist','title' => '系统维护IP白名单','config_group' => 'system','type' => 'textarea','value' => '0.0.0.0|1.1.1.1','is_open' => '1',],
            ['name' => 'system_maintenance_message','title' => '网站维护提示信息','config_group' => 'system','type' => 'textarea','value' => '网站维护时间是 xxx ~ xxx','is_open' => '1',],
            // ['name' => 'bank_desc','title' => '公司简介','config_group' => 'system','type' => 'textarea','value' => '','is_open' => '1',],

            ['name' => 'site_title','title' => '网站标题','config_group' => 'system','type' => 'text','value' => '|金|沙|娱|乐|','is_open' => '1',],
            ['name' => 'site_domain','title' => '活动站域名','config_group' => 'system','type' => 'text','value' => env('APP_URL'),'is_open' => '1',],
            ['name' => 'site_keyword','title' => '网站关键字','config_group' => 'system','type' => 'textarea','value' => '网站，关键字','is_open' => '1',],
            ['name' => 'wap_qrcode','title' => '手机APP下载二维码','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202004/28/config_1588059335_9OigwNz16O.png','is_open' => '1',],
            ['name' => 'wap_app_link','title' => '手机APP下载地址','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com/appdownload'],
            ['name' => 'service_link','title' => '客服链接','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com','is_open' => '1',],
            // ['name' => 'kefu_wechat_qrcode','title' => '微信客服二维码','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202004/28/config_1588059335_9OigwNz16O.png','is_open' => '1',],
            ['name' => 'site_logo','title' => '网站Logo','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/web/images/activity/logo.png','is_open' => '1',],
            ['name' => 'site_wap_logo','title' => '手机网站Logo','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/web/images/activity/logo.png','is_open' => '1','lang' => 'common'],
            ['name' => 'site_logo2','title' => '网站备用LOGO','config_group' => 'system','type' => 'picture','value' => '','is_open' => '1'],

            ['name' => 'site_name','title' => '网站名称','config_group' => 'system','type' => 'text','value' => '金沙娱乐','is_open' => '1',],
            //['name' => 'kefu_qq','title' => '客服QQ','config_group' => 'system','type' => 'text','value' => '12345678','is_open' => '1',],
            ['name' => 'site_email','title' => '网站邮箱','config_group' => 'system','type' => 'text','value' => 'test@email','is_open' => '1',],
            // ['name' => 'site_kefu_link','title' => '在线客服链接','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com','is_open' => '1',],

            ['name' => 'site_slogan','title' => '网站副logo','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202005/24/config_1590301172_yKkvwoooIg.png','is_open' => '1','description' => '图片尺寸：宽240px，高60px',],
            ['name' => 'site_pc','title' => '电脑端地址','config_group' => 'system','type' => 'text','value' => 'http://127.0.0.1:8080','is_open' => '1','description' => '需要包含http://前缀',],
            ['name' => 'site_mobile','title' => '手机端网址','config_group' => 'system','type' => 'text','value' => 'http://127.0.0.1:8081','is_open' => '1','description' => '需要包含http://前缀',],

            ['name' => 'is_scroll_adv_open' ,'title' => '是否开启滚动广告','config_group' => 'system','type' => 'boolean','value' => 1,'is_open' => '1'],

            ['name' => 'is_demo_play_open','title' => '是否开启试玩功能','config_group' => 'system','type' => 'boolean','value' => 1,'is_open' => '1'],
            ['name' => 'is_open_register','title' => '是否开放注册页面','config_group' => 'system','type' => 'boolean','value' => 1,'is_open' => '1'],

            // 是否开启余额宝，借呗
            ['name' => 'activity_jiebei_enable','title' => '是否开启借呗','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '0'],
            ['name' => 'activity_shengji_enable','title' => '是否开启升级活动','config_group' => 'activity','type' => 'boolean','value' => '1','is_open' => '0','lang' => 'common'],

            ['name' => 'transfer_start','title' => '提款开始时间','config_group' => 'drawing','type' => 'time','value' => '00:00:00','is_open' => '1',],
            ['name' => 'transfer_end','title' => '提款截止时间','config_group' => 'drawing','type' => 'time','value' => '23:59:59','is_open' => '1',],
//            ['name' => 'min_transfer','title' => '最低提款金额','config_group' => 'drawing','type' => 'number','value' => '1','is_open' => '1',],
//            ['name' => 'max_transfer','title' => '最高提款金额','config_group' => 'drawing','type' => 'number','value' => '10000','is_open' => '1',],
            ['name' => 'ml_percent','title' => '码量百分比','config_group' => 'drawing','type' => 'number','value' => '50','is_open' => '1',],
            ['name' => 'ml_drawing_percent','title' => '码量有剩余时提款手续费百分比','config_group' => 'drawing','type' => 'number','value' => '2','is_open' => '1',],

            //['name' => 'daili_active_money','title' => '活跃会员充值金额标准','config_group' => 'agent','type' => 'text','value' => '50','is_open' => '1',],
            ['name' => 'agent_fd_mode','title' => '是否启用无限代理模式','config_group' => 'agent','type' => 'boolean','value' => '1','is_open' => '1',],
            // ['name' => 'agent_fd_money_type','title' => '代理返点发放钱包类型','config_group' => 'agent','type' => 'select','value' => 'fs_money','is_open' => '1','data_config' => 'platform.config_money_type'],
            ['name' => 'is_auto_agent','title' => '会员注册默认是代理','config_group' => 'agent','type' => 'boolean','value' => '1'],

            // ["name" => "register_remark", "title" => "注册说明", "config_group" => "register", "type" => "editor", "value" => "<p><strong><span style=\"font-size: 18px;\"><em><span style=\"color: #ccff00;\">金沙娱乐欢迎您</span><span style=\"color: #99ff00;\"> </span></em><span style=\"color: #ff0000;\">【</span><span style=\"color: #ff0000;\"><span style=\"color: #f79f2b;\">site.com</span></span><span style=\"color: #ff0000;\">】</span><span style=\"color: #e67e22;\"> </span><span style=\"color: #ccff00;\"><em>官方直营 大额无忧&nbsp;出款秒到账！</em></span></span></strong><br /><span style=\"color: #ff0000;\">【</span><span style=\"color: #f79f2b;\">1</span><span style=\"color: #ff0000;\">】</span><span style=\"color: #ffff33;\">新注册会员首存</span><span style=\"color: #e67e22;\">，一存即送，</span><span style=\"color: #ffff33;\">100</span><span style=\"color: #e67e22;\">送</span><span style=\"color: #ffff33;\">68</span><span style=\"color: #e67e22;\">！</span><br /><span style=\"color: #ff0000;\">【</span><span style=\"color: #f79f2b;\">2</span><span style=\"color: #ff0000;\">】</span><span style=\"color: #e67e22;\">存款即送</span><span style=\"color: #ffff33;\">3%</span><span style=\"color: #e67e22;\">，最高</span><span style=\"color: #ffff33;\">无上限</span><span style=\"color: #e67e22;\">，支持多种入款方式！</span><br /><span style=\"color: #ff0000;\">【</span><span style=\"color: #f79f2b;\">3</span><span style=\"color: #ff0000;\">】</span><span style=\"color: #e67e22;\">注册</span><span style=\"color: #ffff33;\">下载APP</span><span style=\"color: #e67e22;\">，完成任务赠送</span><span style=\"color: #ffff33;\">28+28+28元</span>&nbsp;&nbsp;<br /><span style=\"color: #ff0000;\">【</span><span style=\"color: #f79f2b;\">4</span><span style=\"color: #ff0000;\">】</span><span style=\"color: #ffff33;\">时时返水：</span><span style=\"color: #e67e22;\">电子棋牌捕鱼，投注1元+，即可时时返水</span><span style=\"color: #ffff33;\">3.0%</span><span style=\"color: #e67e22;\">，想返就返，由您掌控，就是这么任性！</span><br /><span style=\"color: #ff0000;\">【</span><span style=\"color: #f79f2b;\">5</span><span style=\"color: #ff0000;\">】</span><span style=\"color: #ffff33;\">全新代理：</span><span style=\"color: #e67e22;\">佣金日日结，老板天天做。</span><span style=\"color: #ffff33;\">100%稳赚 0投资 0风险</span><span style=\"color: #e67e22;\">。详询代理专员</span><span style=\"color: #ffff33;\">QQ：2304666568</span><br /><span style=\"color: #ff0000;\">【</span><span style=\"color: #f79f2b;\">6</span><span style=\"color: #ff0000;\">】</span><span style=\"color: #e67e22;\">会员账号=永久价值：等级越高礼金更高，更有</span><span style=\"color: #ffff33;\">周周俸禄、月月俸禄、会员日8、18、28</span><span style=\"color: #e67e22;\">送不停！</span></p>", "is_open" => 1,],

            // ["name" => "register_agreement", "title" => "注册协议", "config_group" => "register", "type" => "editor", "value" => "<ul>\n<li>在开户后进行一次有效存款，恭喜您成为【金沙娱乐】有效会员！</li>\n<li>存款免手续费，开户最低入款金额100人民币。</li>\n<li>【金沙娱乐】严禁会员有重复申请账号行为，每位玩家、每一住址 、每一电子邮箱、每一电话号码、相同支付卡/信用卡号码，及共享计算机环境(例如网吧、其他公共用计算机等)只能拥有一个帐户数据。</li>\n<li>【金沙娱乐】是提供互联网投注服务的机构。请会员在注册前参考当地政府的法律，在博彩不被允许的地区，如有会员在【金沙娱乐】注册、下注，为会员个人行为，【金沙娱乐】不负责、承担任何相关责任。</li>\n<li>无论是个人或是团体，如有任何威胁、滥用【金沙娱乐】名义的行为，【金沙娱乐】保留权利取消、收回玩家账号。</li>\n<li>玩家注册信息有争议时，为确保双方利益、杜绝身份盗用行为，【金沙娱乐】保留权利要求客户向我们提供充足有效的档，并以各种方式辨别客户是否符合资格享有我们的任何优惠。</li>\n</ul>\n<p></p>\n<p><span style=\"color: #f00;\">本公司是使用GPK所提供的在线娱乐软件，若发现您在同系统的娱乐城上开设多个会员账户，并进行套利下注；本公司有权取消您的会员账号并将所有下注营利取消！</span></p>", "is_open" => 1],

            // 活动规则
            ["name" => "wheel_rule","title" => "幸运大转盘活动条款与规则","config_group" => "activity_about","type" => "editor","value" => "","is_open" => 1],

            ["name" => "credit_detail","title" => "借呗活动详情","config_group" => "credit","type" => "editor","value" => "","is_open" => 1],
            ["name" => "credit_rule","title" => "借呗信用规则","config_group" => "credit","type" => "editor","value" => "","is_open" => 1],
            ["name" => "credit_xize","title" => "借呗活动细则","config_group" => "credit","type" => "editor","value" => "","is_open" => 1],

            ["name" => "credit_borrow","title" => "借呗借款说明","config_group" => "credit","type" => "editor","value" => "","is_open" => 1],
            ["name" => "credit_lend","title" => "借呗还款说明","config_group" => "credit","type" => "editor","value" => "","is_open" => 1],

            ["name" => "levelup_slot_activity","title" => "电子升级活动详情","config_group" => "levelup_slot","type" => "editor","value" => "","is_open" => 1],
            ["name" => "levelup_slot_example","title" => "电子升级活动举例","config_group" => "levelup_slot","type" => "editor","value" => "","is_open" => 1],
            ["name" => "levelup_slot_level","title" => "电子升级升级说明","config_group" => "levelup_slot","type" => "editor","value" => "","is_open" => 1],
            ["name" => "levelup_slot_month","title" => "电子升级月俸禄说明","config_group" => "levelup_slot","type" => "editor","value" => "","is_open" => 1],

            ["name" => "levelup_live_activity","title" => "真人升级活动详情","config_group" => "levelup_live","type" => "editor","value" => "","is_open" => 1],
            ["name" => "levelup_live_example","title" => "真人升级活动举例","config_group" => "levelup_live","type" => "editor","value" => "","is_open" => 1],
            ["name" => "levelup_live_level","title" => "真人升级升级说明","config_group" => "levelup_live","type" => "editor","value" => "","is_open" => 1],
            ["name" => "levelup_live_month","title" => "真人升级月俸禄说明","config_group" => "levelup_live","type" => "editor","value" => "","is_open" => 1],

            ["name" => "app_tuiguang","title" => '推广教程',"config_group" => "app_content","type" => "editor","value" => "","is_open" => 1,'description' => 'APP端【推广赚钱】 - 【推广教程】'],
            ['name' => 'app_xima','title' => '洗码教程','config_group' => 'app_content','type' => 'editor','value' => '','is_open' => 1,'description' => 'APP端 【洗码】 - 【洗码教程】'],
            ['name' => 'app_fanyong','title' => '返佣比例','config_group' => 'app_content','type' => 'editor','value' => '','is_open' => 1],
            ['name' => 'app_xima_text','title' => '洗码说明','config_group' => 'app_content','type' => 'editor','value' => '','is_open' => 1],

            ['name' => 'notice_type','title' => '提醒模式','config_group' => 'notice','type' => 'select','value' => 'voice_and_alert','data_config' => 'platform.notice_type','is_open' => 1],
            // 音频文件
            ['name' => 'yuebao_audio','title' => '余额宝购买声音提醒','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596799859_QU8KJLi38R.mp3','is_open' => '1'],
            ['name' => 'activity_audio','title' => '活动申请声音提醒','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596799848_A5J7Cea3RN.mp3','is_open' => '1'],
            ['name' => 'message_audio','title' => '站内信声音提醒','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596799758_MaoaedSxRe.mp3','is_open' => '1'],
            ['name' => 'member_audio','title' => '玩家登录声音提醒','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596799437_C0EIdH1mb7.mp3','is_open' => '1'],
            ['name' => 'drawing_audio','title' => '提款声音提醒','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596785588_jmbgGNcLX5.mp3','is_open' => '1'],
            ['name' => 'rechargel_audio','title' => '充值声音提醒','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596785588_jmbgGNcLX5.mp3','is_open' => '1'],
            ['name' => 'agent_apply_audio','title' => '代理申请未处理','config_group' => 'notice','type' => 'file','value' => env('APP_URL').'/storage/uploads/editor/202008/07/editor_1596785588_jmbgGNcLX5.mp3','is_open' => '1'],
            ['name' => 'credit_apply_audio','title' => '借呗申请未处理','config_group' => 'notice','type' => 'file','value' => '','is_open' => 0],
            ['name' => 'credit_overdue_audio','title' => '借呗逾期提醒','config_group' => 'notice','type' => 'file','value' => '','is_open' => 0],
        ];

        /*
        [
            'name' => 'remote_api_domain',
            'title' => '分接API域名',
            'config_group' => 'remote_api',
            'type' => 'text',
            'value' => env('APP_URL').'',
            'is_open' => 0
        ],

        [
            'name' => 'remote_api_id',
            'title' => '分接API的ID',
            'config_group' => 'remote_api',
            'type' => 'text',
            'value' => 'yanshi01',
            'is_open' => 0
        ],

        [
            'name' => 'remote_api_key',
            'title' => '分接API的key',
            'config_group' => 'remote_api',
            'type' => 'text',
            'value' => '6S6DKVg9Xjz63CwIFhvdwnLwBhlPkrQ2',
            'is_open' => 0
        ],

        [
            'name' => 'remote_api_prefix',
            'title' => '分接API的前缀',
            'config_group' => 'remote_api',
            'type' => 'text',
            'value' => 'ac5',
            'is_open' => 0
        ],

        [
            'name' => 'mobile_category_json',
            'title' => '手机首页图标配置',
            'value' => '[{"title":"热门","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Hot.png","weight":"10","is_open":"true"},{"title":"电子","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Slot.png","weight":"9","is_open":"true"},{"title":"真人","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Live.png","weight":"8","is_open":"true"},{"title":"捕鱼","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Fish.png","weight":"7","is_open":"true"},{"title":"棋牌","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Board.png","weight":"6","is_open":"true"},{"title":"体育","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Sport.png","weight":"5","is_open":"true"},{"title":"彩票","icon":"https:\/\/m.ks9170.com\/CdnRedirect\/Multimedia\/Navigation\/Mobile\/tabs\/Lottery.png","weight":"4","is_open":"true"}]',
            'is_open' => 1
        ],

        [
            'name' => 'is_daily_bonus_open',
            'title' => '是否开启签到',
            'value' => 1,
        ],

        [
            'name' => 'is_daily_bonus_auto',
            'title' => '签到是否自动领奖',
            'value' => 0
        ],

        [
            'name' => 'redbag_min_money',
            'title' => '红包最小金额',
            'config_group' => 'redbag',
            'type' => 'text',
            'value' => '2'
        ],

        [
            'name' => 'redbag_max_money',
            'title' => '红包最大金额',
            'config_group' => 'redbag',
            'type' => 'text',
            'value' => '10'
        ],

        [
            'name' => 'redbag_day_times',
            'title' => '每日抢红包次数',
            'config_group' => 'redbag',
            'type' => 'text',
            'value' => '3',
            'is_open' => 0
        ]
    ];
    */

        foreach ($data as $item) {
            SystemConfig::create($item);
        }

        // vip独有参数
        $params = [
            ['name' => 'vip1_is_register_sms_open','title' => '是否开启注册短信验证','config_group' => 'register','type' => 'boolean','value' => '1','lang' => 'common'],

            ['name' => 'service_link','title' => '客服链接','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com/zh_cn','is_open' => '1','lang' => 'zh_cn'],
            ['name' => 'service_link','title' => '客服链接','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com/vi','is_open' => '1','lang' => 'vi'],
            ['name' => 'service_link','title' => '客服链接','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com/th','is_open' => '1','lang' => 'th'],
            ['name' => 'service_link','title' => '客服链接','config_group' => 'system','type' => 'text','value' => 'http://www.baidu.com/en','is_open' => '1','lang' => 'en'],

            ['name' => 'service_line','title' => 'Line','config_group' => 'system','type' => 'text','value' => 'Line CN','is_open' => '1','lang' => 'zh_cn'],
            ['name' => 'service_line','title' => 'Line','config_group' => 'system','type' => 'text','value' => 'Line VI','is_open' => '1','lang' => 'vi'],
            ['name' => 'service_line','title' => 'Line','config_group' => 'system','type' => 'text','value' => 'Line TH','is_open' => '1','lang' => 'th'],
            ['name' => 'service_line','title' => 'Line','config_group' => 'system','type' => 'text','value' => 'Line EN','is_open' => '1','lang' => 'en'],

            ['name' => 'service_line_pic','title' => 'Line二维码','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202004/28/config_1588059335_9OigwNz16O.png','is_open' => '1','lang' => 'zh_cn'],
            ['name' => 'service_line_pic','title' => 'Line二维码','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202004/28/config_1588059335_9OigwNz16O.png','is_open' => '1','lang' => 'vi'],
            ['name' => 'service_line_pic','title' => 'Line二维码','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202004/28/config_1588059335_9OigwNz16O.png','is_open' => '1','lang' => 'th'],
            ['name' => 'service_line_pic','title' => 'Line二维码','config_group' => 'system','type' => 'picture','value' => env('APP_URL').'/storage/uploads/config/202004/28/config_1588059335_9OigwNz16O.png','is_open' => '1','lang' => 'en'],

            ['name' => 'service_phone','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话CN','is_open' => '1','lang' => 'zh_cn'],
            ['name' => 'service_phone','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话VI','is_open' => '1','lang' => 'vi'],
            ['name' => 'service_phone','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话TH','is_open' => '1','lang' => 'th'],
            ['name' => 'service_phone','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话EN','is_open' => '1','lang' => 'en'],

            ['name' => 'service_phone2','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话CN2','is_open' => '1','lang' => 'zh_cn'],
            ['name' => 'service_phone2','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话VI2','is_open' => '1','lang' => 'vi'],
            ['name' => 'service_phone2','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话TH2','is_open' => '1','lang' => 'th'],
            ['name' => 'service_phone2','title' => '电话','config_group' => 'system','type' => 'text','value' => '电话EN2','is_open' => '1','lang' => 'en'],

            ['name' => 'service_skype','title' => 'Skype','config_group' => 'admin','type' => 'text','value' => 'Skype','is_open' => '1','lang' => 'common'],
            ['name' => 'service_telegram','title' => 'Telegram','config_group' => 'admin','type' => 'text','value' => 'Telegram','is_open' => '1','lang' => 'common'],

            ['name' => 'is_backend_google_auth','title' => '后台登录是否开启谷歌验证码','config_group' => 'register','type' => 'boolean','value' => '0','is_open' => '1','lang' => 'common'],

            // 2021-04-30 新增 前端登录是否需要验证码(register), [平台信息管理] LOGO跳转链接，Skype,TG,Email
            ['name' => 'vip1_is_login_captcha_open','title' => '是否开启登录验证码','config_group' => 'register','type' => 'boolean','value' => '1','lang' => 'common'],
            ['name' => 'service_logo_link','title' => 'LOGO跳转链接','config_group' => 'admin','type' => 'text','value' => 'http://www.baidu.com','is_open' => '1','lang' => 'common'],

            // 2021-05-08 新增默认语种设置，前端选择开启哪些语种设置
            ['name' => 'vip1_lang_default','title' => '前端默认语种','config_group' => 'language','type' => 'text','value' => 'zh_cn','lang' => 'common'],
            ['name' => 'vip1_lang_fields','title' => '前端开启语种','config_group' => 'language','type' => 'text','value' => '{"zh_cn":"Tiếng Trung Quốc","zh_hk":"Tiếng Hồng Kông","en":"Tiếng Anh","th":"Tiếng Thái","vi":"Việt Nam"}','lang' => 'common'],
        ];

        foreach ($params as $item) {
            SystemConfig::create($item);
        }
    }
}
