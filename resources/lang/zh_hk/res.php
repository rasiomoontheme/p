<?php

return [
    'common' => [
        'operate' => '操作',
        'select_default' => '--請選擇--',
        'page_notice' => '<strong>註意：</strong> 需點擊右側刷新按鈕文字才能刷新本頁',
        'title' => '後臺管理系統',
        "lang" => "語言",

        'created_at' => '創建時間',
        'updated_at' => '更新時間',
        'total' => '總共',
        'count' => '條',
        'sum' => '總合計',
        'upload_image' => '上傳圖片',
        'quick_operate' => '快捷操作',

        'member_id' => '會員賬號',
        'member_name' => '會員賬號',
        'user_id' => '管理員賬號',
        'api_id' => '接口賬號',
        'agent_id' => '代理賬號',
        'top_id' => '上級代理',
        'game_type' => '遊戲類型',
        'deleted' => '已刪除',

        'login_notice' => '登錄提醒',
        'inner' => '內部',

        'recharge_list' => '充值列表',
        'drawing_list' => '提款列表',
        'user_info' => '個人信息',
        'modify_pwd' => '修改密碼',
        'lang_title' => '系統語言/Language',
        'fix_url' => '修復圖片地址',
        'fix_url_notice' => '確定進行修復圖片操作嗎？修復前的地址請填在【系統配置 - 網站主域名】，修復後的地址請填在網站根目錄的.env文件的“APP_URL”字段；整個過程耗時較長，請耐心等待',
        'logout' => '退出登錄',
        'logout_title' => '確定要退出系統嗎',
        'user_google' => '綁定谷歌驗證碼',
        'color_header' => '頭部',
        'color_sidebar' => '側邊欄',
        'no_limit' => "無限製",
        'lang_notice' => '由於系統線路涉及到多語言/幣種，需要先選擇“語言/幣種”才能查詢數據'
    ],

    'base' => [
        'add_success' => '新增數據成功',
        'add_fail' => '新增數據失敗',
        'update_success' => '更新數據成功',
        'update_fail' => '更新數據失敗',
        'delete_success' => '刪除成功',
        'delete_fail' => '刪除失敗',
        'save_success' => '保存成功',
        'save_fail' => '保存失敗',
        'operate_success' => '操作成功',
        'operate_fail' => '操作失敗，請重試',
        'operate_msg' => '操作失敗：',
        'batch_add_success' => '批量添加成功',
        'batch_add_fail' => '批量添加失敗',

        'account_forbidden' => '該賬號被禁用',
        'login_success' => '登錄成功',
        'illegal_operation' => '非法操作',
        'item_select_required' => '請選擇需要操作的列',
    ],

    'upload' => [
        'file_type_error' => '無法識別文件類型',
        'file_size_error' => '上傳文件太大,無法上傳',
        'image_file_required' => '請選擇需要上傳的圖片',
        'image_ext_required' => '請上傳圖片格式的文件',
        'file_required' => '請選擇需要上傳的文件',
        'file_ext_error' => '請上傳指定格式的文件',
        'image_size_get_error' => '獲取文件尺寸出錯',
        'file_delete_error' => '文件刪除失敗',
        'file_upload_success' => '文件上傳成功'
    ],

    'notice' => [
        'recharge_title' => '充值列表',
        'recharge_notice' => '<p>您有 <span id="rechargeNum" data-name="rechargel_audio" data-sec="0" >0</span> 條匯款請求未處理</p>',
        'drawing_title' => '提款列表',
        'drawing_notice' => '<p>您有 <span id="drawingNum" data-name="drawing_audio" data-sec="2">0</span> 條提款請求未處理</p>',
        'message_title' => '站內信列表',
        'message_notice' => '<p>您有 <span id="messageNum" data-name="message_audio" data-sec="4">0</span> 條站內信未處理</p>',
        'memberagentapplies_title' => '會員代理申請列表',
        'memberagentapplies_notice' => '<p>您有 <span id="agentAppliesNum" data-sec="6" data-name="agent_apply_audio">0</span> 條代理申請未處理</p>',
        'members_title' => '會員列表',
        'members_notice' => '<p>您有 <span id="memberNum" data-name="member_audio">0</span> 條特定會員登錄提醒</p>',
        'activityapplies_title' => '會員活動申請',
        'activityapplies_notice' => '<p>您有 <span id="activityNum" data-name="activity_audio">0</span> 條會員活動申請</p>',
        'memberyuebaoplans_title' => '會員余額寶購買記錄列表',
        'memberyuebaoplans_notice' => '<p>您有 <span id="yuebaoNum" data-name="yuebao_audio">0</span> 條余額寶購買提醒</p>',
        'creditpayrecord_title' => '借唄記錄列表',
        'creditpayrecord_notice' => '<p>您有 <span id="creditAppliesNum" data-name="credit_apply_audio">0</span> 借唄申請提醒</p>',
        'creditpayrecord_overdue_title' => '借唄記錄列表',
        'creditpayrecord_overdue_notice' => '<p>您有 <span id="creditOverdueNum" data-name="credit_overdue_audio">0</span> 借唄逾期提醒</p>'
    ],

    'btn' => [
        'add' => '新增',
        'batch_delete' => '批量刪除',
        'batch_add' => '批量新增',
        'search' => '搜索',
        'reset' => '重置',
        'edit' => '編輯',
        'detail' => '詳情',
        'delete' => '刪除',
        'refresh' => '刷新',
        'collapse' => '折疊',
        'back' => '返回',
        'save' => '保存內容',
        'export' => '導出',

        'title' => '標題',
        'content' => '內容'
    ],

    'index' => [
        'title' => '首頁',
        'today_register' => '今日註冊人數',
        'today_free' => '今日營銷成本',
        'today_bet' => '今日玩家投註量',
        'today_game_profit' => '今日遊戲總營收',
        'month_register' => '本月註冊人數',
        'month_free' => '本月營銷成本',
        'month_bet' => '本月玩家投註量',
        'month_game_profit' => '本月遊戲總營收',
        '10_days_recharge' => '最近10天充值記錄',
        '10_days_drawing' => '最近10天提款記錄',
        'welcome' => '歡迎你，',
        'recharge_title' => '充值金額',
        'drawing_title' => '提款金額',

        'site_domain_required' => '請確保【系統配置 - 網站主域名】中填上替換前的網址',
        'app_url_required' => '請確保在網站根目錄".env"文件的APP_URL字段填上替換後的網址',
        'url_same_error' => '替換前後的網址一致，請檢查',
    ],

    'member' => [
        'field' => [
            "name" => "用戶名",
            "password" => "密碼",
            "original_password" => "API密碼",
            "o_password" => "原始密碼",
            "nickname" => "昵稱",
            "realname" => "真實姓名",
            "email" => "電子郵件",
            "phone" => "手機號碼",
            "qq" => "QQ號碼",
            "gender" => "性別",
            "invite_code" => "邀請碼",
            "qk_pwd" => "取款密碼",
            "money" => "中心賬戶余額",
            "fs_money" => "返水賬戶余額",
            "total_money" => "平臺總投註額",
            "ml_money" => "碼量余額",
            "score" => "積分",
            "total_credit" => "借唄總額度",
            "used_credit" => "借唄已用額度",
            "register_ip" => "註冊IP",
            "register_area" => "註冊地區",
            "register_site" => "註冊渠道",
            "status" => "狀態",
            "is_tips_on" => "是否開啟登錄提示",
            "is_in_on" => "是否內部賬號",
            "top_id" => "上級代理id",
            "agent_id" => "代理id",
            "level" => "VIP等級",
            "is_demo" => "是否試玩賬號",

            "is_online" => "是否在線",
            "lang" => "語言/幣種"
        ],

        'index' => [
            'title' => '會員列表',
            'register_setting' => '註冊選項設置',
            'is_agent_and_top_agent' => '是否代理/上級代理',
            'last_ip' => '上次登錄IP',
            'title_modify_money' => '更改會員余額',
            'title_assign_agent' => '設為代理',
            'title_assign_member_agent' => '設置賬號【:name】為代理',
            'title_modify_top' => '分配代理',
            'title_modify_member_top' => '分配賬號【:name 】的上級代理'
        ],
        'edit' => [
            'title_edit' => '會員修改',
            'title_create' => '會員新增',
            'is_tips_on_notice' => '開啟後每次該玩家登陸會有後臺提示音',
            'is_in_on_notice' => '開啟後該會員輸贏不記錄統計'
        ],

        'member_apis' => [
            'title' => '會員接口額度',
            'api_title' => '接口名稱',
            'money' => '額度',
            'null' => '未開通',
            'refresh' => '刷新接口余額',
            'recycle' => '一鍵回收',
        ],

        'modify_money' => [
            'title' => '會員額度修改',
            'is_add_ml' => '同時增加碼量',
            'is_add_ml_notice' => '增加比例參考 【系統配置】 - 【代理相關】 - 【提款百分比】',
        ],

        'modify_top' => [
            'notice' => '<strong>註意：</strong> 該賬號之前未設置過返點，分配上級後會根據所分配的上級賬號自動分配返點'
        ],

        'money_report' => [
            'title' => '財務報表',
            'notice' => '<strong>註意：</strong> 正數為平臺盈利，負數為平臺虧損',
            'created_at' => '時間範圍',
            'is_agent_and_top_agent' => '代理/上級',
            'recharge_count' => '存款次數',
            'drawing_count' => '取款次數',
            'recharge_sum' => '存款總金額',
            'drawing_sum' => '提款總金額',
            'total_fs' => '總返水',
            'total_dividend' => '總紅利',
            'total_other' => '總其它',
            'total_profit' => '盈虧總額',

            'profit_formula_notice' => '盈虧計算公式及說明',
            'profit_formula' => '存款—提款—返水—紅利-其它＝實際盈虧',
            'yinli' => '盈利：',
            'kuisun' => '虧損：'
        ],

        'msg' => [
            'money_negative_error' => '修改後的金額為負數，請檢查',
            'password_at_least_6' => '密碼長度最少是六位',
            'balance_error' => '余額查詢失敗，錯誤信息:',
            'offline_success' => '已將會員【 :name 】踢下線',
            'member_offlined' => '會員【 :name 】目前已離線',
        ]
    ],

    'agent' => [
        'field' => [
            "member_id" => "會員ID",
            "agent_pc_uri" => "代理PC鏈接",
            "agent_wap_uri" => "代理WAP鏈接",
            "agent_real_pc_url" => "代理PC鏈接",
            "agent_real_wap_url" => "代理WAP鏈接",
            "agent_uri_pre" => "代理鏈接前綴",
            "apply_data" => "申請信息",
            "remark" => "備註",
        ],

        'assign' => [
            'notice' => '該會員之前的代理號被刪除，請選擇重新創建代理或者沿用舊代理賬號'
        ],

        'index' => [
            'top_notice' => '<strong>註意：</strong> 新建代理請在【會員列表】中設置會員成為代理',
            'btn_fd_rate' => '反點點位',
            'title_fd_rate' => '代理 :name 反點點位',
            'btn_fd_record' => '反點記錄',
            'title_fd_record' => '代理 :name 反點記錄',
        ],

        'msg' => [
            'assign_type_required' => '請選擇分配模式',
            'assign_operate_error' => '分配代理失敗：',
            'assign_operate_success' => '分配代理成功',
        ]
    ],

    'user' => [
        'field' => [
            "name" => "用戶名",
            "password" => "密碼",
            "status" => '狀態',
            "create_ip" => "創建IP",
            "google_secret" => "谷歌驗證碼",
            "is_google_secret" => "是否綁定谷歌驗證碼",
        ],

        'status' => [
            1 => '正常',
            -1 => '禁止'
        ],

        'index' => [
            'btn_assgin' => '分配角色'
        ],

        'modify_pwd' => [
            'oldpassword' => '原始密碼',
            'password' => '新密碼',
            'password_confirmation' => '確認新密碼',
        ],

        'assign' => [
            'role' => '角色'
        ],

        'msg' => [
            'oldpassword_error' => '原始密碼錯誤，請檢查',
            'modify_success_login' => "密碼修改成功,請重新登錄",
            'modify_error' => '密碼修改失敗',
            'assign_success' => '角色分配成功',
            'assign_fail' => '角色分配失敗',
        ],

        'login' => [
            'google_auth_error' => '谷歌驗證碼填寫錯誤',
        ],

        'google' => [
            'first_notice' => '第一次綁定，請使用谷歌驗證器APP直接掃描二維碼，輸入手機上的谷歌驗證碼，然後提交綁定；',
            'reset_notice' => '您已經綁定過谷歌驗證碼，如果需要重新綁定，請聯系管理員',
            'scan_qrcode' => '掃碼綁定',
            'secret_notice' => '請在掃碼後，輸入手機上的谷歌驗證碼',
            'submit' => '提交綁定',
            'reset_own_error' => '無法重置自己的賬號，請聯系總管理員',
            'reset_btn' => '重置谷歌驗證碼',
            'reset_message' => '確定要重置該賬戶的谷歌驗證碼嗎？',
        ]
    ],

    'role' => [
        'field' => [
            'name' => '用戶名',
            'description' => '描述',
        ],

        'index' => [
            'btn_assign' => '分配權限',
        ],

        'assign' => [
            'permission' => '權限',
            'check_all' => '全選'
        ],

        'msg' => [
            'assign_success' => '權限分配成功',
            'assign_fail' => '權限分配失敗',
        ]
    ],

    'permission' => [
        'field' => [
            'name' => '權限名稱',
            'icon' => '圖標',
            'pid' => '父級ID',
            'route_name' => '路由名稱',
            'weight' => '權重',
            'description' => '描述',
            'remark' => '備註',
            'is_show' => '是否顯示'
        ],

        'is_show' => [
            0 => '不顯示',
            1 => '顯示'
        ],

        'index' => [
            'btn_child' => '創建子權限',
        ],

        'msg' => [
            'lang_json_error' => '多語言權限名稱填寫錯誤'
        ]
    ],

    'black_ip' => [
        'field' => [
            "ip" => "IP地址",
            "is_open" => "是否開啟",
            "remark" => "備註信息",
        ]
    ],

    'apis' => [
        'field' => [
            "api_id" => "接口ID",
            "api_name" => "平臺標識",
            "api_title" => "平臺描述名稱",
            "api_money" => "接口余額",
            "prefix" => "賬號前綴",
            "is_open" => "是否開放",
            "lang" => "幣種",
            "lang_list" => "支持語言",
            "weight" => "權重",
            "remark" => "備註",
            'icon_url' => '電子側邊欄圖標',
            'logo_url' => 'pc 下拉展示logo'
        ],

        'index' => [
            'top_title' => 'API接口基礎配置',
            'api_domain' => '基礎域名',
            'api_prefix' => '前綴',
            'btn_refresh' => '刷新接口余額',
            'config_title' => '網站基礎配置',
        ],

        'msg' => [
            'no_need_update_game' => '沒有需要更新的遊戲',
            'update_game_success' => '成功更新【 :update_count 】條遊戲數據，成功新增【 :create_count】條遊戲數據',
        ]
    ],

    'api_game' => [
        'field' => [
            "title" => "遊戲標題",
            "subtitle" => "副標題",
            "web_pic" => "電腦端圖片",
            "mobile_pic" => "手機端圖片",
            "api_name" => "接口標識",
            "class_name" => "樣式標識",
            "game_type" => "遊戲類型",
            "params" => "參數",
            "client_type" => "運行平臺",
            "is_open" => "是否開放",
            "weight" => "權重",
            "tags" => "標簽",
            "lang" => "語言",
            "remark" => "備註",
        ],

        'index' => [
            'top_notice' => '遊戲顯示文字 在此類修改',
            'btn_update' => '遊戲更新',
            'web_pic_notice' => '【電子】分類的圖片對應遊戲列表的Logo'
        ],

        'mobile_category' => [
            'top_notice' => '<strong>註意：</strong> 操作完需要保存才能生效',
            'web_title' => '電腦首頁導航排序',
            'key' => '標識',
            'name' => '名稱',
            'weight' => '權重',
        ]
    ],

    'game_list' => [
        'field' => [
            "api_name" => "接口標識",
            "name" => "遊戲中文名稱",
            "en_name" => "英文名稱",
            "game_type" => "遊戲類型",
            "game_code" => "遊戲ID",
            "tcg_game_type" => "TCG遊戲類型",
            "param_remark" => "參數補充",
            "img_path" => "圖片路徑",
            "img_url" => "圖片地址",
            "client_type" => "運行平臺",
            "platform" => "支持環境",
            "is_open" => "是否開放",
            "weight" => "權重",
            "tags" => "標簽",
        ]
    ],
    'game_hot' => [
        'field' => [
            'name'=>'廳名稱',
            'api_name'=> '介面名稱',
            'desc'=>'廳描述',
            'en_name'=>'廳名稱[AnhName]',
            'en_desc'=>'廳描述[AnhName]',
            'tw_name'=>'廳名稱[繁中]',
            'tw_desc'=>'廳描述[繁中]',
            'th_name'=>'廳名稱[泰文]',
            'th_desc'=>'廳描述[泰文]',
            'vi_name'=>'廳名稱[越南文]',
            'vi_desc'=>'廳描述[越南文]',
            'icon_path'=>'選中前icon',
            'icon_path2'=>'選中後icon',
            'img_url'=>'圖片地址',
            'game_code'=>'遊戲參數',
            'is_online'=>'是否上線',
            'sort'=>'排序',
            'game_type' =>'遊戲類型',
            'type' =>'位置類型',
            "lang" => "語言",
            'jump_link' =>'跳轉連結',
            'jump_link_p' => '如果是直接進入遊戲,無需填寫',
            'icon_path2_p' => '如果選擇首頁遊戲分類位置,則無需上傳',
            'is_new_window' => '是否在新窗口打開'
        ],
        'hot_game_place_type' => [
            1 => '熱門遊戲版塊',
            2 => '首頁遊戲分類'
        ],
    ],



    'admin_log' => [
        'field' => [
            'user_id' => '管理員ID',
            'user_name' => '管理員用戶名',
            'url' => '操作地址',
            'data' => '操作數據',
            'ip' => '操作IP',
            'address' => 'IP真實地址',
            'ua' => '操作環境',
            'type' => '操作類型',
            'type_text' => '操作類型說明',
            'description' => '操作描述',
            'remark' => '操作備註',
        ],

        'title' => [
            'login_title' => '管理員登錄日誌',
            'logout_title' => '管理員登出日誌',
            'operate_title' => '管理員操作日誌',
            'system_title' => '系統異常日誌'
        ],

        'type' => [
            '1' => '後臺登錄',
            '2' => '後臺登出',
            '3' => '後臺操作',
            '4' => '系統異常'
        ]
    ],

    'member_log' => [
        'field' => [
            "member_id" => "會員ID",
            "ip" => "操作IP",
            "address" => "IP真實地址",
            "ua" => "操作環境",
            "type" => "操作類型",
            "description" => "操作描述",
            "remark" => "備註",
        ]
    ],

    'member_agent_apply' => [
        'field' => [
            "member_id" => "會員ID",
            "name" => "真實姓名",
            "phone" => "電話號碼",
            "email" => "電子郵件",
            "msn_qq" => "聯系方式MSN/QQ",
            "reason" => "申請原因",
            "status" => "申請狀態",
            "fail_reason" => "失敗原因",
            "assign_type" => "分配模式"
        ],

        'index' => [
            'btn_deal' => '處理'
        ],

        'msg' => [
            'saved_cannot_modify' => '已經審核過的申請不允許修改',
            'update_and_fill_data' => '更新數據成功，請填寫代理參數',
        ],
    ],

    'agent_fd_rate' => [
        'field' => [
            "parent_id" => "父級代理ID",
            "member_id" => "當前會員ID",
            "game_type" => "遊戲類型",
            "type" => "點位類型",
            "rate" => "返點比例(%)",
            "remark" => "備註",
        ],

        'agent' => [
            'top_notice' => '<strong>註意：</strong> 該代理還未設置反點點位',
            'operate_total' => '統一設置點位',
            'btn_apply' => '應用',
            'title' => '設置代理【 :name 】反點點位',
            'system_highest' => '系統最高點位',
            'system_lowest' => '系統最低點位',
            'system_default' => '系統默認點位',
            'quick_notice' => '請輸入統一設置點位的值'
        ],

        'system' => [
            'highest_title' => '代理默認最高返點',
            'lowest_title' => '代理默認最低返點',
            'default_title' => '系統創建代理默認返點',
        ],

        'msg' => [
            'system_highest_error' => '系統遊戲類型【 :game_type 】的最高反水點位低於該類型最低的反水點位，請檢查',
            'system_lowest_error' => '系統遊戲類型【 :game_type 】的最低反水點位高於該類型最高的反水點位，請檢查',
        ],
    ],

    'agent_fd_money_log' => [
        'field' => [
            "member_id" => "玩家會員ID",
            "member_rate" => "玩家返點比例(%)",
            "agent_member_id" => "代理ID",
            "agent_member_rate" => "代理返點比例(%)",
            "child_member_id" => "下級會員ID",
            "child_member_rate" => "下級會員返點比例(%)",
            "game_type" => "遊戲類型",
            "bet_amount" => "下註金額",
            "fd_money" => "返點金額",
            "money_before" => "日誌前余額",
            "money_after" => "日誌後余額",
            "remark" => "備註",
        ]
    ],

    'daily_bonus' => [
        'field' => [
            "member_id" => "會員id",
            "bonus_money" => "簽到獎勵金額",
            "days" => "簽到設置天數",
            "serial_days" => "連續簽到天數",
            "total_days" => "累計簽到天數",
            "type" => "類型",
            "state" => "狀態",
            "remark" => "備註",
            "lang" => "語言/幣種"
        ],

        'record' => [
            'btn_confirm' => '審核通過',
            'notice_confirm' => '確定通過會員的簽到獎勵申請嗎？',
            'btn_reject' => '審核不通過',
            'notice_reject' => '確定拒絕會員的簽到獎勵申請嗎？',
        ],

        'setting' => [
            'deposit' => '當日存款金額',
            'valid_num' => '有效流水（倍數）',
            'times' => '抽獎次數',
            'is_open' => '是否啟用',
            'currency' =>'幣種',
            'min' => '最低金額',
            'max' => '最高金額',
        ],

        'msg' => [
            'same_day_error' => '已經設置過相同簽到設置天數的簽到獎勵，請檢查'
        ]
    ],

    'game_record' => [
        'field' => [
            "billNo" => "註單流水號",
            "api_name" => "接口標識",
            "name" => "玩家賬號",
            "gameType" => "遊戲類型",
            "status" => "結算狀態",
            "betTime" => "下註時間",
            "betAmount" => "下註金額",
            "validBetAmount" => "有效下註金額",
            "netAmount" => "派彩金額",
            "roundNo" => "場次信息",
            "playDetail" => "玩法詳情",
            "wagerDetail" => "下註明細",
            "gameResult" => "開獎結果",
            "is_fd" => "是否返點",

            "shuyinAmount" => "輸贏金額"
        ],

        'index' => [
            'btn_send_fd' => '發放返點',
            'notice_send_fd' => '確定發放該遊戲記錄的反水嗎？',

        ]
    ],

    'member_wheel' => [
        'field' => [
            "member_id" => "會員id",
            "user_id" => "管理員ID",
            "award_id" => "獎品ID",
            "award_desc" => "獎品描述",
            "status" => "領取狀態",
        ],

        'index' => [
            'btn_send' => '確認發放',
            'notice_send' => '確定進行確認發放處理嗎?'
        ],

        'setting' => [
            'deposit' => '當日存款金額',
            'valid_num' => '有效流水（倍數）',
            'times' => '轉盤次數',
            'awards' => '可中獎品',
            'is_open' => '是否啟用'
        ]
    ],

    'system_notice' => [
        'field' => [
            "title" => "標題",
            "content" => "內容",
            "text_content" => "APP內容",
            "group_name" => "分組名",
            "weight" => "權重",
            "url" => "跳轉鏈接",
            "is_open" => "是否啟用",
            "lang" => "語言",
        ],

        'index' => [
            'app_title' => 'APP公告列表'
        ],

        'edit' => [
            'notice_group' => '已有分組：'
        ]
    ],

    'system_config' => [
        'config_groups' => [
            'top_notice' => '<strong>註意：</strong> 操作完需要保存才會生效;需點擊右側刷新按鈕文字才能刷新本頁',
            'system' => '系統相關',
            'service' => '客服相關',
            'line' => 'Line相關',
            'site' => '站點名稱',
            'activity' => '活動相關',
            'recharge' => '支付相關',
            'drawing' => '提款相關',
            'agent' => '代理相關',
            'notice' => '提醒相關',
            'group_notice' => '<strong>註意：</strong> 該頁面的內容保存後，需要刷新整個頁面生效',
            'btn_choose' => '選擇文件',
            'btn_preview' => '預覽',
			'register'	=> '登记',
        ],

        'app_content' => [
            'top_notice' => '<strong>註意：</strong> 操作完需要保存才會生效',
            'app_content' => '內容相關'
        ],

        'config_content' => [
            'register' => '註冊相關',
            'navigate' => '導航相關',
            'activity_about' => '活動相關',
            'credit' => '借唄相關',
            'levelup_slot' => '電子升級',
            'levelup_live' => '真人升級'
        ],
    ],

    'banner' => [
        'field' => [
            "id" => "ID",
            "title" => "標題",
            "description" => "描述",
            "url" => "地址",
            "dimensions" => "寬高",
            "groups" => "分組",
            "weight" => "權重",
            "lang" => "語言",
            "is_open" => "是否開啟",
            "created_at" => "創建時間",
            "updated_at" => "更新時間",
        ],

        'index' => [
            'top_notice' => '<strong>註意：</strong> 刪除列表中的輪播圖時不會刪除”附件管理“中的上傳記錄和文件;參考尺寸：web端輪播圖尺寸【1920*418】，h5端【750*350】',
        ],

        'edit' => [
            'top_notice' => '<strong>註意：</strong> 請保持同一組圖片的尺寸大小相同',
            'group_notice' => '手機輪播圖請填“mobile1”,PC輪播圖請填“new1”'
        ]
    ],

    'about' => [
        'field' => [
            "id" => "ID",
            "title" => "標題",
            "subtitle" => "副標題",
            "cover_img" => "封面圖片",
            "content" => "內容",
            "type" => "類型",
            "is_open" => "是否開放",
            "is_hot" => "是否熱門",
            "weight" => "權重",
            "lang" => "語言",
        ]
    ],

    'sport' => [
        'field' => [
            "home_team_name" => "主隊名稱",
            "home_team_name_en" => "主隊名稱英文",
            "home_team_img" => "主隊圖片",
            "home_odds" => "主隊賠率",
            "visiting_team_name" => "客隊名稱",
            "visiting_team_name_en" => "客隊名稱英文",
            "visiting_team_img" => "客隊圖片",
            "visiting_odds" => "客隊賠率",
            "let_ball" => "讓球",
            "match_cup" => "比賽名稱",
            "match_cup_en" => "比賽名稱英文",
            "match_at" => "比賽時間",
            "is_open" => "是否開啟",
            "weight" => "權重",
        ]
    ],

    'level_config' => [
        'field' => [
            "level" => "等級",
            "level_name" => "等級名稱",
            "deposit_money" => "晉升存款金額",
            "bet_money" => "晉升投註金額",
            "level_bonus" => "晉升禮金",
            "day_bonus" => "每日禮金",
            "week_bonus" => "每周禮金",
            "month_bonus" => "每月禮金",
            "year_bonus" => "每年禮金",
            "credit_bonus" => "借唄額度獎勵",
            "levelup_type" => "晉升條件類型",
            "lang" => "語言/幣種",
        ]
    ],

    'payment' => [
        'field' => [
            "desc" => "支付方式描述",
            "account" => "收款賬號",
            "type" => "支付方式",
            "name" => "收款人姓名",
            "qrcode" => "支付二維碼",
            "memo" => "支付備註",
            "rate" => "贈送比例",
            "min" => "最低充值金額",
            "max" => "最高充值金額",
            "forex" => "交易比例",
            "lang" => "語言/幣種",
            "is_open" => "是否開啟",

            "detail" => "詳細信息",
            "range" => "單筆限額",
            "bank_type" => "銀行類型",
            "bank_address" => "開戶行地址",
            "account_id" => "第三方商戶號",
            "key" => "第三方密鑰",
            "url" => "第三方支付URL",
            "api" => "第三方支付標識",
            "paytype" => "第三方支付類型代碼",
            "usdt_type" => "USDT類型",
            "usdt_rate" => "USDT兌換匯率",
            "usdt_num" => "USDT幣數量"
        ],

        "index" => [
            'top_notice' => '存款方式頁面的標題和介紹信息請在【系統配置】 - 【系統配置分組】 - 【支付相關】 中進行配置'
        ],

        "edit" => [
            "notice_memo" => "支付時需要填寫的備註信息",
            "notice_range" => "最低充值金額和最高充值金額都是0時表示不限製充值金額數量",
            "notice_min_max" => "最低充值金額和最高充值金額都是按照平臺金額為單位",
            "notice_forex" => "兌換數量為1的平臺金額需要多少金額，列如：10人民幣兌換數量為1的平臺金額，下方\"語言/幣種\"選擇中文,交易比例填10",
        ],

        'msg' => [
            'account_id_required' => '請輸入第三方商戶號',
            'key_required' => '請輸入第三方密鑰',
            'url_required' => '請輸入第三方支付URL',
            'bank_type_required' => '請選擇銀行卡類型',
            'account_required' => '請輸入收款賬號',
            'name_required' => '請輸入收款人姓名',
            'money_range_err' => '最高充值金額不能低於最低充值金額',
            'usdt_account_required' => '請輸入USDT收款賬號',
            'usdt_rate_required' => '請輸入USDT兌換匯率',
            'usdt_rate_valid' => '請輸入有效的USDT兌換匯率',
        ]
    ],

    'activity' => [
        'field' => [
            "title" => "標題",
            "subtitle" => "副標題",
            "cover_image" => "列表封面圖",
            "content" => "活動說明",
            "type" => "活動類型",
            "apply_type" => "申請方式",
            "apply_url" => "申請地址",
            "apply_desc" => "申請描述",
            "hall_image" => "大廳封面圖",
            "hall_field" => "申請填寫信息",
            "date_desc" => "活動時間描述",
            "date_description" => "活動時間",
            "start_at" => "活動開始時間",
            "end_at" => "活動截止時間",
            "rule_content" => "活動規則",
            "is_open" => "是否開放",
            "is_hot" => "是否熱門",
            "weight" => "權重",
            "lang" => "語言",
        ],

        'index' => [
            'btn_preview' => '預覽'
        ],

        'msg' => [
            'hall_image_required' => '請上傳活動大廳封面圖',
            'apply_url_required' => '請填寫活動申請跳轉地址'
        ]
    ],

    'activity_apply' => [
        'field' => [
            "member_id" => "會員id",
            "user_id" => "管理員ID",
            "activity_id" => "活動ID",
            "data_content" => "申請信息",
            "status" => "申請狀態",
            "remark" => "備註信息",

            "money" => "發放金額"
        ],

        'index' => [
            'btn_confirm' => '審核通過',
            'btn_reject' => '審核不通過',
            'notice_confirm' => '確定通過會員的活動申請嗎？',
            'notice_reject' => '確定拒絕會員的簽到獎勵申請嗎？',
            'btn_bonus' => '發放活動獎勵'
        ],

        'edit' => [
            'title_confirm' => '審核通過',
            'title_reject' => '審核不通過',
            'top_notice' => '<strong>註意：</strong> 如果需要派發獎勵，請在審核通過後進行處理',
            'dealed_error' => '該申請記錄已處理，請勿重復處理',
        ],

        'bonus' => [
            'top_notice' => '<strong>註意：</strong> 活動金額默認發放到反水賬戶中',
            'money_notice' => '發放至哪個錢包請在 系統設置 - 活動相關 中設置'
        ]
    ],

    'modify_pwd' => [
        'field' => [
            "oldpassword" => '原始密碼',
            "password" => '新密碼',
            "password_confirmation" => '確認新密碼',

            "qk_pwd" => '新取款密碼',
            "old_qk_pwd" => '原始取款密碼',
            "qk_pwd_confirmation" => '確認新取款密碼'
        ]
    ],

    'register' => [
        'field' => [
            'name' => '賬號',
            'password' => '密碼',
            'password_confirmation' => '確認密碼',
            'rates' => '返點比例'
        ]
    ],

    'bank' => [
        'field' => [
            "key" => "標識",
            "name" => "名稱",
            "url" => "官網",
            "is_open" => "是否開放",
            "weight" => "權重",
            "lang" => "語言"
        ]
    ],

    'member_bank' => [
        'field' => [
            "member_id" => "會員ID",
            "card_no" => "卡號",
            "bank_type" => "銀行類型",
            "bank_type_text" => "銀行類型",
            "phone" => "辦卡預留手機號",
            "owner_name" => "持卡人姓名",
            "bank_address" => "開戶行地址",
            "remark" => "操作備註",
        ],

        'index' => [
            'title' => ''
        ]
    ],

    'recharge' => [
        'field' => [
            "bill_no" => "交易流水號",
            "member_id" => "會員id",
            "name" => "轉賬人姓名",
            "account" => "轉賬賬號",
            "origin_money" => "折算前充值金額",
            "forex" => "交易（折算）比例",
            "lang" => "語言/幣種",
            "money" => "充值金額",
            "payment_type" => "支付類型",
            "payment_pic" => "支付憑證",
            "diff_money" => "贈送金額",
            "before_money" => "充值前金額",
            "after_money" => "充值後金額",
            "score" => "積分",
            "fail_reason" => "失敗原因",
            "hk_at" => "客戶填寫的匯款時間",
            "confirm_at" => "確認轉賬時間",
            "status" => "支付狀態",
            "user_id" => "管理員ID",

            'payment_id' => '收款信息',
            'payment_account' => '收款賬號',
            'payment_name' => '收款人姓名',
            'bank_type' => '收款銀行'
        ],

        'index' => [
            'btn_confirm' => "審核通過",
            'btn_reject' => "審核不通過",
            'btn_payment_detail' => "收款賬號詳情"
        ],

        'edit' => [
            'notice_diff' => "支付通道 :text 的贈送比例是 :rate"
        ],

        'msg' => [
            'recharge_dealed' => '該筆充值記錄已處理',
        ]
    ],

    'drawing' => [
        'field' => [
            "bill_no" => "交易流水號",
            "member_id" => "會員ID",
            "name" => "收款人姓名",
            "money" => "提款金額",
            "account" => "賬戶信息",
            "before_money" => "提款前金額",
            "after_money" => "提款後金額",
            "score" => "積分",
            "counter_fee" => "手續費",
            "fail_reason" => "失敗原因",
            "member_bank_info" => "用戶銀行數據json",
            "member_remark" => "用戶提款備註",
            "confirm_at" => "確認轉賬時間",
            "status" => "提款狀態",
            "user_id" => "管理員ID",
        ],

        'index' => [
            'btn_confirm' => '審核通過',
            'btn_reject' => '審核不通過'
        ],

        'msg' => [
            'dealed_error' => '該筆提款申請已處理'
        ]
    ],

    'message' => [
        'field' => [
            "user_id" => "管理員ID",
            "pid" => "上條消息ID",
            "url" => "跳轉URL",
            "title" => "站內信標題",
            "content" => "發送內容",
            "visible_type" => "可見類型",
            "send_type" => "發送類型",
        ],

        'index' => [
            'visible_member' => '可見會員',
            'all_member' => '所有會員',
        ],

        'msg' => [
            'member_select_required' => '請選擇發送給哪個會員',
            'data_select_required' => '請選擇需要操作的數據',
        ]
    ],

    'member_message' => [
        'field' => [
            'title' => '會員反饋標題',
            'content' => '會員反饋內容',
            'reply_title' => '回復標題',
            'reply_content' => '回復內容',
            'status' => '回復狀態'
        ],

        'index' => [
            'btn_batch_read' => '批量已讀',
            'btn_detail' => '反饋詳情',
            'btn_reply' => '消息回復',
            'btn_mark' => '標記回復',
            'title_mark' => '確定進行標記回復處理嗎?',
            'title_delete' => '確定刪除該回復嗎？'
        ],

        'history' => [
            'title' => '反饋詳情',
        ],
    ],

    'member_money_log' => [
        'field' => [
            "member_id" => "會員id",
            "user_id" => "管理員ID",
            "money" => "操作金額",
            "money_before" => "操作前金額",
            "money_after" => "操作後金額",
            "money_type" => "金額字段類型",
            "number_type" => "數量類型",
            "operate_type" => "金額變動類型",
            "model_name" => "模型名稱",
            "model_id" => "模型ID",
            "description" => "操作描述",
            "remark" => "操作備註",
        ],

        'notice' => [
            'activity_bonus' => '發放活動【 :title 】獎金【 :money 元】至會員【 :member 】',
            'system_send_fs' => '管理員發放時間範圍【 :time 】遊戲類型【 :game_type 】的反水至反水錢包',
            'drawing_reject' => '不通過會員的提現，將金額【 :money 元】退還至會員賬戶，拒絕理由：:reason',
            'drawing_counter_fee' => '，會員碼量為【 :ml_money 】,扣除手續費【 :count_fee元】',
            'drawing_request' => '會員最終提現金額為【 :money 】',
            'get_fs_now' => '領取日期【 :time 】之前的反水，金額為【 :money 】，遊戲類型【 :game_type】，發放至反水錢包',

            'transfer_in_game' => '轉入【 :title 】遊戲【 :money 元】，扣除賬戶金額',
            'transfer_in_error' => '轉入【 :title 】遊戲失敗，退還賬戶金額【 :money 元】',
            'transfer_out_game' => '轉出【 :title 】遊戲【 :money 元】，增加賬戶金額'
        ]
    ],

    'yuebao_plan' => [
        'field' => [
            "SettingName" => "方案標題",
            "MinAmount" => "最小購買金額",
            "MaxAmount" => "最大購買金額",
            "SettleTime" => "結算時間（小時）",
            "IsCycleSettle" => "結算方式",
            "Rate" => "方案利率",
            "TotalCount" => "計劃總金額",
            "LimitInterest" => "會員封頂利息",
            "LimitOrderIntervalTime" => "訂單間隔時間（小時）",
            "InterestAuditMultiple" => "利息碼量倍數",
            "LimitUserOrderCount" => "會員最大購買總金額",
            "is_open" => "是否開放購買",
            "weight" => "排序",
        ],

        'edit' => [
            'notice_no_limit' => '不填表示沒有限製',
            'notice_default_ml' => '默認為1倍碼量',
            'notice_weight' => '越大越靠前'
        ],

        'member_plan' => [
            'created_at' => '購買時間'
        ],

        'msg' => [
            'min_money_err' => '最低購買金額不能高於最低購買金額',
            'max_money_err' => '最高購買金額不能高於計劃總金額',
        ]
    ],

    'member_yuebao_plan' => [
        'field' => [
            "member_id" => "會員id",
            "plan_id" => "方案ID",
            "amount" => "購買金額",
            "status" => "狀態",
            "drawing_at" => "提現時間",

            "interest_sum" => "累積利息",
        ],

        'index' => [
            'title_interest_history' => '盈利記錄 - 【 :name 】'
        ]
    ],

    'interest_history' => [
        'field' => [
            "member_plan_id" => "會員方案ID",
            "interest" => "利息",
            "times" => "次數",
            "calc_at" => "結算時間",
        ]
    ],

    'credit_pay_record' => [
        'field' => [
            "member_id" => "會員id",
            "money" => "借款金額",
            "type" => "類型",
            "borrow_day" => "借款天數",
            "status" => "狀態",
            "dead_at" => "借款到期時間",

            "is_overdue" => "是否逾期"
        ],

        'index' => [
            'btn_confirm' => '通過',
            'notice_confirm' => '確定通過會員的借款操作嗎？',
            'btn_reject' => '確定拒絕會員的借款操作嗎？',
            'notice_reject' => '拒絕',

            'title_lend' => '還款記錄',
            'title_borrow' => '借款記錄',
        ]
    ],

    'quick' => [
        'member_arbitrage_query' => [
            'arbitrage_type' => '套利類型',
            'result' => '查詢結果',
            'total_number' => '總人數',
            'no_result' => '無相關數據'
        ],

        'transfer_check' => [
            'start_at' => '開始時間',
            'end_at' => '截止時間',
            'transfer_out_account' => '轉出賬戶',
            'transfer_in_account' => '轉入賬戶',
            'money' => '轉賬金額',
            'is_dd' => '是否掉單',
            'btn_supply' => '僅補單',
            'btn_supply_modify' => '補單並修改余額',

            'no_transfer_data' => '該會員在【 :start_at ~ :end_at 】之間無額度轉換記錄',
            'transfer_count_success' => '該會員在【 :start_at ~ :end_at 】之間有【 :count 】條記錄並未掉單',
            'transfer_count_fail' => '在【 :start_at ~ :end_at 】之間【 :count 】條記錄中有 :fail_count 筆訂單掉單',
            'money_not_enough' => '會員余額不足，請檢查',
        ],

        'database_clean' => [
            'top_notice' => '<strong>註意：</strong> 操作不可逆，請謹慎操作;【會員表】和【代理傭金記錄】無法根據會員名稱進行刪除，僅根據 數據清理天數 進行刪除；<br><b>如刪除會員遊戲記錄，則會導致晉級等級福利數據丟失<b>；',
            'member_notice' => '如果不選擇會員，則表示清理系統所有數據',
            'content' => '清理內容',

            'member' => '會員表',
            'agent' => '代理表',
            'agent_fd_money_log' => '代理返點金額日誌',
            'agent_yj_log' => '代理傭金記錄',
            'drawing' => '提款記錄',
            'game_record' => '會員遊戲記錄',
            'member_money_log' => '會員金額日誌',
            'recharge' => '充值記錄',
            'transfer' => '額度轉換記錄',
            'member_log' => '會員操作日誌',
            'member_wheel' => '會員輪盤記錄',
            'daily_bonus' => '會員簽到記錄',
            'member_yuebao_plan' => '會員余額寶記錄',
            'credit_pay_record' => '會員借唄記錄',
            'activity' => '活動列表',
            'activity_apply' => '會員活動申請',

            'oldest_date' => '最舊數據日期',
            'latest_date' => '最新數據日期',
            'day_before' => ':date 天前',

            'day_field' => '清理多少天前的數據',
            'days' => '清理數據天數',
            'day_notice' => '默認清理三十天外的數據',

            'alert_before' => '已選擇清理內容',
            'alert_after' => '確認清理嗎',
            'alert_title' => '操作提示',
            'alert_1' => '我再去了解一下',
            'alert_2' => '我已閱讀上述紅色文字,繼續清理',

            'item_select_required' => '請選中清理項',
        ],
    ],

    'yj_level' => [
        'field' => [
            'level' => '傭金等級',
            'name' => '等級名稱',
            'active_num' => '下線活躍人數',
            'min' => '最低流水金額',
            'rate' => '傭金比例（百分比）',
            "lang" => "幣種",
        ],

        'msg' => [
            'top_notice' => '註意：下線活躍會員判定標準是每月充值金額達到 【:money】 元，如需修改，請在 【系統配置】 - 【系統配置分組】 - 【代理相關】 頁面中進行修改'
        ]
    ],

    'agent_yj_log' => [
        'field' => [
            'created_at' => '傭金時間範圍',
            'top_title' => '代理財務報表',

            'offline' => '下線會員',
            'balance' => '下線余額',
            'transfer' => '常規存取款',
            'deposit' => '存款',
            'withdraw' => '提款',
            'bonus' => '紅利派送',
            'activity' => '活動贈送',
            'rebate' => '反水派送',
            'other' => '其它情況',
            'last_at' => '上次發放傭金時間',
            'money' => '傭金金額',
            'remark' => '發放傭金備註',

            'send_yj' => '發放傭金',
            'record' => '記錄',
            'history' => '【:name】傭金發發放歷史',
        ],

        'msg' => [
            'top_notice' => '註意：代理傭金發放是傳統代理模式，由管理員自行控製，原則上每月發放一次',

            'time_range_required' => '請先選擇傭金時間範圍',
            'yj_send_success' => '傭金發放成功',
            'yj_send_fail' => '傭金發放失敗：',
        ]
    ],

    'send_fs' => [
        'msg' => [
            'realtime_fs_mode' => '目前是實時反水模式，無法使用一鍵反水功能',
            'send_success' => '反水發放成功',
            'send_fail' => '反水發放失敗：',
        ]
    ],

    'transfer' => [
        'field' => [
            "bill_no" => "交易流水號",
            "api_name" => "接口標識",
            "member_id" => "會員ID",
            "transfer_type" => "轉賬類型",
            "money" => "轉換金額",
            "diff_money" => "差價（紅利）金額",
            "real_money" => "實際轉換金額",
            "before_money" => "轉賬前的金額",
            "after_money" => "轉賬後的金額",
            "money_type" => "金額字段類型",
        ],
    ],

    'fs_level' => [
        'field' => [
            "game_type" => "遊戲類型",
            "member_id" => "會員ID",
            "level" => "反水等級",
            "name" => "等級名稱",
            "quota" => "有效投註額度",
            "type" => "類型",
            "rate" => "反水比例",
            "lang" => "語言/幣種"
        ],

        'msg' => [
            'select_member' => '請選擇會員',
            'same_data_not_allowed' => '同一遊戲類型、類型、等級、幣種的數據只能存在一條',
            'fs_level_required' => '請設置等級名稱',
            'fs_level_repeat' => '已存在該等級的反水等級數據，請將其刪除後操作',
        ],
    ],

    'aside_adv' => [
        'field' => [
            'name' => '名稱',
            'group' => '分組名',
            'pic_url' => '廣告圖片',
            'pic_index' => '圖片索引',
            'vertical' => '垂直位置',
            'horizontal' => '水平位置',
            'effect' => '特效',
            'url_id' => '跳轉路由',
            'remark' => '備註信息',
            'lang' => '語言',
            'is_open' => '是否開放',
            'weight' => '排序',
        ],
    ],

    'option' => [
        'member_status' => [
            1 => '啟用',
            -1 => '禁用',
            -2 => '踢下線'
        ],
        'game_type' => [
            1 => '真人',
            2 => '捕魚',
            3 => '電子',
            4 => '彩票',
            5 => '體育',
            6 => '棋牌',
            7 => '其他',
            99 => '系統彩票'
        ],

        'activity_type' => [
            1 => '返水活動',
            2 => '紅利活動',
            3 => '充值活動',
            4 => '展示活動'
        ],

        'activity_is_apply' => [
            1 => '需要申請',
            0 => '無需申請'
        ],

        'activity_apply_type' => [
            0 => '無需申請',
            1 => '聯系客服申請',
            2 => '活動大廳申請',
            3 => '跳轉查看詳情'
        ],

        'activity_apply_field' => [
            'member_name' => '會員用戶名',
            'recharge_money' => '存款金額',
            'game_type' => '遊戲類型',
            'api_game_type' => '遊戲子分類',//(接口 + 遊戲類型),
            'bill_no' => '註單號碼',
        ],

        'activity_apply_status' => [
            0 => '待審核',
            1 => '審核通過',
            2 => '審核不通過',
            3 => '優惠已下發'
        ],

        'is_open' => [
            1 => '開啟',
            0 => '關閉'
        ],

        'is_read' => [
            1 => '已讀',
            0 => '未讀'
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
            'money' => '中心錢包余額',
            'fs_money' => '返水錢包余額',
            'total_money' => '平臺總投註額',
            'score' => '會員積分',
            'ml_money' => '碼量余額',
            'total_credit' => '借唄總額度',
            'used_credit' => '借唄已用額度'
        ],

        'member_money_operate_type' => [
            1 => '管理員操作',
            2 => '系統贈送',
            3 => '遊戲轉入 / 轉出',
            4 => '返水發放',
            5 => '簽到活動領取',
            6 => '充值活動',
            7 => '平臺紅利',
            8 => '搶紅包',
            9 => '充值 / 提現',
            10 => '充值贈送',
            11 => '拒絕提現退還',
            12 => '轉入遊戲失敗退還',
            13 => '活動發放',
            14 => '代理傭金',
            15 => '轉盤抽獎',
            16 => '購買理財產品',
            17 => '理財產品分紅',
            18 => '掉單退還/扣除',
            19 => '理財產品贖回',
            20 => '晉級獎勵',
            21 => '周俸祿',
            22 => '月俸祿',
            23 => '借唄借款',
            24 => '借唄還款',
            25 => '每日禮金',
            26 => '每周禮金',
            27 => '每月禮金',
            28 => '每年禮金',
            29 => '晉升禮金',
        ],

        'levelup_types' => [
            1 => '存款額達標',
            2 => '投註額達標',
            3 => '任一個達標',
            4 => '所有達標',
        ],

        'money_number_type' => [
            1 => '增加',
            -1 => '減少'
        ],

        'card_type' => [
            1 => '儲蓄卡',
        ],

        'agent_assign_types' => [
            1 => '重新創建',
            2 => '沿用舊代理'
        ],

        'feedback_type' => [
            1 => '平臺問題',
            2 => '財務問題',
            3 => '提供建議'
        ],

        'about_type' => [
            1 => "關於我們",
            2 => "存款幫助",
            3 => "取款幫助",
            4 => "常見問題",
            5 => "合作夥伴",
            6 => "聯營協議",
            7 => "聯絡我們",
            8 => "條款規則"
        ],

        'gamerecord_status' => [
            'N' => '已取消',
            'X' => '未結算',
            'COMPLETE' => '已結算',
            'CANCEL' => '已撤銷',
        ],

        'client_type' => [
            0 => '手機電腦都支持',
            1 => 'pc',
            2 => 'phone'
        ],

        'tag_type' => [
            'hot' => '熱門',
            'recommend' => '推薦',
            'new' => '最新',
        ],

        'apply_status' => [
            0 => '待審核',
            1 => '審核通過',
            2 => '審核不通過'
        ],

        'recharge_status' => [
            1 => '待確認',
            2 => '充值成功',
            3 => '充值失敗'
        ],

        'drawing_status' => [
            1 => '待確認',
            2 => '提款成功',
            3 => '提款失敗'
        ],

        'recharge_type' => [
            1 => '支付寶',
            2 => '微信',
            3 => '銀行轉賬',
            4 => '第三方支付',
            5 => 'QQ',
            6 => '快捷-微信',
            7 => '快捷-支付寶'
        ],

        'payment_type' => [
            'online_alipay' => '支付寶支付(在線支付)',
            'online_wechat' => '微信支付(在線支付)',
            'online_union_quick' => '銀聯快捷(在線支付)',
            'online_union_scan' => '銀聯掃碼（在線支付）',
            'company_bankpay' => '銀行卡轉賬(公司入款)',
            'company_alipay' => '支付寶支付(公司入款)',
            'company_wechat' => '微信公支付(公司入款)',
            'online_cgpay' => 'CGPay支付（在線支付）',
            'company_usdt' => 'USDT支付(公司入款)',
            'online_usdt' => 'USDT支付（在線支付）',
        ],

        'transfer_type' => [
            1 => '轉入遊戲',
            2 => '轉出遊戲'
        ],

        // 消息可見性類型
        'message_visible_type' => [
            1 => '所有會員可見',
            2 => '單個會員可見',
            3 => '管理員可見'
        ],

        // 消息發送類型
        'message_send_type' => [
            1 => '管理員發送',
            2 => '會員發送'
        ],

        'message_status' => [
            0 => '待回復',
            1 => '已回復',
            2 => '標記回復'
        ],

        // 簽到類型 負數表示設置，正數表示領獎
        'daily_bonus_type' => [
            -2 => '連續簽到獎勵',
            -1 => '累計簽到獎勵',
            0 => '普通簽到',
            1 => '累計簽到領獎',
            2 => '連續簽到領獎'
        ],

        'daily_bonus_set' => [
            -1 => '累計簽到',
            -2 => '連續簽到'
        ],

        'daily_bonus_state' => [
            0 => '待確認',
            1 => '已確認',
            -1 => '已拒絕'
        ],

        'member_log_type' => [
            1 => '會員登錄',
            2 => '會員登出',
            3 => '會員操作',
            4 => '代理後臺登錄',
            5 => '代理後臺登出',
            6 => '會員轉入接口異常',
            7 => '會員短信註冊驗證'
        ],

        'task_condition_types' => [
            1 => '單筆充值',
            2 => '累計充值',
            3 => '累計提款',
            4 => '累計盈利',
            5 => '累計虧損',
            6 => '累計流水'
        ],

        'task_award_type' => [
            1 => '稱號獎勵',
            2 => '金額獎勵',
            3 => '返點獎勵',
            4 => '信用額度獎勵'
        ],

        'level_award_type' => [
            'level_award' => '等級禮金',
            'week_award' => '周俸祿',
            'month_award' => '月俸祿',
            'name_award' => '稱號獎勵',
            'borrow_award' => '信用額度獎勵'
        ],

        'fs_type' => [
            1 => '系統反水等級',
            2 => '會員反水等級'
        ],

        'member_task_status' => [
            1 => '領取中',
            2 => '已領完'
        ],

        'agent_rate_type' => [
            3 => '代理/會員點位',
            4 => '代理下線的默認點位'
        ],

        'config_money_type' => [
            'money' => '中心錢包',
            'fs_money' => '返水錢包',
        ],

        'arbitrage_conditions' => [
            'ip' => '同IP',
            'psw' => '同密碼',
            'phone' => '同電話號碼',
            'card' => '同銀行戶名'
        ],

        'wheel_awards' => [
            1 => ['desc' => '500送100優惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/2ead44b68b93b0677b2cffe04cdf08d3.png'],
            2 => ['desc' => '28元','type' => 1,'pic' => 'web/images/wheel/zh_cn/34bacd7183d7e2b95845d2c48e27d10c.png'],
            3 => ['desc' => '100送20優惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/bd8dd02713d3ac8705b38f1602de04a4.png'],
            4 => ['desc' => '58元','type' => 1,'pic' => 'web/images/wheel/zh_cn/96b56053b67e5216b8d2c07562344e56.png'],
            5 => ['desc' => '港澳五日遊','type' => 3,'pic' => 'web/images/wheel/zh_cn/295c5965c9ed549937c3cf5942ccb897.png'],
            6 => ['desc' => '88元','type' => 1,'pic' => 'web/images/wheel/zh_cn/11f2d5122249b7d1adb166ceffdb197e.png'],
            7 => ['desc' => '5000送1000優惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/b07eedbdf8cdf5b89b8d004d0b8e3f37.png'],
            8 => ['desc' => '18元','type' => 1,'pic' => 'web/images/wheel/zh_cn/447075995668a5e04b0bf60885be216e.png'],
            9 => ['desc' => 'IPHONE 12 PRO MAX 512GB','type' => 3,'pic' => 'web/images/wheel/zh_cn/957740284f61bba05611061782f8d639.png'],
            10 => ['desc' => '1000送300優惠券','type' => 2,'pic' => 'web/images/wheel/zh_cn/9019cab46b10bc82ab6ba6a94d6beb3c.png'],
            11 => ['desc' => '東南亞7日豪華遊','type' => 3,'pic' => 'web/images/wheel/zh_cn/835cfc99c3e77309c238612972996253.png'],
            12 => ['desc' => '8元','type' => 1,'pic' => 'web/images/wheel/zh_cn/939d617c97f3a372980f3362245b3b5c.png']
        ],

        'wheel_status' => [
            1 => '待發放',
            2 => '已發放',
            3 => '直接發放'
        ],

        'yuebao_settle_type' => [
            0 => '單次結算',
            1 => '循環結算'
        ],

        'yuebao_member_status' => [
            0 => '進行中',
            1 => '已結束'
        ],

        'quick_url_type' => [
            'web' => 'WEB頁面',
            'index' => '單獨頁面',
            'mobile' => '手機頁面'
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
            'hover' => '懸浮'
        ],

        "notice_type" => [
            "voice" => "僅聲音提醒",
            "alert" => "僅彈窗提醒",
            "voice_and_alert" => "聲音提醒和彈窗提醒"
        ],

        "is_online" => [
            1 => '在線',
            0 => '離線'
        ],

        "credit_type" => [
            'borrow' => '借款',
            'lend' => '還款'
        ],

        "credit_status" => [
            1 => '待確認',
            2 => '借款成功',
            3 => '拒絕借款',
            4 => '還款成功'
        ],

        'levelup_type' => [
            7 => '電子升級',
            8 => '真人升級'
        ],

        'notice_group' => [
            'main' => '首頁公告',
            'credit' => '借唄公告',
            'pc' => '電腦彈窗',
            'mobile' => '手機彈窗'
        ],

        'register_setting_field' => [
            'isInviteCodeRequired' => '電腦版是否需要填寫邀請碼',
            'isRealNameRequred' => '電腦版是否需要填寫真實姓名',
            'isPhoneRequired' => '電腦版是否需要填寫手機號碼',
            'isCaptchaRequired' => '電腦版是否需要填寫驗證碼',

            'isInviteCodeRequired_mobile' => '手機版是否需要填寫邀請碼',
            'isRealNameRequred_mobile' => '手機版是否需要填寫真實姓名',
            'isPhoneRequired_mobile' => '手機版是否需要填寫手機號碼',
            'isCaptchaRequired_mobile' => '手機版是否需要填寫驗證碼',
        ],

        'web_nav' => [
            "index" => "首頁",
            "slot" => "電子遊藝",
            "poker" => "棋牌遊戲",
            "casino" => "視訊直播",
            "lottery" => "彩票遊戲",
            "sport" => "體育賽事",
            "fish" => "捕魚遊戲",
            // "e_sport" => "電子競技",
            "activity" => "優惠活動",
            "app" => "手機APP",
            "service" => "在線客服"
        ],

        'member_apis' => '接口余額',
        'recharges' => '充值記錄',
        'drawings' => '提款記錄',
        'transfers' => '轉賬記錄',
        'gamerecords' => '遊戲記錄',
        'memberlogs' => '登錄日誌',
        'modify_money' => '更改余額',
        'arbitrage_query' => '套利查詢',
        'make_offline' => '踢下線',
        'make_offline_msg' => '確定將會員踢下線嗎？',

    ],

    // 接口相關文字
    'api' => [
        'common' => [
            'demo_not_allowed' => '試玩賬號無法進行該操作',
            'member_forbidden' => '該賬號已被禁用',
            'operate_error' => '操作異常',
            'operate_fail' => '操作失敗：',
            'operate_forbidden' => '非法請求',
            'operate_again' => '操作失敗，請重試',
            'operate_success' => '操作成功',
            'member_not_exist' => '會員信息不存在',
            'net_again_err' => '網絡錯誤，請重試',
            'err_code' => '錯誤代碼：',
            'err_msg' => '錯誤信息：',
            'money_desc' => ':money 元',
            'server_error' => '服務器內部錯誤',
            'phone_not_exist' => '手機號碼不存在',
            'phone_existed' => '手機號碼已存在',
        ],

        'index' => [
            'main_advertise_title_1' => '新會員優惠',
            'main_advertise_title_2' => '電子遊戲專屬優惠',
            'main_advertise_title_3' => '真人視訊專屬優惠',

            'main_advertise_sub_title_1' => '更多優惠盡在VIP',
            'main_advertise_sub_title_2' => '電子遊藝專屬存款送25%優惠',
            'main_advertise_sub_title_3' => '會員首筆存款得30％的獎金',

            'hotgame_sub_title_1' => '泰國鬥雞比賽全覆蓋，玩法多元極致享受，為您提供 全網最豐富的鬥雞娛樂遊戲。',
            'hotgame_sub_title_2' => '秉承匠人之心推陳出新，為玩家提供極致的遊戲體驗。觸手可及的千萬累計獎池，等您一觸即發！',
            'hotgame_sub_title_3' => '最真實的賭場環境，最美麗、最專業的荷官，為您呈現奢華百家樂，玩法多樣不重復，為您獻上現場精彩體驗！',
        ],

        'lottery' => [
            'K3' => '快三',
            '11X5' => '十一選五',
            'SSC' => '時時彩',
            'FFC' => '分分彩',
            'PK10' => 'PK10',
            '3D' => '3D',
            'OTHERS' => '其它'
        ],

        'sms' => [
            'code_required' => '請填寫短信驗證碼',
            'code_get_first' => '請先獲取短信驗證碼',
            'code_expired' => '短信驗證碼已過期，請重新獲取；',
            'code_error' => '短信驗證碼填寫錯誤，請重試',
            'operation_repeat' => '兩分鐘內接收過驗證碼，請勿頻繁操作',
        ],

        'apply_agent' => [
            'member_is_agent' => '您已經是代理，不需要申請',
            'has_applied' => '您已經提交過申請，請耐心等待',
            'apply_success' => '申請提交成功',
            'apply_fail' => '申請提交失敗，請重試',
            'status_fail' => '您還未申請過代理',
            'not_agent' => '您還不是代理'
        ],

        'member_bank' => [
            'create_success' => '銀行數據創建成功',
            'create_fail' => '銀行數據創建失敗，請重試',
            'update_success' => '銀行數據更新成功',
            'update_fail' => '銀行數據更新失敗，請重試',
            'delete_success' => '銀行數據刪除成功',
            'delete_fail' => '銀行數據刪除失敗，請重試'
        ],

        'recharge' => [
            'payment_closed' => '該支付通道已關閉，請重新選擇',
            'pay_between' => '轉賬金額範圍是 :min ~ :max 元，請檢查',
            'pay_success' => '提交成功，請支付',
            'payment_change' => '收款信息已經發生改變，請重新提交',
            'pay_normal_success' => "充值申請提交成功，請等待管理員審核",
            'pay_normal_fail' => "充值申請提交失敗，請重試",

            'not_third_pay' => '該支付方式不是第三方支付',
            'param_not_all' => '參數不完整',
            'config_err' => '第三方支付配置錯誤',

            'pay_money_err' => '請輸入交易比例整數倍的金額',
        ],

        'drawing' => [
            'qk_pwd_required' => '請輸入正確的取款密碼',
            'qk_pwd_error' => '取款密碼輸入錯誤，請重試',
            'money_not_enough' => '提款金額大於現有金額，請修改',
            'bank_not_exist' => '銀行卡信息不存在，請檢查',
            'time_not_allow' => '當前時間無法提款',
            'min_money' => '提款金額低於最低提款金額 :min',
            'max_money' => '提款金額高於最高提款金額 :max',
            'times_not_enough' => '今日提款申請次數超限，請明日再來',
            'drawing_success' => '提款申請提交成功，請等待管理員審核',
            'drawing_fail' => '提款申請提交失敗，請重試:',
            'ml_calc_err' => '碼量計算錯誤：'
        ],

        'message' => [
            'send_success' => '站內信發送成功，請等待管理員回復',
            'send_fail' => '站內信發送失敗，請重試',
            'update_success' => '更新站內信狀態為：',
            'update_fail' => '站內信狀態更新失敗',
            'delete_success' => '站內信刪除成功',
            'delete_fail' => '站內信刪除失敗'
        ],

        'modify_pwd' => [
            'password_error' => '原始密碼錯誤，請檢查',
            'password_success' => '密碼修改成功',
            'password_fail' => '密碼修改失敗',

            'qk_pwd_set' => '您已設置過取款密碼，無須再次設置',
            'qk_pwd_success' => '取款密碼設置成功',
            'qk_pwd_fail' => '取款密碼設置失敗',
            'qk_pwd_error' => '原始取款密碼錯誤，請檢查',
            'qk_pwd_set_success' => '取款密碼修改成功',
            'qk_pwd_set_fail' => '取款密碼修改失敗'
        ],

        'redbag' => [
            'not_open' => '該功能已關閉',
            'no_times' => '今日搶紅包次數已達上限，請明日再來',
            'success' => '恭喜您，搶到金額 :money 元的紅包，請在交易記錄中查看到賬清況'
        ],

        'dailybonus' => [
            'not_open' => '簽到功能暫未開放',
            'no_times' => '您今日已經簽到，無須再次簽到',
            'success' => '簽到成功',
            'fail' => '簽到失敗',
            'check_day_not_enough' => '不符合領取要求，請檢查',
            'check_repeat' => '您已領取過該簽到獎勵或在申請中，請勿重復領取或申請',
            'check_success' => '簽到獎勵領取成功',
            'check_admin_check' => '簽到申請提交成功，請等待管理員審核',
            'get_bonus_success' => '會員【 :name 】領取簽到獎勵【 :money 元】',
        ],

        'fs_now' => [
            'get_success' => '實時反水領取成功，請在交易記錄中查看明細',
            'fs_level_err' => '未配置反水等級，請聯系客服',
            'fs_no_data' => '沒有可以領取的返水',
            'fs_not_open' => '該功能暫未開放',
            'fs_repeat' => '該部分反水已經領取，請勿重復操作'
        ],

        'yuebao' => [
            'plan_require' => '請選擇購買方案',
            'amount_regex' => '購買金額必須是10的倍數',
            'plan_not_exist' => '購買方案不存在',
            'plan_sold_out' => '該方案已售完',
            'no_enough_amount' => '購買數量超過上限，請重試',
            'member_no_money' => '賬戶余額不足，請充值',
            'success' => '購買成功',
            'back_success' => '贖回成功，【本金+利息】共【 :money 元】已轉入您的賬戶'
        ],

        'transfer' => [
            'api_not_open' => '未開通',
            'change_hand' => '已切換為【手動轉入遊戲】模式',
            'change_auto' => '已切換為【自動轉入遊戲】模式',

            'field' => [
                'fs_money' => '反水錢包',
                'money' => '中心錢包'
            ]
        ],

        'team' => [
            'not_direct_child' => '該賬號不是您的直屬下級賬號，無法進行操作',
            'member_name_regex' => '用戶名必須以小寫字母開頭並且只能包含小寫字母和數字',
            'not_set_rate' => '請設置所有遊戲類型的返點點位',
        ],

        'register' => [
            'captcha_required' => '請輸入正確的驗證碼',
            'register_fail' => '註冊失敗',
            'register_success' => '註冊成功',
            'invite_code_required' => '請填寫邀請碼信息'
        ],

        'login' => [
            'name_psd_err' => '賬號或密碼錯誤',
            'demo_not_open' => '系統未開啟試玩功能',
        ],

        'activity' => [
            'no_need_apply' => '該活動不需要申請',
            'apply_repeat' => '您今日已經申請過該活動，請勿重復申請',
            'apply_success' => '申請成功，請等待處理結果',
            'apply_fail' => '申請失敗，請重試',
        ],

        'wheel' => [
            'wheel_desc' => '當日在金沙娛樂最低存款 :money 以上，且有效總投註額達到享受禮金最低存款要求的 :times 倍及以上的會員，將獲得幸運轉盤次數，並有機會獲得 :award ，名額不限，趕快參與！'
        ],

        'credit_pay' => [
            'not_open' => '【借唄】尚未開啟',
            'member_not_exist_or_forbidden' => '會員不存在或被禁用',
            'member_info_error' => '會員信息輸入有誤',
            'user_credit_remained' => '查詢到您還有借款未還清，請再還清借款後再借款',
            'borrow_max' => '最多只能借款【 :money 元】',
            'borrow_success' => '申請已提交，提交成功2小時後請到“信用額度查詢”是否借款成功',
            'lend_total' => '請一次還完所有欠款',
            'money_not_enough' => '請保證中心賬戶中有足夠的錢用來還款',
            'lend_success' => '還款成功'
        ],

        'game' => [
            'not_login' => '請先登錄',
            'no_api_code' => '需要api_code參數',
            'api_member_lang_not_equal' => '所進接口貨幣與會員貨幣不一致',
            'demo_game' => '試玩賬號只能進入系統彩接口',
            'api_code_not_exist' => '接口不存在，請檢查',
            'api_code_not_open' => '接口未開放，請選擇其它遊戲',
            'operate_fail' => '操作失敗，:msg 請聯系客服',
            'member_api_create_err' => '本地創建會員API賬號失敗',
            'api_money_not_enough' => '接口余額不足，請聯系客服',
            'member_money_not_enough' => '賬戶余額不足，無法轉入接口 :money 元',
            'api_money_transfer_fail' => '扣除賬戶金額失敗，',
            'api_money_transfer_add_fail' => '轉入遊戲後增加接口金額操作異常，',
            'api_money_transfer_back_fail' => '【 :title】遊戲接口退還賬戶金額操作異常，',
            'api_money_transfer_err' => '轉入【 :title】接口失敗，錯誤信息:',
            'api_money_transfer_success' => '轉入【 :title】接口成功',

            'transfer_out_error' => '【 :money】接口余額不足，轉出遊戲失敗',
            'transfer_out_api_error' => '轉出遊戲【:title】接口額度失敗，錯誤信息：',
            'transfer_out_add_error' => '轉出【:title】接口後扣除接口金額，增加用戶賬戶金額操作異常：',
            'transfer_out_success' => '轉出【:title】遊戲成功',
            'api_parameter_err' => '系統參數有誤',
            'lottery_error' => '系統彩地址錯誤，未開通本地彩票功能，請聯系開戶人員',
            'lottery_api_not_exist' => '系統彩地址錯誤，未開通本地彩票功能，請聯系開戶人員',
        ],

        'agent_fd_rates' => [
            'lower_than_system' => '遊戲類型【 :game_type】的反水點位不能低於系統設置的最低點位【 :rate】',
            'higher_than_system' => '遊戲類型【 :game_type】的反水點位不能高於系統設置的最高點位【 :rate】',
            'rate_not_set' => '您遊戲類型【 :game_type】的反水點位尚未設置，請聯系您的上級代理或者管理員',
            'child_rate_err' => '下級遊戲類型【 :game_type】的反水點位不能高於自身的點位【 :rate】',
            'top_rate_err' => '遊戲類型【 :game_type】的反水點位不能低於該代理的下級的最高點位【 :rate】',
            'agent_rate_err' => '遊戲類型【 :game_type】的反水點位不能高於自身的點位【 :rate】',
        ],

        'invite_rate' => [
            'self_rate_err' => '邀請註冊鏈接【 :game_type】類型的返點不能高於您自身的返點',
            'lower_than_system' => '邀請註冊鏈接【 :game_type】類型的返點不能低於系統設置的最低點位【 :rate】'
        ],

        'captcha' => [
            'check_err' => '驗證碼錯誤',
            'out_of_date' => '驗證碼已過期，請刷新重試',
        ],

        'task' => [
            'no_task' => '沒有需要完成的任務',
            'task_complete_title' => '任務完成通知',
            'task_complete_desc' => '恭喜您完成任務【 :title】，任務獎勵：',
            'level_up_desc_start' => '發放會員【 :name】從【:old_level 級】到【:level 級】的晉級獎勵，獎勵內容包括：“',
            'level_up_award' => '晉級獎勵',
            'level_up_title' => '晉級獎勵發放通知',
            'level_up_desc' => '恭喜您領取【 :old_level 級 ~ :level 級】晉級獎勵。',
            'week_award_title' => '周俸祿發放通知',
            'week_award_desc' => '恭喜您領取【 :level 級】周俸祿【 :money 元】',
            'month_award_title' => '月俸祿發放通知',
            'month_award_desc' => '恭喜您領取【 :level 級】月俸祿【 :money 元】'
        ],

        'level_config' => [
            'level_up_award_title' => '晉級禮金發放通知',
            'level_up_award_desc' => '恭喜您升級到【 :level_name】，升級獎勵為金額【:money 元】，信用額度獎勵【:credit 元】',
            'level_up_award_msg' => '會員【 :name】領取【 :level】級晉級禮金【 :money 元】，信用額度獎勵【:credit 元】',

            'day_bonus_award_title' => '每日禮金發放通知',
            'day_bonus_award_desc' => '恭喜您領取【 :level 級】每日禮金【 :money 元】',
            'day_bonus_award_msg' => '會員領取【 :level級】每日禮金，發放獎勵【 :money 元】',

            'week_bonus_award_title' => '每周禮金發放通知',
            'week_bonus_award_desc' => '恭喜您領取【 :level 級】每周禮金【 :money 元】',
            'week_bonus_award_msg' => '會員領取【 :level級】每周禮金，發放獎勵【 :money 元】',

            'month_bonus_award_title' => '每月禮金發放通知',
            'month_bonus_award_desc' => '恭喜您領取【 :level 級】每月禮金【 :money 元】',
            'month_bonus_award_msg' => '會員領取【 :level級】每月禮金，發放獎勵【 :money 元】',

            'year_bonus_award_title' => '每年禮金發放通知',
            'year_bonus_award_desc' => '恭喜您領取【 :level 級】每年禮金【 :money 元】',
            'year_bonus_award_msg' => '會員領取【 :level級】每年禮金，發放獎勵【 :money 元】',
        ]
    ],

    'configs' => [
        "is_redbag_open" => "是否開啟紅包",
        "redbag_min_money" => "紅包最小金額",
        "redbag_max_money" => "紅包最大金額",
        "redbag_day_times" => "每日搶紅包次數",
        "is_daily_bonus_open" => "是否開啟簽到",
        "is_daily_bonus_auto" => "簽到是否自動領獎",
        "activity_money_type" => "活動獎勵發放錢包類型",
        "member_fs_money_type" => "會員反水發放錢包",
        "is_realtime_fs_mode" => "是否開啟時時反水模式",
        "activity_yuebao_plan_enable" => "是否開放余額寶方案購買",
        "activity_yuebao_enable" => "是否開放余額寶",
        "activity_wheel_is_open" => "是否開啟幸運大轉盤活動",
        "is_system_maintenance" => "是否開啟系統維護",
        "system_maintenance_whitelist" => "系統維護IP白名單",
        "site_domain" => "活動站域名",
        "wap_qrcode" => "手機APP下載二維碼",
        "wap_app_link" => "手機APP下載地址",
        "service_link" => "客服鏈接",
        "kefu_wechat_qrcode" => "微信客服二維碼",
        "site_logo" => "網站Logo",
        "site_logo2" => "網站備用LOGO",
        "kefu_qq" => "客服QQ",
        "site_email" => "網站郵箱",
        "site_slogan" => "網站副logo",
        "site_pc" => "電腦端地址",
        "site_mobile" => "手機端網址",
        "is_scroll_adv_open" => "是否開啟滾動廣告",
        "is_demo_play_open" => "是否開啟試玩功能",
        "is_open_register" => "是否開放註冊頁面",
        "activity_jiebei_enable" => "是否開啟借唄",
        "transfer_start" => "提款開始時間",
        "transfer_end" => "提款截止時間",
        "min_transfer" => "最低提款金額",
        "max_transfer" => "最高提款金額",
        "ml_percent" => "碼量百分比",
        "ml_drawing_percent" => "碼量有剩余時提款手續費百分比",
        "daili_active_money" => "活躍會員充值金額標準",
        "agent_fd_mode" => "是否啟用無限代理模式",
        "is_auto_agent" => "會員註冊默認是代理",
        "notice_type" => "提醒模式",
        "yuebao_audio" => "余額寶購買聲音提醒",
        "activity_audio" => "活動申請聲音提醒",
        "message_audio" => "站內信聲音提醒",
        "member_audio" => "玩家登錄聲音提醒",
        "drawing_audio" => "提款聲音提醒",
        "rechargel_audio" => "充值聲音提醒",
        "agent_apply_audio" => "代理申請未處理",
        "credit_apply_audio" => "借唄申請未處理",
        "credit_overdue_audio" => "借唄逾期提醒",
        "system_maintenance_message" => "網站維護提示信息",
        "bank_desc" => "公司簡介",
        "site_title" => "網站標題",
        "site_keyword" => "網站關鍵字",
        "site_name" => "網站名稱",
        "online_pay_title" => "在線支付標題",
        "online_pay_desc" => "在線支付介紹",
        "company_pay_title" => "公司入款標題",
        "company_pay_desc" => "公司入款介紹",
        "register_remark" => "註冊說明",
        "register_agreement" => "註冊協議",
        "nav_jiechi" => "劫持教程",
        "guideline_desc" => "簡易線路描述",
        "hotgame_desc" => "熱門遊戲描述",
        "wheel_rule" => "幸運大轉盤活動條款與規則",
        "credit_detail" => "借唄活動詳情",
        "credit_rule" => "借唄信用規則",
        "credit_xize" => "借唄活動細則",
        "credit_borrow" => "借唄借款說明",
        "credit_lend" => "借唄還款說明",
        "levelup_slot_activity" => "電子升級活動詳情",
        "levelup_slot_example" => "電子升級活動舉例",
        "levelup_slot_level" => "電子升級升級說明",
        "levelup_slot_month" => "電子升級月俸祿說明",
        "levelup_live_activity" => "真人升級活動詳情",
        "levelup_live_example" => "真人升級活動舉例",
        "levelup_live_level" => "真人升級升級說明",
        "levelup_live_month" => "真人升級月俸祿說明",
        "app_tuiguang" => "推廣教程",
        "app_xima" => "洗碼教程",
        "app_fanyong" => "返傭比例",
        "app_xima_text" => "洗碼說明",
        "activity_shengji_enable" => "是否開啟升級活動",
        "vip1_is_register_sms_open" => "是否開啟註冊短信驗證",
        "service_link" => "客服鏈接",
        "service_line" => "Line",
        "service_line_pic" => "Line二維碼",
        "service_phone" => "電話",
        "service_phone2" => "電話2",
        "is_backend_google_auth" => "後臺登錄是否開啟谷歌驗證碼",
        "service_skype" => "Skype",
        "service_telegram" => "Telegram",
        "service_logo_link" => "LOGO跳轉鏈接",
        "vip1_is_login_captcha_open" => "是否開啟會員登錄驗證碼",

        "vip1_lang_default" => "前端默認語種",
        "vip1_lang_fields" => "前端開啟語種"
    ],

    'agent_page' => [
        'login' => [
            'username' => '用戶名',
            'password' => '密碼',
            'captcha' => '驗證碼',
            'refresh' => '點擊刷新',
            'login' => '立即登錄',
        ],

        'basic' => [
            'main_title' => '代理管理後臺',
        ],

        'title' => [
            'main' => '後臺首頁',
            'offline' => '下線會員',
            'offline_list' => '下線列表',
            'promote_site' => '推廣網址',
            'agent_report' => '代理報表',
            'recharge_list' => '會員存款記錄',
            'drawing_list' => '會員提款記錄',
            'money_log' => '下線余額變動記錄',
            'fd_logs' => '下線返點記錄',
            'game_records' => '會員輸贏報表'
        ],

        'notice' => [
            'traditional_only' => '只有【傳統代理模式】才能訪問該頁面，目前是【全民代理】模式',
            'allagent_only' => '只有【全民代理】才能訪問該頁面，目前是【傳統代理模式】模式',
            'rate_not_exist' => '會員返點信息不存在',
            'direct_rate_modify' => '只能修改直屬下級的點位'
        ],

        'desc' => [
            'offline_num' => '下線會員人數',
            'agent_default_rate' => '下線代理默認返點',
        ],

        'field' => [
            'is_agent' => '是否代理',
            'register_at' => '註冊時間',
            'own_rate' => '自身返點',
            'unset' => '未設置',
            'offline_default_rate' => '下線默認點位',
            'pc_agent_url' => 'PC推廣網址',
            'wap_agent_url' => 'WAP推廣網址',
            'qrcode_title' => '推廣二維碼',
            'time_range' => '起止時間',

            'total_deposit' => '存款總額',
            'recharge_count' => '存款筆數',
            'total_drawing' => '提款總額',
            'drawing_count' => '提款筆數',
            'dividend_hongli' => '紅利金額',
            'dividend_activity' => '活動贈送',
            'dividend_fs' => '反水',
            'dividend_other' => '其它',
            'total_profit' => '總盈利',
            'member_win_and_loss' => '會員輸贏',

            'add_sub' => '增加/減少',
            'fs_center' => '反水/中心錢包',

            'api_name' => 'API接口'
        ],

        'btn' => [
            'set_offline_default' => '設置下級默認返點',
            'qrcode' => '查看二維碼'
        ]
    ]
];
