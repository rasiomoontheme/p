<?php

return [
    'activity_type' => [
        1 => '返水活动',
        2 => '红利活动',
        3 => '充值活动',
        4 => '展示活动'
    ],

    'activity_is_apply' => [
        1 => '需要申请',
        0 => '无需申请'
    ],

    'activity_apply_type' => [
        0 => '无需申请',
        1 => '联系客服申请',
        2 => '活动大厅申请',
        3 => '跳转查看详情'
    ],

    'activity_apply_field' => [
        'member_name' => '会员用户名',
        'recharge_money' => '存款金额',
        'game_type' => '游戏类型',
        'api_game_type' => '游戏子分类',//(接口 + 游戏类型),
        'bill_no' => '注单号码',
    ],

    'activity_apply_status' => [
        0 => '待审核',
        1 => '审核通过',
        2 => '审核不通过',
        3 => '优惠已下发'
    ],

    'is_open' => [
        1 => 'Bật',
        0 => 'Tắt'
    ],

    'is_read' => [
        1 => '已读',
        0 => '未读'
    ],

    'boolean' => [
        1 => '是',
        0 => '否'
    ],

    'gender' => [
        0 => '男',
        1 => '女'
    ],

    'member_status' => [
        1 => '启用',
        -1 => '禁用',
        -2 => '踢下线'
    ],

    'style_isopen' => [
        1 => 'label label-success',
        0 => 'label label-danger'
    ],

    'style_transfer_type' => [
        1 => 'label label-success',
        2 => 'label label-danger'
    ],

    'style_boolean' => [
        1 => 'label label-dark',
        0 => 'label label-secondary'
    ],

    'style_status' => [
        1 => 'label label-dark',
        -1 => 'label label-secondary'
    ],

    'style_label' => [
        "label-default",
        "label-primary",
        "label-success",
        "label-info",
        "label-warning",
        "label-danger",
        "label-dark",
        "label-secondary",
        "label-purple",
        "label-pink",
        "label-cyan",
        "label-yellow",
        "label-brown",
    ],

    'member_money_type' => [
        'money' => '中心钱包余额',
        'fs_money' => '返水钱包余额',
        'total_money' => '平台总投注额',
        'score' => '会员积分',
        'ml_money' => '码量余额',
        'total_credit' => '借呗总额度',
        'used_credit' => '借呗已用额度'
    ],

    'member_money_operate_type' => [
        1 => '管理员操作',
        2 => '系统赠送',
        3 => '游戏转入 / 转出',
        4 => '返水发放',
        5 => '签到活动领取',
        6 => '充值活动',
        7 => '平台红利',
        8 => '抢红包',
        9 => '充值 / 提现',
        10 => '充值赠送',
        11 => '拒绝提现退还',
        12 => '转入游戏失败退还',
        13 => '活动发放',
        14 => '代理佣金',
        15 => '转盘抽奖',
        16 => '购买理财产品',
        17 => '理财产品分红',
        18 => '掉单退还/扣除',
        19 => '理财产品赎回',
        20 => '晋级奖励',
        21 => '周俸禄',
        22 => '月俸禄',
        23 => '借呗借款',
        24 => '借呗还款',
        25 => '每日礼金',
        26 => '每周礼金',
        27 => '每月礼金',
        28 => '每年礼金',
        29 => '晋升礼金',
    ],

    'levelup_types' => [
        1 => '存款额达标',
        2 => '投注额达标',
        3 => '任一个达标',
        4 => '所有达标',
    ],

    'money_number_type' => [
        1 => '增加',
        -1 => '减少'
    ],

    'money_number_style' => [
        1 => 'label-success',
        -1 => 'label-danger'
    ],

    'bank_type' => [
        /*
        "CDB" => "国家开发银行",
        "ICBC" => "中国工商银行",
        "ABC" => "中国农业银行",
        "BOC" => "中国银行",
        "CCB" => "中国建设银行",
        "PSBC" => "中国邮政储蓄银行",
        "COMM" => "交通银行",
        "CMB" => "招商银行",
        "SPDB" => "上海浦东发展银行",
        "CIB" => "兴业银行",
        "HXBANK" => "华夏银行",
        "GDB" => "广东发展银行",
        "CMBC" => "中国民生银行",
        "CITIC" => "中信银行",
        "CEB" => "中国光大银行",
        "EGBANK" => "恒丰银行",
        "CZBANK" => "浙商银行",
        "BOHAIB" => "渤海银行",
        "SPABANK" => "平安银行",
        "SHRCB" => "上海农村商业银行",
        "YXCCB" => "玉溪市商业银行",
        "YDRCB" => "尧都农商行",
        "BJBANK" => "北京银行",
        "SHBANK" => "上海银行",
        "JSBANK" => "江苏银行",
        "HZCB" => "杭州银行",
        "NJCB" => "南京银行",
        "NBBANK" => "宁波银行",
        "HSBANK" => "徽商银行",
        "CSCB" => "长沙银行",
        "CDCB" => "成都银行",
        "CQBANK" => "重庆银行",
        "DLB" => "大连银行",
        "NCB" => "南昌银行",
        "FJHXBC" => "福建海峡银行",
        "HKB" => "汉口银行",
        "WZCB" => "温州银行",
        "QDCCB" => "青岛银行",
        "TZCB" => "台州银行",
        "JXBANK" => "嘉兴银行",
        "CSRCB" => "常熟农村商业银行",
        "NHB" => "南海农村信用联社",
        "CZRCB" => "常州农村信用联社",
        "H3CB" => "内蒙古银行",
        "SXCB" => "绍兴银行",
        "SDEB" => "顺德农商银行",
        "WJRCB" => "吴江农商银行",
        "ZBCB" => "齐商银行",
        "GYCB" => "贵阳市商业银行",
        "ZYCBANK" => "遵义市商业银行",
        "HZCCB" => "湖州市商业银行",
        "DAQINGB" => "龙江银行",
        "JINCHB" => "晋城银行JCBANK",
        "ZJTLCB" => "浙江泰隆商业银行",
        "GDRCC" => "广东省农村信用社联合社",
        "DRCBCL" => "东莞农村商业银行",
        "MTBANK" => "浙江民泰商业银行",
        "GCB" => "广州银行",
        "LYCB" => "辽阳市商业银行",
        "JSRCU" => "江苏省农村信用联合社",
        "LANGFB" => "廊坊银行",
        "CZCB" => "浙江稠州商业银行",
        "DYCB" => "德阳商业银行",
        "JZBANK" => "晋中市商业银行",
        "BOSZ" => "苏州银行",
        "GLBANK" => "桂林银行",
        "URMQCCB" => "乌鲁木齐市商业银行",
        "CDRCB" => "成都农商银行",
        "ZRCBANK" => "张家港农村商业银行",
        "BOD" => "东莞银行",
        "LSBANK" => "莱商银行",
        "BJRCB" => "北京农村商业银行",
        "TRCB" => "天津农商银行",
        "SRBANK" => "上饶银行",
        "FDB" => "富滇银行",
        "CRCBANK" => "重庆农村商业银行",
        "ASCB" => "鞍山银行",
        "NXBANK" => "宁夏银行",
        "BHB" => "河北银行",
        "HRXJB" => "华融湘江银行",
        "ZGCCB" => "自贡市商业银行",
        "YNRCC" => "云南省农村信用社",
        "JLBANK" => "吉林银行",
        "DYCCB" => "东营市商业银行",
        "KLB" => "昆仑银行",
        "ORBANK" => "鄂尔多斯银行",
        "XTB" => "邢台银行",
        "JSB" => "晋商银行",
        "TCCB" => "天津银行",
        "BOYK" => "营口银行",
        "JLRCU" => "吉林农信",
        "SDRCU" => "山东农信",
        "XABANK" => "西安银行",
        "HBRCU" => "河北省农村信用社",
        "NXRCU" => "宁夏黄河农村商业银行",
        "GZRCU" => "贵州省农村信用社",
        "FXCB" => "阜新银行",
        "HBHSBANK" => "湖北银行黄石分行",
        "ZJNX" => "浙江省农村信用社联合社",
        "XXBANK" => "新乡银行",
        "HBYCBANK" => "湖北银行宜昌分行",
        "LSCCB" => "乐山市商业银行",
        "TCRCB" => "江苏太仓农村商业银行",
        "BZMD" => "驻马店银行",
        "GZB" => "赣州银行",
        "WRCB" => "无锡农村商业银行",
        "BGB" => "广西北部湾银行",
        "GRCB" => "广州农商银行",
        "JRCB" => "江苏江阴农村商业银行",
        "BOP" => "平顶山银行",
        "TACCB" => "泰安市商业银行",
        "CGNB" => "南充市商业银行",
        "CCQTGB" => "重庆三峡银行",
        "XLBANK" => "中山小榄村镇银行",
        "HDBANK" => "邯郸银行",
        "KORLABANK" => "库尔勒市商业银行",
        "BOJZ" => "锦州银行",
        "QLBANK" => "齐鲁银行",
        "BOQH" => "青海银行",
        "YQCCB" => "阳泉银行",
        "SJBANK" => "盛京银行",
        "FSCB" => "抚顺银行",
        "ZZBANK" => "郑州银行",
        "SRCB" => "深圳农村商业银行",
        "BANKWF" => "潍坊银行",
        "JJBANK" => "九江银行",
        "JXRCU" => "江西省农村信用",
        "HNRCU" => "河南省农村信用",
        "GSRCU" => "甘肃省农村信用",
        "SCRCU" => "四川省农村信用",
        "GXRCU" => "广西省农村信用",
        "SXRCCU" => "陕西信合",
        "WHRCB" => "武汉农村商业银行",
        "YBCCB" => "宜宾市商业银行",
        "KSRB" => "昆山农村商业银行",
        "SZSBK" => "石嘴山银行",
        "HSBK" => "衡水银行",
        "XYBANK" => "信阳银行",
        "NBYZ" => "鄞州银行",
        "ZJKCCB" => "张家口市商业银行",
        "XCYH" => "许昌银行",
        "JNBANK" => "济宁银行",
        "CBKF" => "开封市商业银行",
        "WHCCB" => "威海市商业银行",
        "HBC" => "湖北银行",
        "BOCD" => "承德银行",
        "BODD" => "丹东银行",
        "JHBANK" => "金华银行",
        "BOCY" => "朝阳银行",
        "LSBC" => "临商银行",
        "BSB" => "包商银行",
        "LZYH" => "兰州银行",
        "BOZK" => "周口银行",
        "DZBANK" => "德州银行",
        "SCCB" => "三门峡银行",
        "AYCB" => "安阳银行",
        "ARCU" => "安徽省农村信用社",
        "HURCB" => "湖北省农村信用社",
        "HNRCC" => "湖南省农村信用社",
        "NYNB" => "广东南粤银行",
        "LYBANK" => "洛阳银行",
        "NHQS" => "农信银清算中心",
        "CBBQS" => "城市商业银行资金清算中心",
        */
        "USDT" => "USDT虚拟币",
        "ICBC" => "中国工商银行",
        "ABC" => "中国农业银行",
        "COMM" => "交通银行",
        "CCB" => "中国建设银行",
        "CMB" => "招商银行",
        "CEB" => "中国光大银行",
        "GDB" => "广东发展银行",
        "PSBC" => "中国邮政储蓄银行",
        "CMBC" => "中国民生银行",
        "SPDB" => "上海浦东发展银行",
        "BOC" => "中国银行",
        "SPABANK" => "平安银行",
        "CIB" => "兴业银行",
        "CITIC" => "中信银行",
        "BJBANK" => "北京银行",
        "SHBANK" => "上海银行",
        "HXBANK" => "华夏银行",
        "BOHAIB" => "渤海银行",
        "GCB" => "广州银行",
        "HZCB" => "杭州银行",
        "CZBANK" => "浙商银行",
        "NBBANK" => "宁波银行",
        "WZCB" => "温州银行",
        "NJCB" => "南京银行",
        "BJRCB" => "北京农村商业银行",
        "SDEB" => "顺德农商银行",
        "OTHER" => "其它银行"
    ],

    'bank_urls' => [
        'ICBC' => 'http://www.icbc.com.cn/',
        "ABC" => "http://www.abchina.com/",
        "COMM" => "http://www.bankcomm.com/",
        "CCB" => "http://www.ccb.com/",
        "CMB" => "http://www.cmbchina.com/",
        "CEB" => "http://www.cebbank.com/",
        "GDB" => "http://www.cgbchina.com.cn/",
        "PSBC" => "http://www.psbc.com/",
        "CMBC" => "http://www.cmbc.com.cn/",
        "SPDB" => "http://www.spdb.com.cn/",
        "BOC" => "http://www.boc.cn/",
        "SPABANK" => "http://bank.pingan.com/",
        "CIB" => "http://www.cib.com.cn/",
        "CITIC" => "http://bank.ecitic.com/",
        "BJBANK" => "http://www.bankofbeijing.com.cn/",
        "SHBANK" => "http://www.bankofshanghai.com/",
        "HXBANK" => "http://www.hxb.com.cn/",
        "BOHAIB" => "http://www.cbhb.com.cn/",
        "GCB" => "http://www.gzcb.com.cn/",
        "HZCB" => "http://www.hccb.com.cn/",
        "CZBANK" => "https://e.czbank.com/APPINSPECT/index.jsp",
        "NBBANK" => "http://www.nbcb.com.cn/",
        "WZCB" => "http://www.wzcb.com.cn/",
        "NJCB" => "http://www.njcb.com.cn/",
        "BJRCB" => "http://www.bjrcb.com/",
        "SDEB" => "http://www.sdebank.com/",
        "OTHER" => ""
    ],

    'card_type' => [
        1 => '储蓄卡',
    ],

    /**
    'usdt_type' => [
    'Omni','ERC20','TRC20'
    ],
     **/

    'agent_assign_types' => [
        1 => '重新创建',
        2 => '沿用旧代理'
    ],

    'feedback_type' => [
        1 => '平台问题',
        2 => '财务问题',
        3 => '提供建议'
    ],

    'about_type' => [
        1 => "关于我们",
        2 => "存款帮助",
        3 => "取款帮助",
        4 => "常见问题",
        5 => "合作伙伴",
        6 => "联营协议",
        7 => "签到说明",
        8 => "联系我们"
    ],

    'game_type' => [
        1 => '真人',
        2 => '捕鱼',
        3 => '电子',
        4 => '彩票',
        5 => '体育',
        6 => '棋牌',
        7 => '其他',
        99 => '系统彩票'
    ],

    /**
    'record_flag' => [
    1 => '已结算',
    0 => '未结算',
    -2 => '已撤单'
    ],
     */

    'gamerecord_status' => [
        // ag|Flag = -8:取消指定局注單,-9:取消指定注單
        // GD|BetResult = Cancel(取消),Voided(無效)
        // NewBBIN|（电子）Result -1：注销
        // NewBBIN|（真人）ResultType -1：注销
        // NewBBIN|（捕鱼）Result C:注销
        // NewBBIN|（体育）Result N:已取消,D:未接受,C:注销, F:非法下注,SC:系统注销,DC:危险球注销
        // allbet|state = 1
        // SABA|TicketStatus void:作廢,reject:取消,refund:退款,waiting:未接受
        // SS|Result C:取消, CM:賽事取消, R:拒絕
        'N' => '已取消',
        'X' => '未结算',
        /**
        'W' => '赢',
        'L' => '输',
        'LW' => '赢一半',
        'LL' => '输一半',
        '0' => '平手',
        'S' => '等待中',
        'D' => '未接受',
        'C' => '注销',
        'CM' => '赛事取消',
        'F' => '非法下注',
        'SC' => '系统注销',
        'DC' => '危险球注销',
         **/

        // BGLive|OrderStatus = 2:赢,3:和,4:输
        // FastBet|BetState = 3:輸, 4:贏
        // GD|BetResult = Win(贏),Loss(輸),Tie(和)
        // LH|ResultStatus = WIN:赢 LOSS:输 DRAW:和
        // NewBBIN|电子：Result = 1：赢、200：输
        // NewBBIN|真人 ResultType 显示空白表示 已结算
        // NewBBIN|（捕鱼）Result W:赢,L:输
        // NewBBIN|（体育）Result W:赢,L:输,LW:赢一半,LL:输一半,0:平手
        // OG|WinloseResult win : 赢 lose : 输 tie : 和
        // SABA|TicketStatus lose:輸,won:贏,half won:贏了下注額一半,half loss:輸了下注額一半,draw:平局
        // SS|Result N:確認, WH:贏半, LH:輸半, L:輸, W:贏, D:和
        // VR|State 2:未中奖, 3:中奖
        'COMPLETE' => '已结算',
        // 'MODIFY' => '已修改',

        // ag|Flag = 4:撤單套現
        // BGLive|OrderStatus = 5:用户取消,6:过期,7:系统取消
        // IG|Status = 4:撤銷
        // IMSport|isCancelled 已撤销
        // LH|ResultStatus = CANCELLED = 取消
        // VR|State 1:撤单
        'CANCEL' => '已撤销',
        /**
        'EQUAL' => '平手',
        'REFUND' => '退款',
        'OUTDATE' => '过期'
         */
    ],

    'tcg_game_type' => [
        'RNG' => 'RNG',
        'LIVE' => 'LIVE',
        'PVP' => 'PVP',
        'FISH' => 'FISH'
    ],

    'tcg_game_type_style' => [
        'RNG' => 'label-primary',
        'LIVE' => 'label-success',
        'PVP' => 'label-info',
        'FISH' => 'label-warning'
    ],

    'client_type' => [
        0 => '手机电脑都支持',
        1 => 'pc',
        2 => 'phone'
    ],

    'tag_type' => [
        'hot' => '热门',
        'recommend' => '推荐',
        'new' => '最新',
    ],

    'apply_status' => [
        0 => '待审核',
        1 => '审核通过',
        2 => '审核不通过'
    ],

    'recharge_status' => [
        1 => '待确认',
        2 => '充值成功',
        3 => '充值失败'
    ],

    'drawing_status' => [
        1 => '待确认',
        2 => '提款成功',
        3 => '提款失败'
    ],

    'recharge_type' => [
        1 => '支付宝',
        2 => '微信',
        3 => '银行转账',
        4 => '第三方支付',
        5 => 'QQ',
        6 => '快捷-微信',
        7 => '快捷-支付宝'
    ],

    'payment_type' => [
        'online_alipay' => 'Thanh toán qua Alipay (thanh toán trực tuyến)',
        'online_wechat' => 'WeChat Pay (Thanh toán trực tuyến)',
        'online_union_quick' => 'UnionPay Express (Thanh toán trực tuyến)',
        'online_union_scan' => 'Mã quét UnionPay (thanh toán trực tuyến)',
        'company_bankpay' => 'Chuyển khoản qua thẻ ngân hàng (tiền gửi của công ty)',
        'company_alipay' => 'Thanh toán qua Alipay (tiền gửi công ty)',
        'company_wechat' => 'Thanh toán công khai WeChat (tiền gửi công ty)',
        'online_cgpay' => 'Thanh toán CGPay (thanh toán trực tuyến)',
        'company_usdt' => 'Thanh toán USDT (tiền gửi công ty)',
        'online_usdt' => 'Thanh toán USDT (thanh toán trực tuyến)',
    ],

    'member_money_type_style' => [
        'money' => "label-primary",
        'fs_money' => 'label-success',
        'total_money' => 'label-info',
        'score' => 'label-warning',
        'ml_money' => 'label-yellow',
        'total_credit' => 'label-purple',
        'used_credit' => 'label-brown'
    ],

    //平台转账类型
    'transfer_type' => [
        1 => '转入游戏',
        2 => '转出游戏'
    ],

    // 消息可见性类型
    'message_visible_type' => [
        1 => '所有会员可见',
        2 => '单个会员可见',
        3 => '管理员可见'
    ],

    // 消息发送类型
    'message_send_type' => [
        1 => '管理员发送',
        2 => '会员发送'
    ],

    'message_status' => [
        0 => '待回复',
        1 => '已回复',
        2 => '标记回复'
    ],

    // 签到类型 负数表示设置，正数表示领奖
    'daily_bonus_type' => [
        -2 => '连续签到奖励',
        -1 => '累计签到奖励',
        0 => '普通签到',
        1 => '累计签到领奖',
        2 => '连续签到领奖'
    ],

    'daily_bonus_state' => [
        0 => '待确认',
        1 => '已确认',
        -1 => '已拒绝'
    ],

    'member_log_type' => [
        1 => '会员登录',
        2 => '会员登出',
        3 => '会员操作',
        4 => '代理后台登录',
        5 => '代理后台登出',
        6 => '会员转入接口异常',
        7 => '会员短信注册验证'
    ],

    'task_condition_types' => [
        1 => '单笔充值',
        2 => '累计充值',
        3 => '累计提款',
        4 => '累计盈利',
        5 => '累计亏损',
        6 => '累计总流水',
    ],

    'task_award_type' => [
        1 => '称号奖励',
        2 => '金额奖励',
        3 => '返点奖励',
        4 => '信用额度奖励'
    ],

    'level_award_type' => [
        'level_award' => '等级礼金',
        'week_award' => '周俸禄',
        'month_award' => '月俸禄',
        'name_award' => '称号奖励',
        'borrow_award' => '信用额度奖励'
    ],

    'fs_type' => [
        1 => '系统反水等级',
        2 => '会员反水等级'
    ],

    'member_task_status' => [
        1 => '领取中',
        2 => '已领完'
    ],

    'agent_rate_type' => [
        3 => '代理/会员点位',
        4 => '代理下线的默认点位'
    ],

    'config_money_type' => [
        'money' => '中心钱包',
        'fs_money' => '返水钱包',
    ],

    'arbitrage_conditions' => [
        'ip' => '同IP',
        'psw' => '同密码',
        'phone' => '同电话号码',
        'card' => '同银行户名'
    ],

    'wheel_awards' => [
        1 => ['desc' => '500送100优惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/2ead44b68b93b0677b2cffe04cdf08d3.png'],
        2 => ['desc' => '28元','type' => 1,'pic' => 'web/images/wheel/zh_cn/34bacd7183d7e2b95845d2c48e27d10c.png'],
        3 => ['desc' => '100送20优惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/bd8dd02713d3ac8705b38f1602de04a4.png'],
        4 => ['desc' => '58元','type' => 1,'pic' => 'web/images/wheel/zh_cn/96b56053b67e5216b8d2c07562344e56.png'],
        5 => ['desc' => '港澳五日游','type' => 3,'pic' => 'web/images/wheel/zh_cn/295c5965c9ed549937c3cf5942ccb897.png'],
        6 => ['desc' => '88元','type' => 1,'pic' => 'web/images/wheel/zh_cn/11f2d5122249b7d1adb166ceffdb197e.png'],
        7 => ['desc' => '5000送1000优惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/b07eedbdf8cdf5b89b8d004d0b8e3f37.png'],
        8 => ['desc' => '18元','type' => 1,'pic' => 'web/images/wheel/zh_cn/447075995668a5e04b0bf60885be216e.png'],
        9 => ['desc' => 'IPHONE 11 PRO MAX 512GB','type' => 3,'pic' => 'web/images/wheel/zh_cn/957740284f61bba05611061782f8d639.png'],
        10 => ['desc' => '1000送300优惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/9019cab46b10bc82ab6ba6a94d6beb3c.png'],
        11 => ['desc' => '东南亚7日豪华游','type' => 3,'pic' => 'web/images/wheel/zh_cn/835cfc99c3e77309c238612972996253.png'],
        12 => ['desc' => '8元','type' => 1,'pic' => 'web/images/wheel/zh_cn/939d617c97f3a372980f3362245b3b5c.png']
    ],

    'wheel_status' => [
        1 => '待发放',
        2 => '已发放',
        3 => '直接发放'
    ],

    'yuebao_settle_type' => [
        0 => '单次结算',
        1 => '循环结算'
    ],

    'yuebao_member_status' => [
        0 => '进行中',
        1 => '已结束'
    ],

    'quick_url_type' => [
        'web' => 'WEB页面',
        'index' => '单独页面',
        'mobile' => '手机页面'
    ],

    'adv_vertical' => [
        'top' => 'Trên',
        'bottom' => 'Dưới',
    ],

    'adv_horizontal' => [
        'left' => 'Trái',
        'right' => 'Phải'
    ],

    'adv_effect' => [
        'hover' => 'hover'
    ],

    "notice_type" => [
        "voice" => "仅声音提醒",
        "alert" => "仅弹窗提醒",
        "voice_and_alert" => "声音提醒和弹窗提醒"
    ],

    "is_online" => [
        1 => '在线',
        0 => '离线'
    ],

    "credit_type" => [
        'borrow' => '借款',
        'lend' => '还款'
    ],

    "credit_status" => [
        1 => '待确认',
        2 => '借款成功',
        3 => '拒绝借款',
        4 => '还款成功'
    ],

    'notice_group' => [
        'main' => '首页公告',
        'credit' => '借呗公告',
        'pc' => '电脑弹窗',
        'mobile' => '手机弹窗'
    ],

    'usdt_type' => [
        'omni' => 'Omni',
        'erc' => 'ERC20',
        'trc' => 'TRC20'
    ],

    'no_register_api' => [
        'IG','TH','RMG','KY'
    ],

    'language_type' => [
        'zh_cn' => 'Tiếng Trung',
        'zh_hk' => 'Tiếng Hồng Kông',
        'en' => 'Tiếng Anh',
        'th' => 'Tiếng Thái',
        'vi' => 'Tiếng Việt'
    ],

    'lang_fields' => [
        'common' => 'Phổ thông',
        'zh_cn' => 'Tiếng Trung',
        'zh_hk' => 'Tiếng Hồng Kông',
        'en' => 'Tiếng Anh',
        'th' => 'Tiếng Thái',
        'vi' => 'Tiếng Việt'
    ],

    'lang_select' => [
        'zh_cn' => 'Tệ',
        'zh_hk' => 'HKD',
        'en' => 'USD',
        'th' => 'Baht',
        'vi' => 'VNĐ'
    ],

    'language_type_cn' => [
        'common' => 'Ngôn ngữ thông dụng',
        'zh_cn' => 'Tiếng Trung',
        'zh_hk' => 'Tiếng Hồng Kông',
        'en' => 'Tiếng Anh',
        'th' => 'Tiếng Thái',
        'vi' => 'Tiếng Việt'
    ],

    'api_lang' => [
        'zh_cn' => 'zh-CN',
        'zh_hk' => 'zh-tw',
        'th' => 'th',
        'vi' => 'vi',
        'en' => 'en'
    ],

    'currency_type' => [
        'zh_cn' => 'Nhân dân tệ (CNY)',
        'zh_hk' => 'Đô la Hồng Kông (HKD)',
        'th' => 'Bạt Thái Lan (Baht - THB)',
        'vi' => 'Đồng việt nam (Đồng việt nam - VND)',
        'en' => 'Đô la (U.S. dollar - USD)'
    ],

    'register_setting_field' => [
        'isInviteCodeRequired' => '电脑版是否需要填写邀请码',
        'isRealNameRequred' => '电脑版是否需要填写真实姓名',
        'isPhoneRequired' => '电脑版是否需要填写手机号码',
        'isCaptchaRequired' => '电脑版是否需要填写验证码',

        'isInviteCodeRequired_mobile' => '手机版是否需要填写邀请码',
        'isRealNameRequred_mobile' => '手机版是否需要填写真实姓名',
        'isPhoneRequired_mobile' => '手机版是否需要填写手机号码',
        'isCaptchaRequired_mobile' => '手机版是否需要填写验证码',
    ],

    'web_nav' => [
        "index" => "首页",
        "slot" => "电子游艺",
        "poker" => "棋牌游戏",
        "casino" => "视讯直播",
        "lottery" => "彩票游戏",
        "sport" => "体育赛事",
        "fish" => "捕鱼游戏",
        // "e_sport" => "电子竞技",
        "activity" => "优惠活动",
        "app" => "手机APP",
        "service" => "在线客服"
    ],

    'hot_game_place_type' => [
        1 => '热门游戏版块',
        2 => '首页游戏分类',
    ],

    'bet_histories_status' => [
        1 => 'Win',
        2 => 'Lost',
        3 => 'Draw',
    ],

    'game_type_code' => [
        'CB' => 'CARD & BOARDGAME',
        'ES' => 'E-GAMES',
        'SB' => 'SPORTBOOK',
        'LC' => 'LIVE-CASINO',
        'SL' => 'SLOTS',
        'LK' => 'LOTTO',
        'FH' => 'FISH HUNTER',
        'PK' => 'POKER',
        'MG' => 'MINI GAME',
        'OT' => 'OTHERS',
    ],

    'game_type_other' => [
        1 => 'Live casino',
        2 => 'Bắn cá',
        3 => 'Slot Game',
        4 => 'Xổ số',
        5 => 'Thể thao',
        6 => '3D& game bài',
        7 => 'Game khác',
        8 => 'Video Poker',
        9 => 'Casual',
        10 => 'Table Game',
        11 => 'LK',
        12 => 'Video Slots',
        13 => 'Jackpot Slots',
        14 => 'POP Slots',
        15 => 'Slot Machines',
        16 => 'Mini games',
        17 => 'Live Games',
        18 => 'SL',
        99 => 'Xổ số hệ thống'
    ],

    'domain_api' => 'http://fetch.336699bet.com',
];
