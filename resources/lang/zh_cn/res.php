<?php

return [
    'common' => [
        'operate' => '操作',
        'select_default' => '--请选择--',
        'page_notice' => '<strong>注意：</strong> 需点击右侧刷新按钮文字才能刷新本页',
        'title' => '后台管理系统',
        "lang" => "语言",

        'created_at' => '创建时间',
        'updated_at' => '更新时间',
        'total' => '总共',
        'count' => '条',
        'sum' => '总合计',
        'upload_image' => '上传图片',
        'quick_operate' => '快捷操作',

        'member_id' => '会员账号',
        'member_name' => '会员账号',
        'user_id' => '管理员账号',
        'api_id' => '接口账号',
        'agent_id' => '代理账号',
        'top_id' => '上级代理',
        'game_type' => '游戏类型',
        'deleted' => '已删除',

        'login_notice' => '登录提醒',
        'inner' => '内部',

        'recharge_list' => '充值列表',
        'drawing_list' => '提款列表',
        'user_info' => '个人信息',
        'modify_pwd' => '修改密码',
        'lang_title' => '系统语言/Language',
        'fix_url' => '修复图片地址',
        'fix_url_notice' => '确定进行修复图片操作吗？修复前的地址请填在【系统配置 - 网站主域名】，修复后的地址请填在网站根目录的.env文件的“APP_URL”字段；整个过程耗时较长，请耐心等待',
        'logout' => '退出登录',
        'logout_title' => '确定要退出系统吗',
        'user_google' => '绑定谷歌验证码',
        'color_header' => '头部',
        'color_sidebar' => '侧边栏',
        'no_limit' => "无限制",
        'lang_notice' => '由于系统线路涉及到多语言/币种，需要先选择“语言/币种”才能查询数据'
    ],

    'base' => [
        'add_success' => '新增数据成功',
        'add_fail' => '新增数据失败',
        'update_success' => '更新数据成功',
        'update_fail' => '更新数据失败',
        'delete_success' => '删除成功',
        'delete_fail' => '删除失败',
        'save_success' => '保存成功',
        'save_fail' => '保存失败',
        'operate_success' => '操作成功',
        'operate_fail' => '操作失败，请重试',
        'operate_msg' => '操作失败：',
        'batch_add_success' => '批量添加成功',
        'batch_add_fail' => '批量添加失败',

        'account_forbidden' => '该账号被禁用',
        'login_success' => '登录成功',
        'illegal_operation' => '非法操作',
        'item_select_required' => '请选择需要操作的列',
    ],

    'upload' => [
        'file_type_error' => '无法识别文件类型',
        'file_size_error' => '上传文件太大,无法上传',
        'image_file_required' => '请选择需要上传的图片',
        'image_ext_required' => '请上传图片格式的文件',
        'file_required' => '请选择需要上传的文件',
        'file_ext_error' => '请上传指定格式的文件',
        'image_size_get_error' => '获取文件尺寸出错',
        'file_delete_error' => '文件删除失败',
        'file_upload_success' => '文件上传成功'
    ],

    'notice' => [
        'recharge_title' => '充值列表',
        'recharge_notice' => '<p>您有 <span id="rechargeNum" data-name="rechargel_audio" data-sec="0" >0</span> 条汇款请求未处理</p>',
        'drawing_title' => '提款列表',
        'drawing_notice' => '<p>您有 <span id="drawingNum" data-name="drawing_audio" data-sec="2">0</span> 条提款请求未处理</p>',
        'message_title' => '站内信列表',
        'message_notice' => '<p>您有 <span id="messageNum" data-name="message_audio" data-sec="4">0</span> 条站内信未处理</p>',
        'memberagentapplies_title' => '会员代理申请列表',
        'memberagentapplies_notice' => '<p>您有 <span id="agentAppliesNum" data-sec="6" data-name="agent_apply_audio">0</span> 条代理申请未处理</p>',
        'members_title' => '会员列表',
        'members_notice' => '<p>您有 <span id="memberNum" data-name="member_audio">0</span> 条特定会员登录提醒</p>',
        'activityapplies_title' => '会员活动申请',
        'activityapplies_notice' => '<p>您有 <span id="activityNum" data-name="activity_audio">0</span> 条会员活动申请</p>',
        'memberyuebaoplans_title' => '会员余额宝购买记录列表',
        'memberyuebaoplans_notice' => '<p>您有 <span id="yuebaoNum" data-name="yuebao_audio">0</span> 条余额宝购买提醒</p>',
        'creditpayrecord_title' => '借呗记录列表',
        'creditpayrecord_notice' => '<p>您有 <span id="creditAppliesNum" data-name="credit_apply_audio">0</span> 借呗申请提醒</p>',
        'creditpayrecord_overdue_title' => '借呗记录列表',
        'creditpayrecord_overdue_notice' => '<p>您有 <span id="creditOverdueNum" data-name="credit_overdue_audio">0</span> 借呗逾期提醒</p>'
    ],

    'btn' => [
        'add' => '新增',
        'batch_delete' => '批量删除',
        'batch_add' => '批量新增',
        'search' => '搜索',
        'reset' => '重置',
        'edit' => '编辑',
        'detail' => '详情',
        'delete' => '删除',
        'refresh' => '刷新',
        'collapse' => '折叠',
        'back' => '返回',
        'save' => '保存内容',
        'export' => '导出',

        'title' => '标题',
        'content' => '内容'
    ],

    'index' => [
        'title' => '首页',
        'today_register' => '今日注册人数',
        'today_free' => '今日营销成本',
        'today_bet' => '今日玩家投注量',
        'today_game_profit' => '今日游戏总营收',
        'month_register' => '本月注册人数',
        'month_free' => '本月营销成本',
        'month_bet' => '本月玩家投注量',
        'month_game_profit' => '本月游戏总营收',
        '10_days_recharge' => '最近10天充值记录',
        '10_days_drawing' => '最近10天提款记录',
        'welcome' => '欢迎你，',
        'recharge_title' => '充值金额',
        'drawing_title' => '提款金额',

        'site_domain_required' => '请确保【系统配置 - 网站主域名】中填上替换前的网址',
        'app_url_required' => '请确保在网站根目录".env"文件的APP_URL字段填上替换后的网址',
        'url_same_error' => '替换前后的网址一致，请检查',
    ],

    'member' => [
        'field' => [
            "name" => "用户名",
            "password" => "密码",
            "original_password" => "API密码",
            "o_password" => "原始密码",
            "nickname" => "昵称",
            "realname" => "真实姓名",
            "email" => "电子邮件",
            "phone" => "手机号码",
            "qq" => "QQ号码",
            "gender" => "性别",
            "invite_code" => "邀请码",
            "qk_pwd" => "取款密码",
            "money" => "中心账户余额",
            "fs_money" => "返水账户余额",
            "total_money" => "平台总投注额",
            "ml_money" => "码量余额",
            "score" => "积分",
            "total_credit" => "借呗总额度",
            "used_credit" => "借呗已用额度",
            "register_ip" => "注册IP",
            "register_area" => "注册地区",
            "register_site" => "注册渠道",
            "status" => "状态",
            "is_tips_on" => "是否开启登录提示",
            "is_in_on" => "是否内部账号",
            "top_id" => "上级代理id",
            "agent_id" => "代理id",
            "level" => "VIP等级",
            "is_demo" => "是否试玩账号",

            "is_online" => "是否在线",
            "lang" => "语言/币种"
        ],

        'index' => [
            'title' => '会员列表',
            'register_setting' => '注册选项设置',
            'is_agent_and_top_agent' => '是否代理/上级代理',
            'last_ip' => '上次登录IP',
            'title_modify_money' => '更改会员余额',
            'title_assign_agent' => '设为代理',
            'title_assign_member_agent' => '设置账号【:name】为代理',
            'title_modify_top' => '分配代理',
            'title_modify_member_top' => '分配账号【:name 】的上级代理'
        ],
        'edit' => [
            'title_edit' => '会员修改',
            'title_create' => '会员新增',
            'is_tips_on_notice' => '开启后每次该玩家登陆会有后台提示音',
            'is_in_on_notice' => '开启后该会员输赢不记录统计'
        ],

        'member_apis' => [
            'title' => '会员接口额度',
            'api_title' => '接口名称',
            'money' => '额度',
            'null' => '未开通',
            'refresh' => '刷新接口余额',
            'recycle' => '一键回收',
        ],

        'modify_money' => [
            'title' => '会员额度修改',
            'is_add_ml' => '同时增加码量',
            'is_add_ml_notice' => '增加比例参考 【系统配置】 - 【代理相关】 - 【提款百分比】',
        ],

        'modify_top' => [
            'notice' => '<strong>注意：</strong> 该账号之前未设置过返点，分配上级后会根据所分配的上级账号自动分配返点'
        ],

        'money_report' => [
            'title' => '财务报表',
            'notice' => '<strong>注意：</strong> 正数为平台盈利，负数为平台亏损',
            'created_at' => '时间范围',
            'is_agent_and_top_agent' => '代理/上级',
            'recharge_count' => '存款次数',
            'drawing_count' => '取款次数',
            'recharge_sum' => '存款总金额',
            'drawing_sum' => '提款总金额',
            'total_fs' => '总返水',
            'total_dividend' => '总红利',
            'total_other' => '总其它',
            'total_profit' => '盈亏总额',

            'profit_formula_notice' => '盈亏计算公式及说明',
            'profit_formula' => '存款—提款—返水—红利-其它＝实际盈亏',
            'yinli' => '盈利：',
            'kuisun' => '亏损：'
        ],

        'msg' => [
            'money_negative_error' => '修改后的金额为负数，请检查',
            'password_at_least_6' => '密码长度最少是六位',
            'balance_error' => '余额查询失败，错误信息:',
            'offline_success' => '已将会员【 :name 】踢下线',
            'member_offlined' => '会员【 :name 】目前已离线',
        ]
    ],

    'agent' => [
        'field' => [
            "member_id" => "会员ID",
            "agent_pc_uri" => "代理PC链接",
            "agent_wap_uri" => "代理WAP链接",
            "agent_real_pc_url" => "代理PC链接",
            "agent_real_wap_url" => "代理WAP链接",
            "agent_uri_pre" => "代理链接前缀",
            "apply_data" => "申请信息",
            "remark" => "备注",
        ],

        'assign' => [
            'notice' => '该会员之前的代理号被删除，请选择重新创建代理或者沿用旧代理账号'
        ],

        'index' => [
            'top_notice' => '<strong>注意：</strong> 新建代理请在【会员列表】中设置会员成为代理',
            'btn_fd_rate' => '反点点位',
            'title_fd_rate' => '代理 :name 反点点位',
            'btn_fd_record' => '反点记录',
            'title_fd_record' => '代理 :name 反点记录',
        ],

        'msg' => [
            'assign_type_required' => '请选择分配模式',
            'assign_operate_error' => '分配代理失败：',
            'assign_operate_success' => '分配代理成功',
        ]
    ],

    'user' => [
        'field' => [
            "name" => "用户名",
            "password" => "密码",
            "status" => '状态',
            "create_ip" => "创建IP",
            "google_secret" => "谷歌验证码",
            "is_google_secret" => "是否绑定谷歌验证码",
        ],

        'status' => [
            1 => '正常',
            -1 => '禁止'
        ],

        'index' => [
            'btn_assgin' => '分配角色'
        ],

        'modify_pwd' => [
            'oldpassword' => '原始密码',
            'password' => '新密码',
            'password_confirmation' => '确认新密码',
        ],

        'assign' => [
            'role' => '角色'
        ],

        'msg' => [
            'oldpassword_error' => '原始密码错误，请检查',
            'modify_success_login' => "密码修改成功,请重新登录",
            'modify_error' => '密码修改失败',
            'assign_success' => '角色分配成功',
            'assign_fail' => '角色分配失败',
        ],

        'login' => [
            'google_auth_error' => '谷歌验证码填写错误',
        ],

        'google' => [
            'first_notice' => '第一次绑定，请使用谷歌验证器APP直接扫描二维码，输入手机上的谷歌验证码，然后提交绑定；',
            'reset_notice' => '您已经绑定过谷歌验证码，如果需要重新绑定，请联系管理员',
            'scan_qrcode' => '扫码绑定',
            'secret_notice' => '请在扫码后，输入手机上的谷歌验证码',
            'submit' => '提交绑定',
            'reset_own_error' => '无法重置自己的账号，请联系总管理员',
            'reset_btn' => '重置谷歌验证码',
            'reset_message' => '确定要重置该账户的谷歌验证码吗？',
        ]
    ],

    'role' => [
        'field' => [
            'name' => '用户名',
            'description' => '描述',
        ],

        'index' => [
            'btn_assign' => '分配权限',
        ],

        'assign' => [
            'permission' => '权限',
            'check_all' => '全选'
        ],

        'msg' => [
            'assign_success' => '权限分配成功',
            'assign_fail' => '权限分配失败',
        ]
    ],

    'permission' => [
        'field' => [
            'name' => '权限名称',
            'icon' => '图标',
            'pid' => '父级ID',
            'route_name' => '路由名称',
            'weight' => '权重',
            'description' => '描述',
            'remark' => '备注',
            'is_show' => '是否显示'
        ],

        'is_show' => [
            0 => '不显示',
            1 => '显示'
        ],

        'index' => [
            'btn_child' => '创建子权限',
        ],

        'msg' => [
            'lang_json_error' => '多语言权限名称填写错误'
        ]
    ],

    'black_ip' => [
        'field' => [
            "ip" => "IP地址",
            "is_open" => "是否开启",
            "remark" => "备注信息",
        ]
    ],

    'apis' => [
        'field' => [
            "api_id" => "接口ID",
            "api_name" => "平台标识",
            "api_title" => "平台描述名称",
            "api_money" => "接口余额",
            "prefix" => "账号前缀",
            "is_open" => "是否开放",
            "lang" => "币种",
            "lang_list" => "支持语言",
            "weight" => "权重",
            "remark" => "备注",
            'icon_url' => '电子侧边栏图标',
            'logo_url' => 'pc 下拉展示logo'
        ],

        'index' => [
            'top_title' => 'API接口基础配置',
            'api_domain' => '基础域名',
            'api_prefix' => '前缀',
            'btn_refresh' => '刷新接口余额',
            'config_title' => '网站基础配置',
        ],

        'msg' => [
            'no_need_update_game' => '没有需要更新的游戏',
            'update_game_success' => '成功更新【 :update_count 】条游戏数据，成功新增【 :create_count】条游戏数据',
        ]
    ],

    'api_game' => [
        'field' => [
            "title" => "游戏标题",
            "subtitle" => "副标题",
            "web_pic" => "电脑端图片",
            "mobile_pic" => "手机端图片",
            "api_name" => "接口标识",
            "class_name" => "样式标识",
            "game_type" => "游戏类型",
            "params" => "参数",
            "client_type" => "运行平台",
            "is_open" => "是否开放",
            "weight" => "权重",
            "tags" => "标签",
            "lang" => "语言",
            "remark" => "备注",
        ],

        'index' => [
            'top_notice' => '游戏显示文字 在此类修改',
            'btn_update' => '游戏更新',
            'web_pic_notice' => '【电子】分类的图片对应游戏列表的Logo'
        ],

        'mobile_category' => [
            'top_notice' => '<strong>注意：</strong> 操作完需要保存才能生效',
            'web_title' => '电脑首页导航排序',
            'key' => '标识',
            'name' => '名称',
            'weight' => '权重',
        ]
    ],

    'game_list' => [
        'field' => [
            "api_name" => "接口标识",
            "name" => "游戏中文名称",
            "en_name" => "英文名称",
            "game_type" => "游戏类型",
            "game_code" => "游戏ID",
            "tcg_game_type" => "TCG游戏类型",
            "param_remark" => "参数补充",
            "img_path" => "图片路径",
            "img_url" => "图片地址",
            "client_type" => "运行平台",
            "platform" => "支持环境",
            "is_open" => "是否开放",
            "weight" => "权重",
            "tags" => "标签",
        ]
    ],

    'game_hot' => [
        'field' => [
            "name" => "厅名称",
            "api_name" => '接口名称',
            "desc" => "厅描述",
            "en_name" => "厅名称[英文]",
            "en_desc" => "厅描述[英文]",
            "tw_name" => "厅名称[繁中]",
            "tw_desc" => "厅描述[繁中]",
            "th_name" => "厅名称[泰文]",
            "th_desc" => "厅描述[泰文]",
            "vi_name" => "厅名称[越南文]",
            "vi_desc" => "厅描述[越南文]",
            "icon_path" => "选中前 icon",
            "icon_path2" => "选中后 icon",
            "img_url" => "图片地址",
            "game_code" => "游戏参数",
            "is_online" => "是否上线",
            "sort" => "排序",
            'game_type' =>'游戏类型',
            'type' =>'位置类型',
            "lang" => "语言",
            'jump_link' =>'跳转链接',
            'jump_link_p' => '如果是直接进入游戏，无需填写',
            'icon_path2_p' => '如果选择 首页游戏分类 位置，则无需上传',
            'is_new_window' => '是否在新窗口打开'
        ],
        'hot_game_place_type' => [
            1 => '热门游戏版块',
            2 => '首页游戏分类'
        ],
    ],

    'admin_log' => [
        'field' => [
            'user_id' => '管理员ID',
            'user_name' => '管理员用户名',
            'url' => '操作地址',
            'data' => '操作数据',
            'ip' => '操作IP',
            'address' => 'IP真实地址',
            'ua' => '操作环境',
            'type' => '操作类型',
            'type_text' => '操作类型说明',
            'description' => '操作描述',
            'remark' => '操作备注',
        ],

        'title' => [
            'login_title' => '管理员登录日志',
            'logout_title' => '管理员登出日志',
            'operate_title' => '管理员操作日志',
            'system_title' => '系统异常日志'
        ],

        'type' => [
            '1' => '后台登录',
            '2' => '后台登出',
            '3' => '后台操作',
            '4' => '系统异常'
        ]
    ],

    'member_log' => [
        'field' => [
            "member_id" => "会员ID",
            "ip" => "操作IP",
            "address" => "IP真实地址",
            "ua" => "操作环境",
            "type" => "操作类型",
            "description" => "操作描述",
            "remark" => "备注",
        ]
    ],

    'member_agent_apply' => [
        'field' => [
            "member_id" => "会员ID",
            "name" => "真实姓名",
            "phone" => "电话号码",
            "email" => "电子邮件",
            "msn_qq" => "联系方式MSN/QQ",
            "reason" => "申请原因",
            "status" => "申请状态",
            "fail_reason" => "失败原因",
            "assign_type" => "分配模式"
        ],

        'index' => [
            'btn_deal' => '处理'
        ],

        'msg' => [
            'saved_cannot_modify' => '已经审核过的申请不允许修改',
            'update_and_fill_data' => '更新数据成功，请填写代理参数',
        ],
    ],

    'agent_fd_rate' => [
        'field' => [
            "parent_id" => "父级代理ID",
            "member_id" => "当前会员ID",
            "game_type" => "游戏类型",
            "type" => "点位类型",
            "rate" => "返点比例(%)",
            "remark" => "备注",
        ],

        'agent' => [
            'top_notice' => '<strong>注意：</strong> 该代理还未设置反点点位',
            'operate_total' => '统一设置点位',
            'btn_apply' => '应用',
            'title' => '设置代理【 :name 】反点点位',
            'system_highest' => '系统最高点位',
            'system_lowest' => '系统最低点位',
            'system_default' => '系统默认点位',
            'quick_notice' => '请输入统一设置点位的值'
        ],

        'system' => [
            'highest_title' => '代理默认最高返点',
            'lowest_title' => '代理默认最低返点',
            'default_title' => '系统创建代理默认返点',
        ],

        'msg' => [
            'system_highest_error' => '系统游戏类型【 :game_type 】的最高反水点位低于该类型最低的反水点位，请检查',
            'system_lowest_error' => '系统游戏类型【 :game_type 】的最低反水点位高于该类型最高的反水点位，请检查',
        ],
    ],

    'agent_fd_money_log' => [
        'field' => [
            "member_id" => "玩家会员ID",
            "member_rate" => "玩家返点比例(%)",
            "agent_member_id" => "代理ID",
            "agent_member_rate" => "代理返点比例(%)",
            "child_member_id" => "下级会员ID",
            "child_member_rate" => "下级会员返点比例(%)",
            "game_type" => "游戏类型",
            "bet_amount" => "下注金额",
            "fd_money" => "返点金额",
            "money_before" => "日志前余额",
            "money_after" => "日志后余额",
            "remark" => "备注",
        ]
    ],

    'daily_bonus' => [
        'field' => [
            "member_id" => "会员id",
            "bonus_money" => "签到奖励金额",
            "days" => "签到设置天数",
            "serial_days" => "连续签到天数",
            "total_days" => "累计签到天数",
            "type" => "类型",
            "state" => "状态",
            "remark" => "备注",
            "lang" => "语言/币种"
        ],

        'record' => [
            'btn_confirm' => '审核通过',
            'notice_confirm' => '确定通过会员的签到奖励申请吗？',
            'btn_reject' => '审核不通过',
            'notice_reject' => '确定拒绝会员的签到奖励申请吗？',
        ],

        'setting' => [
            'deposit' => '当日存款金额',
            'valid_num' => '有效流水（倍数）',
            'times' => '抽奖次数',
            'is_open' => '是否启用',
            'currency' =>'币种',
            'min' => '最低金额',
            'max' => '最高金额',
        ],

        'msg' => [
            'same_day_error' => '已经设置过相同签到设置天数的签到奖励，请检查'
        ]
    ],

    'game_record' => [
        'field' => [
            "billNo" => "注单流水号",
            "api_name" => "接口标识",
            "name" => "玩家账号",
            "gameType" => "游戏类型",
            "status" => "结算状态",
            "betTime" => "下注时间",
            "betAmount" => "下注金额",
            "validBetAmount" => "有效下注金额",
            "netAmount" => "派彩金额",
            "roundNo" => "场次信息",
            "playDetail" => "玩法详情",
            "wagerDetail" => "下注明细",
            "gameResult" => "开奖结果",
            "is_fd" => "是否返点",

            "shuyinAmount" => "输赢金额"
        ],

        'index' => [
            'btn_send_fd' => '发放返点',
            'notice_send_fd' => '确定发放该游戏记录的反水吗？',

        ]
    ],

    'member_wheel' => [
        'field' => [
            "member_id" => "会员id",
            "user_id" => "管理员ID",
            "award_id" => "奖品ID",
            "award_desc" => "奖品描述",
            "status" => "领取状态",
        ],

        'index' => [
            'btn_send' => '确认发放',
            'notice_send' => '确定进行确认发放处理吗?'
        ],

        'setting' => [
            'deposit' => '当日存款金额',
            'valid_num' => '有效流水（倍数）',
            'times' => '转盘次数',
            'awards' => '可中奖品',
            'is_open' => '是否启用'
        ]
    ],

    'system_notice' => [
        'field' => [
            "title" => "标题",
            "content" => "内容",
            "text_content" => "APP内容",
            "group_name" => "分组名",
            "weight" => "权重",
            "url" => "跳转链接",
            "is_open" => "是否启用",
            "lang" => "语言",
        ],

        'index' => [
            'app_title' => 'APP公告列表'
        ],

        'edit' => [
            'notice_group' => '已有分组：'
        ]
    ],

    'system_config' => [
        'config_groups' => [
            'top_notice' => '<strong>注意：</strong> 操作完需要保存才会生效;需点击右侧刷新按钮文字才能刷新本页',
            'system' => '系统相关',
            'service' => '客服相关',
            'line' => 'Line相关',
            'site' => '站点名称',
            'activity' => '活动相关',
            'recharge' => '支付相关',
            'drawing' => '提款相关',
            'agent' => '代理相关',
            'notice' => '提醒相关',
            'group_notice' => '<strong>注意：</strong> 该页面的内容保存后，需要刷新整个页面生效',
            'btn_choose' => '选择文件',
            'btn_preview' => '预览',
			'register'	=> '登記',
        ],

        'app_content' => [
            'top_notice' => '<strong>注意：</strong> 操作完需要保存才会生效',
            'app_content' => '内容相关'
        ],

        'config_content' => [
            'register' => '注册相关',
            'navigate' => '导航相关',
            'activity_about' => '活动相关',
            'credit' => '借呗相关',
            'levelup_slot' => '电子升级',
            'levelup_live' => '真人升级'
        ],
    ],

    'banner' => [
        'field' => [
            "id" => "ID",
            "title" => "标题",
            "description" => "描述",
            "url" => "地址",
            "dimensions" => "宽高",
            "groups" => "分组",
            "weight" => "权重",
            "lang" => "语言",
            "is_open" => "是否开启",
            "created_at" => "创建时间",
            "updated_at" => "更新时间",
        ],

        'index' => [
            'top_notice' => '<strong>注意：</strong> 删除列表中的轮播图时不会删除”附件管理“中的上传记录和文件;参考尺寸：web端轮播图尺寸【1920*418】，h5端【750*350】',
        ],

        'edit' => [
            'top_notice' => '<strong>注意：</strong> 请保持同一组图片的尺寸大小相同',
            'group_notice' => '手机轮播图请填“mobile1”,PC轮播图请填“new1”'
        ]
    ],

    'about' => [
        'field' => [
            "id" => "ID",
            "title" => "标题",
            "subtitle" => "副标题",
            "cover_img" => "封面图片",
            "content" => "内容",
            "type" => "类型",
            "is_open" => "是否开放",
            "is_hot" => "是否热门",
            "weight" => "权重",
            "lang" => "语言",
        ]
    ],

    'sport' => [
        'field' => [
            "home_team_name" => "主队名称",
            "home_team_name_en" => "主队名称英文",
            "home_team_img" => "主队图片",
            "home_odds" => "主队赔率",
            "visiting_team_name" => "客队名称",
            "visiting_team_name_en" => "客队名称英文",
            "visiting_team_img" => "客队图片",
            "visiting_odds" => "客队赔率",
            "let_ball" => "让球",
            "match_cup" => "比赛名称",
            "match_cup_en" => "比赛名称英文",
            "match_at" => "比赛时间",
            "is_open" => "是否开启",
            "weight" => "权重",
        ]
    ],

    'level_config' => [
        'field' => [
            "level" => "等级",
            "level_name" => "等级名称",
            "deposit_money" => "晋升存款金额",
            "bet_money" => "晋升投注金额",
            "level_bonus" => "晋升礼金",
            "day_bonus" => "每日礼金",
            "week_bonus" => "每周礼金",
            "month_bonus" => "每月礼金",
            "year_bonus" => "每年礼金",
            "credit_bonus" => "借呗额度奖励",
            "levelup_type" => "晋升条件类型",
            "lang" => "语言/币种",
        ]
    ],

    'payment' => [
        'field' => [
            "desc" => "支付方式描述",
            "account" => "收款账号",
            "type" => "支付方式",
            "name" => "收款人姓名",
            "qrcode" => "支付二维码",
            "memo" => "支付备注",
            "rate" => "赠送比例",
            "min" => "最低充值金额",
            "max" => "最高充值金额",
            "forex" => "交易比例",
            "lang" => "语言/币种",
            "is_open" => "是否开启",

            "detail" => "详细信息",
            "range" => "单笔限额",
            "bank_type" => "银行类型",
            "bank_address" => "开户行地址",
            "account_id" => "第三方商户号",
            "key" => "第三方密钥",
            "url" => "第三方支付URL",
            "api" => "第三方支付标识",
            "paytype" => "第三方支付类型代码",
            "usdt_type" => "USDT类型",
            "usdt_rate" => "USDT兑换汇率",
            "usdt_num" => "USDT币数量"
        ],

        "index" => [
            'top_notice' => '存款方式页面的标题和介绍信息请在【系统配置】 - 【系统配置分组】 - 【支付相关】 中进行配置'
        ],

        "edit" => [
            "notice_memo" => "支付时需要填写的备注信息",
            "notice_range" => "最低充值金额和最高充值金额都是0时表示不限制充值金额数量",
            "notice_min_max" => "最低充值金额和最高充值金额都是按照平台金额为单位",
            "notice_forex" => "兑换数量为1的平台金额需要多少金额，列如：10人民币兑换数量为1的平台金额，下方\"语言/币种\"选择中文,交易比例填10",
        ],

        'msg' => [
            'account_id_required' => '请输入第三方商户号',
            'key_required' => '请输入第三方密钥',
            'url_required' => '请输入第三方支付URL',
            'bank_type_required' => '请选择银行卡类型',
            'account_required' => '请输入收款账号',
            'name_required' => '请输入收款人姓名',
            'money_range_err' => '最高充值金额不能低于最低充值金额',
            'usdt_account_required' => '请输入USDT收款账号',
            'usdt_rate_required' => '请输入USDT兑换汇率',
            'usdt_rate_valid' => '请输入有效的USDT兑换汇率',
        ]
    ],

    'activity' => [
        'field' => [
            "title" => "标题",
            "subtitle" => "副标题",
            "cover_image" => "列表封面图",
            "content" => "活动说明",
            "type" => "活动类型",
            "apply_type" => "申请方式",
            "apply_url" => "申请地址",
            "apply_desc" => "申请描述",
            "hall_image" => "大厅封面图",
            "hall_field" => "申请填写信息",
            "date_desc" => "活动时间描述",
            "date_description" => "活动时间",
            "start_at" => "活动开始时间",
            "end_at" => "活动截止时间",
            "rule_content" => "活动规则",
            "is_open" => "是否开放",
            "is_hot" => "是否热门",
            "weight" => "权重",
            "lang" => "语言",
        ],

        'index' => [
            'btn_preview' => '预览'
        ],

        'msg' => [
            'hall_image_required' => '请上传活动大厅封面图',
            'apply_url_required' => '请填写活动申请跳转地址'
        ]
    ],

    'activity_apply' => [
        'field' => [
            "member_id" => "会员id",
            "user_id" => "管理员ID",
            "activity_id" => "活动ID",
            "data_content" => "申请信息",
            "status" => "申请状态",
            "remark" => "备注信息",

            "money" => "发放金额"
        ],

        'index' => [
            'btn_confirm' => '审核通过',
            'btn_reject' => '审核不通过',
            'notice_confirm' => '确定通过会员的活动申请吗？',
            'notice_reject' => '确定拒绝会员的签到奖励申请吗？',
            'btn_bonus' => '发放活动奖励'
        ],

        'edit' => [
            'title_confirm' => '审核通过',
            'title_reject' => '审核不通过',
            'top_notice' => '<strong>注意：</strong> 如果需要派发奖励，请在审核通过后进行处理',
            'dealed_error' => '该申请记录已处理，请勿重复处理',
        ],

        'bonus' => [
            'top_notice' => '<strong>注意：</strong> 活动金额默认发放到反水账户中',
            'money_notice' => '发放至哪个钱包请在 系统设置 - 活动相关 中设置'
        ]
    ],

    'modify_pwd' => [
        'field' => [
            "oldpassword" => '原始密码',
            "password" => '新密码',
            "password_confirmation" => '确认新密码',

            "qk_pwd" => '新取款密码',
            "old_qk_pwd" => '原始取款密码',
            "qk_pwd_confirmation" => '确认新取款密码'
        ]
    ],

    'register' => [
        'field' => [
            'name' => '账号',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'rates' => '返点比例'
        ]
    ],

    'bank' => [
        'field' => [
            "key" => "标识",
            "name" => "名称",
            "url" => "官网",
            "is_open" => "是否开放",
            "weight" => "权重",
            "lang" => "语言"
        ]
    ],

    'member_bank' => [
        'field' => [
            "member_id" => "会员ID",
            "card_no" => "卡号",
            "bank_type" => "银行类型",
            "bank_type_text" => "银行类型",
            "phone" => "办卡预留手机号",
            "owner_name" => "持卡人姓名",
            "bank_address" => "开户行地址",
            "remark" => "操作备注",
        ],

        'index' => [
            'title' => ''
        ]
    ],

    'recharge' => [
        'field' => [
            "bill_no" => "交易流水号",
            "member_id" => "会员id",
            "name" => "转账人姓名",
            "account" => "转账账号",
            "origin_money" => "折算前充值金额",
            "forex" => "交易（折算）比例",
            "lang" => "语言/币种",
            "money" => "充值金额",
            "payment_type" => "支付类型",
            "payment_pic" => "支付凭证",
            "diff_money" => "赠送金额",
            "before_money" => "充值前金额",
            "after_money" => "充值后金额",
            "score" => "积分",
            "fail_reason" => "失败原因",
            "hk_at" => "客户填写的汇款时间",
            "confirm_at" => "确认转账时间",
            "status" => "支付状态",
            "user_id" => "管理员ID",

            'payment_id' => '收款信息',
            'payment_account' => '收款账号',
            'payment_name' => '收款人姓名',
            'bank_type' => '收款银行'
        ],

        'index' => [
            'btn_confirm' => "审核通过",
            'btn_reject' => "审核不通过",
            'btn_payment_detail' => "收款账号详情"
        ],

        'edit' => [
            'notice_diff' => "支付通道 :text 的赠送比例是 :rate"
        ],

        'msg' => [
            'recharge_dealed' => '该笔充值记录已处理',
        ]
    ],

    'drawing' => [
        'field' => [
            "bill_no" => "交易流水号",
            "member_id" => "会员ID",
            "name" => "收款人姓名",
            "money" => "提款金额",
            "account" => "账户信息",
            "before_money" => "提款前金额",
            "after_money" => "提款后金额",
            "score" => "积分",
            "counter_fee" => "手续费",
            "fail_reason" => "失败原因",
            "member_bank_info" => "用户银行数据json",
            "member_remark" => "用户提款备注",
            "confirm_at" => "确认转账时间",
            "status" => "提款状态",
            "user_id" => "管理员ID",
        ],

        'index' => [
            'btn_confirm' => '审核通过',
            'btn_reject' => '审核不通过'
        ],

        'msg' => [
            'dealed_error' => '该笔提款申请已处理'
        ]
    ],

    'message' => [
        'field' => [
            "user_id" => "管理员ID",
            "pid" => "上条消息ID",
            "url" => "跳转URL",
            "title" => "站内信标题",
            "content" => "发送内容",
            "visible_type" => "可见类型",
            "send_type" => "发送类型",
        ],

        'index' => [
            'visible_member' => '可见会员',
            'all_member' => '所有会员',
        ],

        'msg' => [
            'member_select_required' => '请选择发送给哪个会员',
            'data_select_required' => '请选择需要操作的数据',
        ]
    ],

    'member_message' => [
        'field' => [
            'title' => '会员反馈标题',
            'content' => '会员反馈内容',
            'reply_title' => '回复标题',
            'reply_content' => '回复内容',
            'status' => '回复状态'
        ],

        'index' => [
            'btn_batch_read' => '批量已读',
            'btn_detail' => '反馈详情',
            'btn_reply' => '消息回复',
            'btn_mark' => '标记回复',
            'title_mark' => '确定进行标记回复处理吗?',
            'title_delete' => '确定删除该回复吗？'
        ],

        'history' => [
            'title' => '反馈详情',
        ],
    ],

    'member_money_log' => [
        'field' => [
            "member_id" => "会员id",
            "user_id" => "管理员ID",
            "money" => "操作金额",
            "money_before" => "操作前金额",
            "money_after" => "操作后金额",
            "money_type" => "金额字段类型",
            "number_type" => "数量类型",
            "operate_type" => "金额变动类型",
            "model_name" => "模型名称",
            "model_id" => "模型ID",
            "description" => "操作描述",
            "remark" => "操作备注",
        ],

        'notice' => [
            'activity_bonus' => '发放活动【 :title 】奖金【 :money 元】至会员【 :member 】',
            'system_send_fs' => '管理员发放时间范围【 :time 】游戏类型【 :game_type 】的反水至反水钱包',
            'drawing_reject' => '不通过会员的提现，将金额【 :money 元】退还至会员账户，拒绝理由：:reason',
            'drawing_counter_fee' => '，会员码量为【 :ml_money 】,扣除手续费【 :count_fee元】',
            'drawing_request' => '会员最终提现金额为【 :money 】',
            'get_fs_now' => '领取日期【 :time 】之前的反水，金额为【 :money 】，游戏类型【 :game_type】，发放至反水钱包',

            'transfer_in_game' => '转入【 :title 】游戏【 :money 元】，扣除账户金额',
            'transfer_in_error' => '转入【 :title 】游戏失败，退还账户金额【 :money 元】',
            'transfer_out_game' => '转出【 :title 】游戏【 :money 元】，增加账户金额',
        ]
    ],

    'yuebao_plan' => [
        'field' => [
            "SettingName" => "方案标题",
            "MinAmount" => "最小购买金额",
            "MaxAmount" => "最大购买金额",
            "SettleTime" => "结算时间（小时）",
            "IsCycleSettle" => "结算方式",
            "Rate" => "方案利率",
            "TotalCount" => "计划总金额",
            "LimitInterest" => "会员封顶利息",
            "LimitOrderIntervalTime" => "订单间隔时间（小时）",
            "InterestAuditMultiple" => "利息码量倍数",
            "LimitUserOrderCount" => "会员最大购买总金额",
            "is_open" => "是否开放购买",
            "weight" => "排序",
        ],

        'edit' => [
            'notice_no_limit' => '不填表示没有限制',
            'notice_default_ml' => '默认为1倍码量',
            'notice_weight' => '越大越靠前'
        ],

        'member_plan' => [
            'created_at' => '购买时间'
        ],

        'msg' => [
            'min_money_err' => '最低购买金额不能高于最低购买金额',
            'max_money_err' => '最高购买金额不能高于计划总金额',
        ]
    ],

    'member_yuebao_plan' => [
        'field' => [
            "member_id" => "会员id",
            "plan_id" => "方案ID",
            "amount" => "购买金额",
            "status" => "状态",
            "drawing_at" => "提现时间",

            "interest_sum" => "累积利息",
        ],

        'index' => [
            'title_interest_history' => '盈利记录 - 【 :name 】'
        ]
    ],

    'interest_history' => [
        'field' => [
            "member_plan_id" => "会员方案ID",
            "interest" => "利息",
            "times" => "次数",
            "calc_at" => "结算时间",
        ]
    ],

    'credit_pay_record' => [
        'field' => [
            "member_id" => "会员id",
            "money" => "借款金额",
            "type" => "类型",
            "borrow_day" => "借款天数",
            "status" => "状态",
            "dead_at" => "借款到期时间",

            "is_overdue" => "是否逾期"
        ],

        'index' => [
            'btn_confirm' => '通过',
            'notice_confirm' => '确定通过会员的借款操作吗？',
            'btn_reject' => '确定拒绝会员的借款操作吗？',
            'notice_reject' => '拒绝',

            'title_lend' => '还款记录',
            'title_borrow' => '借款记录',
        ]
    ],

    'quick' => [
        'member_arbitrage_query' => [
            'arbitrage_type' => '套利类型',
            'result' => '查询结果',
            'total_number' => '总人数',
            'no_result' => '无相关数据'
        ],

        'transfer_check' => [
            'start_at' => '开始时间',
            'end_at' => '截止时间',
            'transfer_out_account' => '转出账户',
            'transfer_in_account' => '转入账户',
            'money' => '转账金额',
            'is_dd' => '是否掉单',
            'btn_supply' => '仅补单',
            'btn_supply_modify' => '补单并修改余额',

            'no_transfer_data' => '该会员在【 :start_at ~ :end_at 】之间无额度转换记录',
            'transfer_count_success' => '该会员在【 :start_at ~ :end_at 】之间有【 :count 】条记录并未掉单',
            'transfer_count_fail' => '在【 :start_at ~ :end_at 】之间【 :count 】条记录中有 :fail_count 笔订单掉单',
            'money_not_enough' => '会员余额不足，请检查',
        ],

        'database_clean' => [
            'top_notice' => '<strong>注意：</strong> 操作不可逆，请谨慎操作;【会员表】和【代理佣金记录】无法根据会员名称进行删除，仅根据 数据清理天数 进行删除；<br><b>如删除会员游戏记录，则会导致晋级等级福利数据丢失<b>；',
            'member_notice' => '如果不选择会员，则表示清理系统所有数据',
            'content' => '清理内容',

            'member' => '会员表',
            'agent' => '代理表',
            'agent_fd_money_log' => '代理返点金额日志',
            'agent_yj_log' => '代理佣金记录',
            'drawing' => '提款记录',
            'game_record' => '会员游戏记录',
            'member_money_log' => '会员金额日志',
            'recharge' => '充值记录',
            'transfer' => '额度转换记录',
            'member_log' => '会员操作日志',
            'member_wheel' => '会员轮盘记录',
            'daily_bonus' => '会员签到记录',
            'member_yuebao_plan' => '会员余额宝记录',
            'credit_pay_record' => '会员借呗记录',
            'activity' => '活动列表',
            'activity_apply' => '会员活动申请',

            'oldest_date' => '最旧数据日期',
            'latest_date' => '最新数据日期',
            'day_before' => ':date 天前',

            'day_field' => '清理多少天前的数据',
            'days' => '清理数据天数',
            'day_notice' => '默认清理三十天外的数据',

            'alert_before' => '已选择清理内容',
            'alert_after' => '确认清理吗',
            'alert_title' => '操作提示',
            'alert_1' => '我再去了解一下',
            'alert_2' => '我已阅读上述红色文字,继续清理',

            'item_select_required' => '请选中清理项',
        ],
    ],

    'yj_level' => [
        'field' => [
            'level' => '佣金等级',
            'name' => '等级名称',
            'active_num' => '下线活跃人数',
            'min' => '最低流水金额',
            'rate' => '佣金比例（百分比）',
            "lang" => "币种",
        ],

        'msg' => [
            'top_notice' => '注意：下线活跃会员判定标准是每月充值金额达到 【:money】 元，如需修改，请在 【系统配置】 - 【系统配置分组】 - 【代理相关】 页面中进行修改'
        ]
    ],

    'agent_yj_log' => [
        'field' => [
            'created_at' => '佣金时间范围',
            'top_title' => '代理财务报表',

            'offline' => '下线会员',
            'balance' => '下线余额',
            'transfer' => '常规存取款',
            'deposit' => '存款',
            'withdraw' => '提款',
            'bonus' => '红利派送',
            'activity' => '活动赠送',
            'rebate' => '反水派送',
            'other' => '其它情况',
            'last_at' => '上次发放佣金时间',
            'money' => '佣金金额',
            'remark' => '发放佣金备注',

            'send_yj' => '发放佣金',
            'record' => '记录',
            'history' => '【:name】佣金发发放历史',
        ],

        'msg' => [
            'top_notice' => '注意：代理佣金发放是传统代理模式，由管理员自行控制，原则上每月发放一次',

            'time_range_required' => '请先选择佣金时间范围',
            'yj_send_success' => '佣金发放成功',
            'yj_send_fail' => '佣金发放失败：',
        ]
    ],

    'send_fs' => [
        'msg' => [
            'realtime_fs_mode' => '目前是实时反水模式，无法使用一键反水功能',
            'send_success' => '反水发放成功',
            'send_fail' => '反水发放失败：',
        ]
    ],

    'transfer' => [
        'field' => [
            "bill_no" => "交易流水号",
            "api_name" => "接口标识",
            "member_id" => "会员ID",
            "transfer_type" => "转账类型",
            "money" => "转换金额",
            "diff_money" => "差价（红利）金额",
            "real_money" => "实际转换金额",
            "before_money" => "转账前的金额",
            "after_money" => "转账后的金额",
            "money_type" => "金额字段类型",
        ],
    ],

    'fs_level' => [
        'field' => [
            "game_type" => "游戏类型",
            "member_id" => "会员ID",
            "level" => "反水等级",
            "name" => "等级名称",
            "quota" => "有效投注额度",
            "type" => "类型",
            "rate" => "反水比例",
            "lang" => "语言/币种"
        ],

        'msg' => [
            'select_member' => '请选择会员',
            'same_data_not_allowed' => '同一游戏类型、类型、等级、币种的数据只能存在一条',
            'fs_level_required' => '请设置等级名称',
            'fs_level_repeat' => '已存在该等级的反水等级数据，请将其删除后操作',
        ],
    ],

    'aside_adv' => [
        'field' => [
            'name' => '名称',
            'group' => '分组名',
            'pic_url' => '广告图片',
            'pic_index' => '图片索引',
            'vertical' => '垂直位置',
            'horizontal' => '水平位置',
            'effect' => '特效',
            'url_id' => '跳转路由',
            'remark' => '备注信息',
            'lang' => '语言',
            'is_open' => '是否开放',
            'weight' => '排序',
        ],
    ],

    'option' => [
        'member_status' => [
            1 => '启用',
            -1 => '禁用',
            -2 => '踢下线'
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
            1 => '开启',
            0 => '关闭'
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

        'card_type' => [
            1 => '储蓄卡',
        ],

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
            7 => "联络我们",
            8 => "条款规则"
        ],

        'gamerecord_status' => [
            'N' => '已取消',
            'X' => '未结算',
            'COMPLETE' => '已结算',
            'CANCEL' => '已撤销',
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
            'online_alipay' => '支付宝支付(在线支付)',
            'online_wechat' => '微信支付(在线支付)',
            'online_union_quick' => '银联快捷(在线支付)',
            'online_union_scan' => '银联扫码（在线支付）',
            'company_bankpay' => '银行卡转账(公司入款)',
            'company_alipay' => '支付宝支付(公司入款)',
            'company_wechat' => '微信公支付(公司入款)',
            'online_cgpay' => 'CGPay支付(在线支付)',
            'company_usdt' => 'USDT支付(公司入款)',
            'online_usdt' => 'USDT支付(在线支付)',
        ],

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

        'daily_bonus_set' => [
            -1 => '累计签到',
            -2 => '连续签到'
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
            6 => '累计流水'
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
            9 => ['desc' => 'IPHONE 12 PRO MAX 512GB','type' => 3,'pic' => 'web/images/wheel/zh_cn/957740284f61bba05611061782f8d639.png'],
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
            'top' => '上',
            'bottom' => '下',
        ],

        'adv_horizontal' => [
            'left' => '左',
            'right' => '右'
        ],

        'adv_effect' => [
            'hover' => '悬浮'
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

        'levelup_type' => [
            7 => '电子升级',
            8 => '真人升级'
        ],

        'notice_group' => [
            'main' => '首页公告',
            'credit' => '借呗公告',
            'pc' => '电脑弹窗',
            'mobile' => '手机弹窗'
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

        'member_apis' => '接口余额',
        'recharges' => '充值记录',
        'drawings' => '提款记录',
        'transfers' => '转账记录',
        'gamerecords' => '游戏记录',
        'memberlogs' => '登录日志',
        'modify_money' => '更改余额',
        'arbitrage_query' => '套利查询',
        'make_offline' => '踢下线',
        'make_offline_msg' => '确定将会员踢下线吗？',

    ],

    // 接口相关文字
    'api' => [
        'common' => [
            'demo_not_allowed' => '试玩账号无法进行该操作',
            'member_forbidden' => '该账号已被禁用',
            'operate_error' => '操作异常',
            'operate_fail' => '操作失败：',
            'operate_forbidden' => '非法请求',
            'operate_again' => '操作失败，请重试',
            'operate_success' => '操作成功',
            'member_not_exist' => '会员信息不存在',
            'net_again_err' => '网络错误，请重试',
            'err_code' => '错误代码：',
            'err_msg' => '错误信息：',
            'money_desc' => ':money 元',
            'server_error' => '服务器内部错误',
            'phone_not_exist' => '手机号码不存在',
            'phone_existed' => '手机号码已存在',
        ],

        'index' => [
            'main_advertise_title_1' => '新会员优惠',
            'main_advertise_title_2' => '电子游戏专属优惠',
            'main_advertise_title_3' => '真人视讯专属优惠',

            'main_advertise_sub_title_1' => '更多优惠尽在VIP',
            'main_advertise_sub_title_2' => '电子游艺专属存款送25%优惠',
            'main_advertise_sub_title_3' => '会员首笔存款得30％的奖金',

            'hotgame_sub_title_1' => '泰国斗鸡比赛全覆盖，玩法多元极致享受，为您提供 全网最丰富的斗鸡娱乐游戏。',
            'hotgame_sub_title_2' => '秉承匠人之心推陈出新，为玩家提供极致的游戏体验。触手可及的千万累计奖池，等您一触即发！',
            'hotgame_sub_title_3' => '最真实的赌场环境，最美丽、最专业的荷官，为您呈现奢华百家乐，玩法多样不重复，为您献上现场精彩体验！',
        ],

        'lottery' => [
            'K3' => '快三',
            '11X5' => '十一选五',
            'SSC' => '时时彩',
            'FFC' => '分分彩',
            'PK10' => 'PK10',
            '3D' => '3D',
            'OTHERS' => '其它'
        ],

        'sms' => [
            'code_required' => '请填写短信验证码',
            'code_get_first' => '请先获取短信验证码',
            'code_expired' => '短信验证码已过期，请重新获取；',
            'code_error' => '短信验证码填写错误，请重试',
            'operation_repeat' => '两分钟内接收过验证码，请勿频繁操作',
        ],

        'apply_agent' => [
            'member_is_agent' => '您已经是代理，不需要申请',
            'has_applied' => '您已经提交过申请，请耐心等待',
            'apply_success' => '申请提交成功',
            'apply_fail' => '申请提交失败，请重试',
            'status_fail' => '您还未申请过代理',
            'not_agent' => '您还不是代理'
        ],

        'member_bank' => [
            'create_success' => '银行数据创建成功',
            'create_fail' => '银行数据创建失败，请重试',
            'update_success' => '银行数据更新成功',
            'update_fail' => '银行数据更新失败，请重试',
            'delete_success' => '银行数据删除成功',
            'delete_fail' => '银行数据删除失败，请重试'
        ],

        'recharge' => [
            'payment_closed' => '该支付通道已关闭，请重新选择',
            'pay_between' => '转账金额范围是 :min ~ :max 元，请检查',
            'pay_success' => '提交成功，请支付',
            'payment_change' => '收款信息已经发生改变，请重新提交',
            'pay_normal_success' => "充值申请提交成功，请等待管理员审核",
            'pay_normal_fail' => "充值申请提交失败，请重试",

            'not_third_pay' => '该支付方式不是第三方支付',
            'param_not_all' => '参数不完整',
            'config_err' => '第三方支付配置错误',

            'pay_money_err' => '请输入交易比例整数倍的金额',
        ],

        'drawing' => [
            'qk_pwd_required' => '请输入正确的取款密码',
            'qk_pwd_error' => '取款密码输入错误，请重试',
            'money_not_enough' => '提款金额大于现有金额，请修改',
            'bank_not_exist' => '银行卡信息不存在，请检查',
            'time_not_allow' => '当前时间无法提款',
            'min_money' => '提款金额低于最低提款金额 :min',
            'max_money' => '提款金额高于最高提款金额 :max',
            'times_not_enough' => '今日提款申请次数超限，请明日再来',
            'drawing_success' => '提款申请提交成功，请等待管理员审核',
            'drawing_fail' => '提款申请提交失败，请重试:',
            'ml_calc_err' => '码量计算错误：'
        ],

        'message' => [
            'send_success' => '站内信发送成功，请等待管理员回复',
            'send_fail' => '站内信发送失败，请重试',
            'update_success' => '更新站内信状态为：',
            'update_fail' => '站内信状态更新失败',
            'delete_success' => '站内信删除成功',
            'delete_fail' => '站内信删除失败'
        ],

        'modify_pwd' => [
            'password_error' => '原始密码错误，请检查',
            'password_success' => '密码修改成功',
            'password_fail' => '密码修改失败',

            'qk_pwd_set' => '您已设置过取款密码，无须再次设置',
            'qk_pwd_success' => '取款密码设置成功',
            'qk_pwd_fail' => '取款密码设置失败',
            'qk_pwd_error' => '原始取款密码错误，请检查',
            'qk_pwd_set_success' => '取款密码修改成功',
            'qk_pwd_set_fail' => '取款密码修改失败'
        ],

        'redbag' => [
            'not_open' => '该功能已关闭',
            'no_times' => '今日抢红包次数已达上限，请明日再来',
            'success' => '恭喜您，抢到金额 :money 元的红包，请在交易记录中查看到账清况'
        ],

        'dailybonus' => [
            'not_open' => '签到功能暂未开放',
            'no_times' => '您今日已经签到，无须再次签到',
            'success' => '签到成功',
            'fail' => '签到失败',
            'check_day_not_enough' => '不符合领取要求，请检查',
            'check_repeat' => '您已领取过该签到奖励或在申请中，请勿重复领取或申请',
            'check_success' => '签到奖励领取成功',
            'check_admin_check' => '签到申请提交成功，请等待管理员审核',
            'get_bonus_success' => '会员【 :name 】领取签到奖励【 :money 元】',
        ],

        'fs_now' => [
            'get_success' => '实时反水领取成功，请在交易记录中查看明细',
            'fs_level_err' => '未配置反水等级，请联系客服',
            'fs_no_data' => '没有可以领取的返水',
            'fs_not_open' => '该功能暂未开放',
            'fs_repeat' => '该部分反水已经领取，请勿重复操作'
        ],

        'yuebao' => [
            'plan_require' => '请选择购买方案',
            'amount_regex' => '购买金额必须是10的倍数',
            'plan_not_exist' => '购买方案不存在',
            'plan_sold_out' => '该方案已售完',
            'no_enough_amount' => '购买数量超过上限，请重试',
            'member_no_money' => '账户余额不足，请充值',
            'success' => '购买成功',
            'back_success' => '赎回成功，【本金+利息】共【 :money 元】已转入您的账户'
        ],

        'transfer' => [
            'api_not_open' => '未开通',
            'change_hand' => '已切换为【手动转入游戏】模式',
            'change_auto' => '已切换为【自动转入游戏】模式',

            'field' => [
                'fs_money' => '反水钱包',
                'money' => '中心钱包'
            ]
        ],

        'team' => [
            'not_direct_child' => '该账号不是您的直属下级账号，无法进行操作',
            'member_name_regex' => '用户名必须以小写字母开头并且只能包含小写字母和数字',
            'not_set_rate' => '请设置所有游戏类型的返点点位',
        ],

        'register' => [
            'captcha_required' => '请输入正确的验证码',
            'register_fail' => '注册失败',
            'register_success' => '注册成功',
            'invite_code_required' => '请填写邀请码信息'
        ],

        'login' => [
            'name_psd_err' => '账号或密码错误',
            'demo_not_open' => '系统未开启试玩功能',
        ],

        'activity' => [
            'no_need_apply' => '该活动不需要申请',
            'apply_repeat' => '您今日已经申请过该活动，请勿重复申请',
            'apply_success' => '申请成功，请等待处理结果',
            'apply_fail' => '申请失败，请重试',
        ],

        'wheel' => [
            'wheel_desc' => '当日在 :name 最低存款 :money 以上，且有效总投注额达到享受礼金最低存款要求的 :times 倍及以上的会员，将获得幸运转盘次数，并有机会获得 :award ，名额不限，赶快参与！'
        ],

        'credit_pay' => [
            'not_open' => '【借呗】尚未开启',
            'member_not_exist_or_forbidden' => '会员不存在或被禁用',
            'member_info_error' => '会员信息输入有误',
            'user_credit_remained' => '查询到您还有借款未还清，请再还清借款后再借款',
            'borrow_max' => '最多只能借款【 :money 元】',
            'borrow_success' => '申请已提交，提交成功2小时后请到“信用额度查询”是否借款成功',
            'lend_total' => '请一次还完所有欠款',
            'money_not_enough' => '请保证中心账户中有足够的钱用来还款',
            'lend_success' => '还款成功'
        ],

        'game' => [
            'not_login' => '请先登录',
            'no_api_code' => '需要api_code参数',
            'api_member_lang_not_equal' => '所进接口货币与会员货币不一致',
            'demo_game' => '试玩账号只能进入系统彩接口',
            'api_code_not_exist' => '接口不存在，请检查',
            'api_code_not_open' => '接口未开放，请选择其它游戏',
            'operate_fail' => '操作失败，:msg 请联系客服',
            'member_api_create_err' => '本地创建会员API账号失败',
            'api_money_not_enough' => '接口余额不足，请联系客服',
            'member_money_not_enough' => '账户余额不足，无法转入接口 :money 元',
            'api_money_transfer_fail' => '扣除账户金额失败，',
            'api_money_transfer_add_fail' => '转入游戏后增加接口金额操作异常，',
            'api_money_transfer_back_fail' => '【 :title】游戏接口退还账户金额操作异常，',
            'api_money_transfer_err' => '转入【 :title】接口失败，错误信息:',
            'api_money_transfer_success' => '转入【 :title】接口成功',

            'transfer_out_error' => '【 :money】接口余额不足，转出游戏失败',
            'transfer_out_api_error' => '转出游戏【:title】接口额度失败，错误信息：',
            'transfer_out_add_error' => '转出【:title】接口后扣除接口金额，增加用户账户金额操作异常：',
            'transfer_out_success' => '转出【:title】游戏成功',
            'api_parameter_err' => '系统参数有误',
            'lottery_error' => '系统彩地址错误，未开通本地彩票功能，请联系开户人员',
            'lottery_api_not_exist' => '系统彩地址错误，未开通本地彩票功能，请联系开户人员',
        ],

        'agent_fd_rates' => [
            'lower_than_system' => '游戏类型【 :game_type】的反水点位不能低于系统设置的最低点位【 :rate】',
            'higher_than_system' => '游戏类型【 :game_type】的反水点位不能高于系统设置的最高点位【 :rate】',
            'rate_not_set' => '您游戏类型【 :game_type】的反水点位尚未设置，请联系您的上级代理或者管理员',
            'child_rate_err' => '下级游戏类型【 :game_type】的反水点位不能高于自身的点位【 :rate】',
            'top_rate_err' => '游戏类型【 :game_type】的反水点位不能低于该代理的下级的最高点位【 :rate】',
            'agent_rate_err' => '游戏类型【 :game_type】的反水点位不能高于自身的点位【 :rate】',
        ],

        'invite_rate' => [
            'self_rate_err' => '邀请注册链接【 :game_type】类型的返点不能高于您自身的返点',
            'lower_than_system' => '邀请注册链接【 :game_type】类型的返点不能低于系统设置的最低点位【 :rate】'
        ],

        'captcha' => [
            'check_err' => '验证码错误',
            'out_of_date' => '验证码已过期，请刷新重试',
        ],

        'task' => [
            'no_task' => '没有需要完成的任务',
            'task_complete_title' => '任务完成通知',
            'task_complete_desc' => '恭喜您完成任务【 :title】，任务奖励：',
            'level_up_desc_start' => '发放会员【 :name】从【:old_level 级】到【:level 级】的晋级奖励，奖励内容包括：“',
            'level_up_award' => '晋级奖励',
            'level_up_title' => '晋级奖励发放通知',
            'level_up_desc' => '恭喜您领取【 :old_level 级 ~ :level 级】晋级奖励。',
            'week_award_title' => '周俸禄发放通知',
            'week_award_desc' => '恭喜您领取【 :level 级】周俸禄【 :money 元】',
            'month_award_title' => '月俸禄发放通知',
            'month_award_desc' => '恭喜您领取【 :level 级】月俸禄【 :money 元】'
        ],

        'level_config' => [
            'level_up_award_title' => '晋级礼金发放通知',
            'level_up_award_desc' => '恭喜您升级到【 :level_name】，升级奖励为金额【:money 元】，信用额度奖励【:credit 元】',
            'level_up_award_msg' => '会员【 :name】领取【 :level】级晋级礼金【 :money 元】，信用额度奖励【:credit 元】',

            'day_bonus_award_title' => '每日礼金发放通知',
            'day_bonus_award_desc' => '恭喜您领取【 :level 级】每日礼金【 :money 元】',
            'day_bonus_award_msg' => '会员领取【 :level级】每日礼金，发放奖励【 :money 元】',

            'week_bonus_award_title' => '每周礼金发放通知',
            'week_bonus_award_desc' => '恭喜您领取【 :level 级】每周礼金【 :money 元】',
            'week_bonus_award_msg' => '会员领取【 :level级】每周礼金，发放奖励【 :money 元】',

            'month_bonus_award_title' => '每月礼金发放通知',
            'month_bonus_award_desc' => '恭喜您领取【 :level 级】每月礼金【 :money 元】',
            'month_bonus_award_msg' => '会员领取【 :level级】每月礼金，发放奖励【 :money 元】',

            'year_bonus_award_title' => '每年礼金发放通知',
            'year_bonus_award_desc' => '恭喜您领取【 :level 级】每年礼金【 :money 元】',
            'year_bonus_award_msg' => '会员领取【 :level级】每年礼金，发放奖励【 :money 元】',
        ]
    ],

    'configs' => [
        "is_redbag_open" => "是否开启红包",
        "redbag_min_money" => "红包最小金额",
        "redbag_max_money" => "红包最大金额",
        "redbag_day_times" => "每日抢红包次数",
        "is_daily_bonus_open" => "是否开启签到",
        "is_daily_bonus_auto" => "签到是否自动领奖",
        "activity_money_type" => "活动奖励发放钱包类型",
        "member_fs_money_type" => "会员反水发放钱包",
        "is_realtime_fs_mode" => "是否开启时时反水模式",
        "activity_yuebao_plan_enable" => "是否开放余额宝方案购买",
        "activity_yuebao_enable" => "是否开放余额宝",
        "activity_wheel_is_open" => "是否开启幸运大转盘活动",
        "is_system_maintenance" => "是否开启系统维护",
        "system_maintenance_whitelist" => "系统维护IP白名单",
        "site_domain" => "活动站域名",
        "wap_qrcode" => "手机APP下载二维码",
        "wap_app_link" => "手机APP下载地址",
        "service_link" => "客服链接",
        "kefu_wechat_qrcode" => "微信客服二维码",
        "site_logo" => "网站Logo",
        "site_logo2" => "网站备用LOGO",
        "kefu_qq" => "客服QQ",
        "site_email" => "网站邮箱",
        "site_slogan" => "网站副logo",
        "site_pc" => "电脑端地址",
        "site_mobile" => "手机端网址",
        "is_scroll_adv_open" => "是否开启滚动广告",
        "is_demo_play_open" => "是否开启试玩功能",
        "is_open_register" => "是否开放注册页面",
        "activity_jiebei_enable" => "是否开启借呗",
        "transfer_start" => "提款开始时间",
        "transfer_end" => "提款截止时间",
        "min_transfer" => "最低提款金额",
        "max_transfer" => "最高提款金额",
        "ml_percent" => "码量百分比",
        "ml_drawing_percent" => "码量有剩余时提款手续费百分比",
        "daili_active_money" => "活跃会员充值金额标准",
        "agent_fd_mode" => "是否启用无限代理模式",
        "is_auto_agent" => "会员注册默认是代理",
        "notice_type" => "提醒模式",
        "yuebao_audio" => "余额宝购买声音提醒",
        "activity_audio" => "活动申请声音提醒",
        "message_audio" => "站内信声音提醒",
        "member_audio" => "玩家登录声音提醒",
        "drawing_audio" => "提款声音提醒",
        "rechargel_audio" => "充值声音提醒",
        "agent_apply_audio" => "代理申请未处理",
        "credit_apply_audio" => "借呗申请未处理",
        "credit_overdue_audio" => "借呗逾期提醒",
        "system_maintenance_message" => "网站维护提示信息",
        "bank_desc" => "公司简介",
        "site_title" => "网站标题",
        "site_keyword" => "网站关键字",
        "site_name" => "网站名称",
        "online_pay_title" => "在线支付标题",
        "online_pay_desc" => "在线支付介绍",
        "company_pay_title" => "公司入款标题",
        "company_pay_desc" => "公司入款介绍",
        "register_remark" => "注册说明",
        "register_agreement" => "注册协议",
        "nav_jiechi" => "劫持教程",
        "guideline_desc" => "简易线路描述",
        "hotgame_desc" => "热门游戏描述",
        "wheel_rule" => "幸运大转盘活动条款与规则",
        "credit_detail" => "借呗活动详情",
        "credit_rule" => "借呗信用规则",
        "credit_xize" => "借呗活动细则",
        "credit_borrow" => "借呗借款说明",
        "credit_lend" => "借呗还款说明",
        "levelup_slot_activity" => "电子升级活动详情",
        "levelup_slot_example" => "电子升级活动举例",
        "levelup_slot_level" => "电子升级升级说明",
        "levelup_slot_month" => "电子升级月俸禄说明",
        "levelup_live_activity" => "真人升级活动详情",
        "levelup_live_example" => "真人升级活动举例",
        "levelup_live_level" => "真人升级升级说明",
        "levelup_live_month" => "真人升级月俸禄说明",
        "app_tuiguang" => "推广教程",
        "app_xima" => "洗码教程",
        "app_fanyong" => "返佣比例",
        "app_xima_text" => "洗码说明",
        "activity_shengji_enable" => "是否开启升级活动",
        "vip1_is_register_sms_open" => "是否开启注册短信验证",
        "service_link" => "客服链接",
        "service_line" => "Line",
        "service_line_pic" => "Line二维码",
        "service_phone" => "电话",
        "service_phone2" => "电话2",
        "is_backend_google_auth" => "后台登录是否开启谷歌验证码",
        "service_skype" => "Skype",
        "service_telegram" => "Telegram",
        "service_logo_link" => "LOGO跳转链接",
        "vip1_is_login_captcha_open" => "是否开启会员登录验证码",

        "vip1_lang_default" => "前端默认语种",
        "vip1_lang_fields" => "前端开启语种"
    ],

    'agent_page' => [
        'login' => [
            'username' => '用户名',
            'password' => '密码',
            'captcha' => '验证码',
            'refresh' => '点击刷新',
            'login' => '立即登录',
        ],

        'basic' => [
            'main_title' => '代理管理后台',
        ],

        'title' => [
            'main' => '后台首页',
            'offline' => '下线会员',
            'offline_list' => '下线列表',
            'promote_site' => '推广网址',
            'agent_report' => '代理报表',
            'recharge_list' => '会员存款记录',
            'drawing_list' => '会员提款记录',
            'money_log' => '下线余额变动记录',
            'fd_logs' => '下线返点记录',
            'game_records' => '会员输赢报表'
        ],

        'notice' => [
            'traditional_only' => '只有【传统代理模式】才能访问该页面，目前是【全民代理】模式',
            'allagent_only' => '只有【全民代理】才能访问该页面，目前是【传统代理模式】模式',
            'rate_not_exist' => '会员返点信息不存在',
            'direct_rate_modify' => '只能修改直属下级的点位'
        ],

        'desc' => [
            'offline_num' => '下线会员人数',
            'agent_default_rate' => '下线代理默认返点',
        ],

        'field' => [
            'is_agent' => '是否代理',
            'register_at' => '注册时间',
            'own_rate' => '自身返点',
            'unset' => '未设置',
            'offline_default_rate' => '下线默认点位',
            'pc_agent_url' => 'PC推广网址',
            'wap_agent_url' => 'WAP推广网址',
            'qrcode_title' => '推广二维码',
            'time_range' => '起止时间',

            'total_deposit' => '存款总额',
            'recharge_count' => '存款笔数',
            'total_drawing' => '提款总额',
            'drawing_count' => '提款笔数',
            'dividend_hongli' => '红利金额',
            'dividend_activity' => '活动赠送',
            'dividend_fs' => '反水',
            'dividend_other' => '其它',
            'total_profit' => '总盈利',
            'member_win_and_loss' => '会员输赢',

            'add_sub' => '增加/减少',
            'fs_center' => '反水/中心钱包',

            'api_name' => 'API接口'
        ],

        'btn' => [
            'set_offline_default' => '设置下级默认返点',
            'qrcode' => '查看二维码'
        ]
    ]
];
