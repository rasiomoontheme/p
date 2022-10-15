<?php

return [
    'common' => [
        'operate' => 'operation',
        'select_default' => '--Please select--',
        'page_notice' => '<strong>Pay attention to：</strong> To refresh this page, click the refresh button on the right',
        'title' => 'Background Management System',
        "lang" => "Language",

        'created_at' => 'Create time',
        'updated_at' => 'Update time',
        'total' => 'Total',
        'count' => '',
        'sum' => 'Sum',
        'upload_image' => 'Upload Image',
        'quick_operate' => 'Quick operation',

        'member_id' => 'Member account',
        'member_name' => 'Member account',
        'user_id' => 'Administrator account',
        'api_id' => 'Api account',
        'agent_id' => 'Agent account',
        'top_id' => 'Top agent account',
        'game_type' => 'Game Type',
        'deleted' => 'Deleted',

        'login_notice' => 'Login to remind',
        'inner' => 'inner',

        'recharge_list' => 'Recharge list',
        'drawing_list' => 'Drawing list',
        'user_info' => 'Personal information',
        'modify_pwd' => 'Change the password',
        'lang_title' => 'The system language/语言',
        'fix_url' => 'Fix image address',
        'fix_url_notice' => 'Are you sure to fix the picture? Please fill in the address of [system configuration - Website master domain] before the repair, and fill in the "APP_URL" field of the. Env file in the root directory of the website after the repair; The whole process takes a long time, please wait patiently',
        'logout' => 'Log out',
        'logout_title' => 'Are you sure you want to exit the system',
        'user_google' => 'Binding Google Verification',
        'color_header' => 'The head',
        'color_sidebar' => 'The sidebar',
        'no_limit' => "No Limit",
        'lang_notice' => 'Because the system line involves multilingual / currency, you need to select language / currency to query data'
    ],

    'base' => [
        'add_success' => 'Successful new data',
        'add_fail' => 'New data failed',
        'update_success' => 'Update data successfully',
        'update_fail' => 'Update data failed',
        'delete_success' => 'Delete successfully',
        'delete_fail' => 'Delete failed',
        'save_success' => 'Save success',
        'save_fail' => 'Save failed',
        'operate_success' => 'Successful operation',
        'operate_fail' => 'Operation failed, please try again',
        'operate_msg' => 'Operation failure：',
        'batch_add_success' => 'Batch Add success',
        'batch_add_fail' => 'Batch Add Failed',

        'account_forbidden' => 'This account is disabled',
        'login_success' => 'Login success',
        'illegal_operation' => 'Illegal operations',
        'item_select_required' => 'Select the columns that need to be manipulated',
    ],

    'upload' => [
        'file_type_error' => 'Unable to identify file type',
        'file_size_error' => 'Upload upload file is too large to upload',
        'image_file_required' => 'Please select the image you need to upload',
        'image_ext_required' => 'Please upload files in picture format',
        'file_required' => 'Please select the file to upload',
        'file_ext_error' => 'Please upload files in the specified format',
        'image_size_get_error' => 'Error getting the file size',
        'file_delete_error' => 'File deletion failed',
        'file_upload_success' => 'File upload success'
    ],

    'notice' => [
        'recharge_title' => 'Prepaid phone list',
        'recharge_notice' => '<p>Do you have <span id="rechargeNum" data-name="rechargel_audio" data-sec="0" >0</span> The remittance request has not been processed</p>',
        'drawing_title' => 'Draw a list',
        'drawing_notice' => '<p>Do you have <span id="drawingNum" data-name="drawing_audio" data-sec="2">0</span> Note withdrawal request not processed</p>',
        'message_title' => 'List of internal letters',
        'message_notice' => '<p>Do you have <span id="messageNum" data-name="message_audio" data-sec="4">0</span> This message has not been processed</p>',
        'memberagentapplies_title' => 'Member agent application list',
        'memberagentapplies_notice' => '<p>Do you have <span id="agentAppliesNum" data-sec="6" data-name="agent_apply_audio">0</span> The agent application has not been processed</p>',
        'members_title' => 'The member list',
        'members_notice' => '<p>Do you have <span id="memberNum" data-name="member_audio">0</span> A special member login reminder</p>',
        'activityapplies_title' => 'Application for Membership Activities',
        'activityapplies_notice' => '<p>Do you have <span id="activityNum" data-name="activity_audio">0</span> Application for membership activities</p>',
        'memberyuebaoplans_title' => 'List of purchasing records of Member Yu ebao',
        'memberyuebaoplans_notice' => '<p>Do you have <span id="yuebaoNum" data-name="yuebao_audio">0</span> Write yu ebao purchase reminder</p>',
        'creditpayrecord_title' => 'Borrow the list',
        'creditpayrecord_notice' => '<p>Do you have <span id="creditAppliesNum" data-name="credit_apply_audio">0</span> Ask for a reminder</p>',
        'creditpayrecord_overdue_title' => 'Borrow the list',
        'creditpayrecord_overdue_notice' => '<p>Do you have <span id="creditOverdueNum" data-name="credit_overdue_audio">0</span> Borrow overdue reminder</p>'
    ],

    'btn' => [
        'add' => 'new',
        'batch_delete' => 'Batch delete',
        'batch_add' => 'Batch Add',
        'search' => 'search',
        'reset' => 'reset',
        'edit' => 'The editor',
        'detail' => 'details',
        'delete' => 'delete',
        'refresh' => 'refresh',
        'collapse' => 'folding',
        'back' => 'return',
        'save' => 'Save the content',
        'export' => 'Export',

        'title' => 'Title',
        'content' => 'Content'
    ],

    'index' => [
        'title' => 'Home page',
        'today_register' => 'Registered Number Today',
        'today_free' => 'Marketing cost today',
        'today_bet' => 'Player bets today',
        'today_game_profit' => 'Total game revenue today',
        'month_register' => 'Monthly registrations',
        'month_free' => 'Marketing cost of this month',
        'month_bet' => 'Player bets this month',
        'month_game_profit' => 'Total game revenue this month',
        '10_days_recharge' => 'Recharge record of the last 10 days',
        '10_days_drawing' => 'Withdrawal record of the last 10 days',
        'welcome' => 'Youre welcome，',
        'recharge_title' => 'Top-up amount',
        'drawing_title' => 'On withdrawals',

        'site_domain_required' => 'Make sure to fill in the pre-replacement URL in the System Configuration - Website Domain Name',
        'app_url_required' => 'please make sure in the website root directory ". The APP_URL fields of the env" file are filled with the replaced URL',
        'url_same_error' => 'The URL is consistent with the replacement, please check',
    ],

    'member' => [
        'field' => [
            "name" => "The user name",
            "password" => "password",
            "original_password" => "API password",
            "o_password" => "The original password",
            "nickname" => "nickname",
            "realname" => "Real name",
            "email" => "E-mail",
            "phone" => "Mobile phone number",
            "qq" => "QQ number",
            "gender" => "gender",
            "invite_code" => "Invite code",
            "qk_pwd" => "Withdrawal code",
            "money" => "Balance of central account",
            "fs_money" => "Rebate account balance",
            "total_money" => "Total betting amount of the platform",
            "ml_money" => "Code quantity balance",
            "score" => "integral",
            "total_credit" => "Borrow the total amount",
            "used_credit" => "Borrowing money has been spent",
            "register_ip" => "Registered IP",
            "register_area" => "Registration area",
            "register_site" => "Registered channels",
            "status" => "state",
            "is_tips_on" => "Whether to turn on login prompts",
            "is_in_on" => "Internal account or not",
            "top_id" => "Superior agent ID",
            "agent_id" => "The agent id",
            "level" => "VIP level",
            "is_demo" => "Whether to try out the account",

            "is_online" => "Whether online",
            "lang" => "语言/币种"
        ],

        'index' => [
            'title' => 'The member list',
            'register_setting' => 'Register Setting',
            'is_agent_and_top_agent' => 'Whether the agent/superior agent',
            'last_ip' => 'Last login IP',
            'title_modify_money' => 'Change of Member Balance',
            'title_assign_agent' => 'Set to the agent',
            'title_assign_member_agent' => 'Set the account [:name] as the agent',
            'title_modify_top' => 'Distribution agent',
            'title_modify_member_top' => 'The superior agent to assign account [:name]'
        ],
        'edit' => [
            'title_edit' => 'Members to modify',
            'title_create' => 'New members',
            'is_tips_on_notice' => 'After being turned on, there will be a background prompt every time the player logs in',
            'is_in_on_notice' => 'After opening, the member won or lost no record statistics'
        ],

        'member_apis' => [
            'title' => 'Membership interface limit',
            'api_title' => 'The name of the interface',
            'money' => 'lines',
            'null' => 'Did not open',
            'refresh' => 'Refresh interface balance',
            'recycle' => 'recycling',
        ],

        'modify_money' => [
            'title' => 'Modification of membership limit',
            'is_add_ml' => 'Also increases the code size',
            'is_add_ml_notice' => 'Increase proportion Reference [System configuration] - [Agent related] - [Withdrawal percentage]',
        ],

        'modify_top' => [
            'notice' => '<strong>Pay attention to：</strong> This account has not set the return point before, and the return point will be automatically assigned according to the assigned superior account'
        ],

        'money_report' => [
            'title' => 'The financial statements',
            'notice' => '<strong>Pay attention to：</strong> Positive number is platform profit, negative number is platform loss',
            'created_at' => 'Time range',
            'is_agent_and_top_agent' => 'Agent/Superior',
            'recharge_count' => 'Account number',
            'drawing_count' => 'Number of withdrawals',
            'recharge_sum' => 'Total amount of deposit',
            'drawing_sum' => 'Total amount of withdrawal',
            'total_fs' => 'Total return water',
            'total_dividend' => 'The total dividend',
            'total_other' => 'Total other',
            'total_profit' => 'The total amount of profit and loss',

            'profit_formula_notice' => 'Calculation formula and description of profit and loss',
            'profit_formula' => 'Deposit - withdrawal - return of water - dividend - other = actual profit and loss',
            'yinli' => 'profit：',
            'kuisun' => 'loss：'
        ],

        'msg' => [
            'money_negative_error' => 'The revised amount is negative, please check',
            'password_at_least_6' => 'Password length at least six digits',
            'balance_error' => 'Balance query failed, error message:',
            'offline_success' => 'Membership【 :name 】Kick Off',
            'member_offlined' => 'Membership【 :name 】Currently offline',
        ]
    ],

    'agent' => [
        'field' => [
            "member_id" => "MembershipID",
            "agent_pc_uri" => "Agent PC link",
            "agent_wap_uri" => "Agent WAP link",
            "agent_real_pc_url" => "Agent PC link",
            "agent_real_wap_url" => "Agent WAP link",
            "agent_uri_pre" => "Agent link prefix",
            "apply_data" => "Application Information",
            "remark" => "Remarks",
        ],

        'assign' => [
            'notice' => 'If the member s previous agent number has been deleted, choose to recreate the agent or follow the old agent account'
        ],

        'index' => [
            'top_notice' => '<strong>Attention：</strong> New Agent Please set up a member as an agent in the Membership List',
            'btn_fd_rate' => 'Counterpoint location',
            'title_fd_rate' => 'Agency :name Counterpoint location',
            'btn_fd_record' => 'Counterpoint record',
            'title_fd_record' => 'Agency :name Counterpoint record',
        ],

        'msg' => [
            'assign_type_required' => 'Please select the distribution pattern',
            'assign_operate_error' => 'Assignment agent failure：',
            'assign_operate_success' => 'Assigned Agent Success',
        ]
    ],

    'user' => [
        'field' => [
            "name" => "User name",
            "password" => "Password",
            "status" => 'State',
            "create_ip" => "Create IP",
            "google_secret" => "Google Verification",
            "is_google_secret" => "Is it bound to Google CAP",
        ],

        'status' => [
            1 => 'Normal',
            -1 => 'Prohibition'
        ],

        'index' => [
            'btn_assgin' => 'Assigning roles'
        ],

        'modify_pwd' => [
            'oldpassword' => 'Original password',
            'password' => 'New password',
            'password_confirmation' => 'Confirm new password',
        ],

        'assign' => [
            'role' => 'Role'
        ],

        'msg' => [
            'oldpassword_error' => 'Original password error, please check',
            'modify_success_login' => "Password changed successfully, please re-login",
            'modify_error' => 'Password modification failed',
            'assign_success' => 'Role assignment success',
            'assign_fail' => 'Role assignment failure',
        ],

        'login' => [
            'google_auth_error' => 'Google verification code filling in error',
        ],

        'google' => [
            'first_notice' => 'For the first binding, use the Google Verifier APP scan the QR code directly, enter the Google verification code on the phone, and then submit the binding;',
            'reset_notice' => 'You have already bound Google CAPTC, if you need to rebind, please contact the administrator',
            'scan_qrcode' => 'Scan code binding',
            'secret_notice' => 'After scanning the code, enter the Google verification code on your phone',
            'submit' => 'Submit bindings',
            'reset_own_error' => 'Unable to reset your own account, please contact the master administrator',
            'reset_btn' => 'Reset Google Verification',
            'reset_message' => 'Are you sure you want to reset the Google CACTCHA for the account? ',
        ]
    ],

    'role' => [
        'field' => [
            'name' => 'User name',
            'description' => 'Description',
        ],

        'index' => [
            'btn_assign' => 'Assign permissions',
        ],

        'assign' => [
            'permission' => 'Permissions',
            'check_all' => 'Full selection'
        ],

        'msg' => [
            'assign_success' => 'Permission granted successfully',
            'assign_fail' => 'Permission allocation failed',
        ]
    ],

    'permission' => [
        'field' => [
            'name' => 'Permission Name',
            'icon' => 'icon',
            'pid' => 'Father ID',
            'route_name' => 'Route name',
            'weight' => 'Weight',
            'description' => 'Description',
            'remark' => 'Remarks',
            'is_show' => 'Display'
        ],

        'is_show' => [
            0 => 'No display',
            1 => 'Display'
        ],

        'index' => [
            'btn_child' => 'Create child permissions',
        ],

        'msg' => [
            'lang_json_error' => 'Multiple Language Permission Name Error'
        ]
    ],

    'black_ip' => [
        'field' => [
            "ip" => "IP address",
            "is_open" => "Open",
            "remark" => "Remarks Information",
        ]
    ],

    'apis' => [
        'field' => [
            "api_id" => "API ID",
            "api_name" => "Platform identity",
            "api_title" => "Platform Description Name",
            "api_money" => "Interface balance",
            "prefix" => "Account prefix",
            "is_open" => "Open",
            "lang" => "Currency",
            "lang_list" => "Language list",
            "weight" => "Weight",
            "remark" => "Remarks",
            'icon_url' => 'Electronic sidebar icon',
            'logo_url' => 'pc drop down display logo'
        ],

        'index' => [
            'top_title' => 'API Interface Infrastructure',
            'api_domain' => 'Basic domain name',
            'api_prefix' => 'prefix',
            'btn_refresh' => 'Refresh interface balances',
            'config_title' => 'Admin Basic Config',
        ],

        'msg' => [
            'no_need_update_game' => 'No need to update games',
            'update_game_success' => 'Successful update【 :update_count 】Game data, successfully added【 :create_count】Game data',
        ]
    ],

    'api_game' => [
        'field' => [
            "title" => "Game Title",
            "subtitle" => "Subtitle",
            "web_pic" => "Computer Images",
            "mobile_pic" => "Picture of mobile phone",
            "api_name" => "Interface identification",
            "class_name" => "Style identity",
            "game_type" => "Game type",
            "params" => "Parameters",
            "client_type" => "Running platform",
            "is_open" => "Open",
            "weight" => "Weight",
            "tags" => "Label",
            "lang" => "Language",
            "remark" => "Remarks",
        ],

        'index' => [
            'top_notice' => 'The game displays text for such modifications',
            'btn_update' => 'Game update',
            'web_pic_notice' => '【Electronic】The classified picture corresponds to the game list Logo'
        ],

        'mobile_category' => [
            'top_notice' => '<strong>Attention：</strong> You need to save be saved to take effect',
            'web_title' => 'Computer Home Navigation Order',
            'key' => 'Identification',
            'name' => 'Name of name',
            'weight' => 'Weight',
        ]
    ],

    'game_list' => [
        'field' => [
            "api_name" => "Interface identification",
            "name" => "Chinese Name of Game",
            "en_name" => "English Name",
            "game_type" => "Game type",
            "game_code" => "Game ID",
            "tcg_game_type" => "TCG game type",
            "param_remark" => "Additional parameters",
            "img_path" => "Picture path",
            "img_url" => "Photo address",
            "client_type" => "Running platform",
            "platform" => "Support environment",
            "is_open" => "Open",
            "weight" => "Weight",
            "tags" => "Label",
        ]
    ],

    'game_hot' => [
        'field' => [
            "name" => "Hall name",
            "api_name" => 'Interface name',
            "desc" => "Hall description",
            "en_name" => "Hall name[english]",
            "en_desc" => "Hall description[english]",
            "tw_name" => "Hall name[Fanzhong]",
            "tw_desc" => "Hall description[Fanzhong]",
            "th_name" => "Hall name[Thai]",
            "th_desc" => "Hall description[Thai]",
            "vi_name" => "Hall name[Vietnamese]",
            "vi_desc" => "Hall description[Vietnamese]",
            "icon_path" => "Before selection icon",
            "icon_path2" => "After selection icon",
            "img_url" => "Picture address",
            "game_code" => "Game parameters",
            "is_online" => "Online or not",
            "sort" => "sort",
            "lang" => "Language",
            'game_type' =>'Game type',
            'type' =>'Location type',
            'jump_link' =>'Jump link',
            'jump_link_p' => 'If you enter the game directly, you don t need to fill in',
            'icon_path2_p' => 'If you select the location of the home game category, you do not need to upload',
            'is_new_window' => 'Whether to open in a new window'
        ],
        'hot_game_place_type' => [
            1 => 'Popular games',
            2 => 'Home game classification'
        ],
    ],

    'admin_log' => [
        'field' => [
            'user_id' => 'Administrator ID',
            'user_name' => 'Administrator User Name',
            'url' => 'Operating address',
            'data' => 'Operational data',
            'ip' => 'IP of operations',
            'address' => 'IP real address',
            'ua' => 'Operating environment',
            'type' => 'Type of operation',
            'type_text' => 'Description of operation type',
            'description' => 'Operational description',
            'remark' => 'Operational remarks',
        ],

        'title' => [
            'login_title' => 'Administrator login log logs',
            'logout_title' => 'Administrator logs',
            'operate_title' => 'Administrator action log',
            'system_title' => 'System exception log'
        ],

        'type' => [
            '1' => 'Background login',
            '2' => 'Backstage',
            '3' => 'Background operation',
            '4' => 'System anomalies'
        ]
    ],

    'member_log' => [
        'field' => [
            "member_id" => "MembershipID",
            "ip" => "IP of operations",
            "address" => "IP real address",
            "ua" => "Operating environment",
            "type" => "Type of operation",
            "description" => "Operational description",
            "remark" => "Remarks",
        ]
    ],

    'member_agent_apply' => [
        'field' => [
            "member_id" => "Membership ID",
            "name" => "True Name",
            "phone" => "Telephone number",
            "email" => "E-mail",
            "msn_qq" => "Contact informationMSN/QQ",
            "reason" => "Reasons for application",
            "status" => "Status of application",
            "fail_reason" => "Reasons for failure",
            "assign_type" => "Distribution pattern"
        ],

        'index' => [
            'btn_deal' => 'Processing'
        ],

        'msg' => [
            'saved_cannot_modify' => 'Applications reviewed are not allowed to change',
            'update_and_fill_data' => 'Update data successfully, please fill in proxy parameters',
        ],
    ],

    'agent_fd_rate' => [
        'field' => [
            "parent_id" => "Parent Agent ID",
            "member_id" => "Current membership ID",
            "game_type" => "Game type",
            "type" => "Location type",
            "rate" => "Rate of return(%)",
            "remark" => "Remarks",
        ],

        'agent' => [
            'top_notice' => '<strong>Attention：</strong> The agent has not set the counterpoint bit',
            'operate_total' => 'Unified setting of points',
            'btn_apply' => 'Applications',
            'title' => 'Set Agent【 :name 】Counterpoint location',
            'system_highest' => 'The highest point of the system',
            'system_lowest' => 'System minimum points',
            'system_default' => 'System default points',
            'quick_notice' => 'Please enter the value of the unified set point'
        ],

        'system' => [
            'highest_title' => 'Agent default maximum return',
            'lowest_title' => 'Agent default minimum return',
            'default_title' => 'System creates proxy default return',
        ],

        'msg' => [
            'system_highest_error' => 'System game type【 :game_type 】The highest backwater point of this type is lower than the lowest backwater point of this type. Please check',
            'system_lowest_error' => 'System game type【 :game_type The lowest backwater point is higher than the highest backwater point of this type. Please check',
        ],
    ],

    'agent_fd_money_log' => [
        'field' => [
            "member_id" => "Player MembersID",
            "member_rate" => "Proportion of players returning(%)",
            "agent_member_id" => "AgencyID",
            "agent_member_rate" => "Proportion of agency returns(%)",
            "child_member_id" => "Lower MemberID",
            "child_member_rate" => "Proportion of lower-level members returning(%)",
            "game_type" => "Game type",
            "bet_amount" => "Bet amount",
            "fd_money" => "Amount returned",
            "money_before" => "Pre-log balance",
            "money_after" => "Post-log balance",
            "remark" => "Remarks",
        ]
    ],

    'daily_bonus' => [
        'field' => [
            "member_id" => "Membership id",
            "bonus_money" => "Check-in Award",
            "days" => "Check-in settings days",
            "serial_days" => "Number of consecutive check-in days",
            "total_days" => "Cumulative check-in days",
            "type" => "Type",
            "state" => "State",
            "remark" => "Remarks",
            "lang" => "Language / currency"
        ],

        'record' => [
            'btn_confirm' => 'Audit approved',
            'notice_confirm' => 'Are you sure to apply for a check-in award through a member?',
            'btn_reject' => 'Audit not approved',
            'notice_reject' => 'Are you sure to reject the member s sign-in award application?',
        ],

        'setting' => [
            'deposit' => 'Amount of deposit on day',
            'valid_num' => 'Effective water (multiples)',
            'times' => 'Number of Drawings',
            'is_open' => 'Enabled'
        ],

        'msg' => [
            'same_day_error' => 'Check-in rewards have been set for the same number of check-in days, please check'
        ]
    ],

    'game_record' => [
        'field' => [
            "billNo" => "Note line number",
            "api_name" => "Interface identification",
            "name" => "Player Account",
            "gameType" => "Game type",
            "status" => "Settlement status",
            "betTime" => "Time to bet",
            "betAmount" => "Bet amount",
            "validBetAmount" => "Effective bet amount",
            "netAmount" => "Lottery Amount",
            "roundNo" => "Number of events",
            "playDetail" => "Play details",
            "wagerDetail" => "Bet details",
            "gameResult" => "Lottery results",
            "is_fd" => "Do you want to return",

            "shuyinAmount" => "Win/ lose"
        ],

        'index' => [
            'btn_send_fd' => 'Issuance of return points',
            'notice_send_fd' => 'Are you sure to issue the reverse water of the game record?',

        ]
    ],

    'member_wheel' => [
        'field' => [
            "member_id" => "id of Members",
            "user_id" => "Administrator ID",
            "award_id" => "ID prizes",
            "award_desc" => "Prize description",
            "status" => "Collection status",
        ],

        'index' => [
            'btn_send' => 'Confirmation of issuance',
            'notice_send' => 'Are confirmations issued?'
        ],

        'setting' => [
            'deposit' => 'Amount of deposit on day',
            'valid_num' => 'Effective water (multiples)',
            'times' => 'Number of turnstiles',
            'awards' => 'Prizes available',
            'is_open' => 'Enabled'
        ]
    ],

    'system_notice' => [
        'field' => [
            "title" => "Title",
            "content" => "Content",
            "text_content" => "APP content",
            "group_name" => "Subgroup names",
            "weight" => "Weight",
            "url" => "Jump link",
            "is_open" => "Enabled",
            "lang" => "Language",
        ],

        'index' => [
            'app_title' => 'APP Announcement List'
        ],

        'edit' => [
            'notice_group' => 'Groups have been grouped:'
        ]
    ],

    'system_config' => [
        'config_groups' => [
            'top_notice' => '<strong>Attention：</strong> The operation needs to be saved to take effect; click the right refresh button text to refresh this page',
            'system' => 'System related',
            'service' => 'Customer Service',
            'line' => 'Line',
            'site' => 'Site name',
            'activity' => 'Activities related',
            'recharge' => 'Payment related',
            'drawing' => 'Withdrawal related',
            'agent' => 'Agency related',
            'notice' => 'Reminders',
            'group_notice' => '<strong>Attention：</strong> After the content of the page is saved, the entire page needs to be refreshed to take effect',
            'btn_choose' => 'Selection file',
            'btn_preview' => 'Preview',
			'register'	=> 'Register',
        ],

        'app_content' => [
            'top_notice' => '<strong>Attention：</strong> Save to take effect after operation',
            'app_content' => 'Content related'
        ],

        'config_content' => [
            'register' => 'Registration related',
            'navigate' => 'Navigation related',
            'activity_about' => 'Activities related',
            'credit' => 'Borrowing',
            'levelup_slot' => 'Electronic upgrade',
            'levelup_live' => 'Life upgrade'
        ]
    ],

    'banner' => [
        'field' => [
            "id" => "ID",
            "title" => "Title",
            "description" => "Description",
            "url" => "Address",
            "dimensions" => "Wide height",
            "groups" => "Groups",
            "weight" => "Weight",
            "lang" => "Language",
            "is_open" => "Open",
            "created_at" => "Create time",
            "updated_at" => "Update time",
        ],

        'index' => [
            'top_notice' => '<strong>Attention：</strong> The upload records and files in Attachment Management are not deleted when you delete the rotation chart in the list;Reference size：web End Cartoon Size【1920*418】，h5 End【750*350】',
        ],

        'edit' => [
            'top_notice' => '<strong>Attention：</strong> Please keep the same size for the same set of pictures',
            'group_notice' => 'Please fill in the“mobile1”,PC Please fill in the“new1”'
        ]
    ],

    'about' => [
        'field' => [
            "id" => "ID",
            "title" => "Title",
            "subtitle" => "Subtitle",
            "cover_img" => "Cover photo",
            "content" => "Content",
            "type" => "Type",
            "is_open" => "Open",
            "is_hot" => "Is it hot",
            "weight" => "Weight",
            "lang" => "Language",
        ]
    ],

    'sport' => [
        'field' => [
            "home_team_name" => "Name of team",
            "home_team_name_en" => "Name of team",
            "home_team_img" => "Home team Pictures",
            "home_odds" => "Home team odds",
            "visiting_team_name" => "Name of visiting team",
            "visiting_team_name_en" => "Name of English",
            "visiting_team_img" => "Guest Picture",
            "visiting_odds" => "Passenger team odds",
            "let_ball" => "Let the ball go",
            "match_cup" => "Game Name",
            "match_cup_en" => "Competition Name",
            "match_at" => "Race time",
            "is_open" => "Open",
            "weight" => "Weight",
        ]
    ],

    'level_config' => [
        'field' => [
            "level" => "Grade",
            "level_name" => "Level Name",
            "deposit_money" => "Amount of deposit required for promotion",
            "bet_money" => "Betting amount for promotion",
            "level_bonus" => "Promotional gifts",
            "day_bonus" => "Daily gift",
            "week_bonus" => "Weekly gift",
            "month_bonus" => "Monthly gift",
            "year_bonus" => "Annual gift",
            "credit_bonus" => "Credit gift",
            "levelup_type" => "Type of promotion",
            "lang" => "Language/currency",
        ]
    ],

    'payment' => [
        'field' => [
            "desc" => "Description of payment method",
            "account" => "Collection Account",
            "type" => "Method of payment",
            "name" => "Name of payee",
            "qrcode" => "Payment of QR code",
            "memo" => "Payment Notes",
            "rate" => "Percentage of gifts",
            "min" => "Minimum recharge",
            "max" => "Maximum recharge amount",
            "forex" => "Percentage of transactions",
            "lang" => "Language",
            "is_open" => "Open",

            "detail" => "Details",
            "range" => "Single amount",
            "bank_type" => "Bank type",
            "bank_address" => "Account opening address",
            "account_id" => "Third party merchant number",
            "key" => "Third party key",
            "url" => "URL paid by third parties",
            "api" => "Third party payment identification",
            "paytype" => "Third party payment type code",
            "usdt_type" => "USDT type",
            "usdt_rate" => "USDT rate",
            "usdt_num" => "USDT number"
        ],

        "index" => [
            'top_notice' => 'The title and introduction of the Deposit Mode page are available in [System Configuration] - 【System Configuration Packets】 - 【Payment related】 In configuration'
        ],

        "edit" => [
            "notice_memo" => "Note information required for payment",
            "notice_range" => "When the minimum and maximum values are zero, there is no limit on the amount of recharge",
            "notice_min_max" => "The minimum and maximum recharge amount are in platform amount",
            "notice_forex" => "What amount is required for platform amount of 1, listed as RMB 10 of 1，Below\"Language/currency\"Select Chinese, trade ratio 10",
        ],

        'msg' => [
            'account_id_required' => 'Please enter the third party merchant number',
            'key_required' => 'Please enter a third party key',
            'url_required' => 'Enter a third party payment URL',
            'bank_type_required' => 'Please select Bank Card Type',
            'account_required' => 'Please enter the collection account',
            'name_required' => 'Please enter the name',
            'money_range_err' => 'The maximum recharge amount shall not be less than the minimum recharge amount',
            'usdt_account_required' => 'Please enter the USDT account',
            'usdt_rate_required' => 'Please enter the USDT rate',
            'usdt_rate_valid' => 'Please enter valid USDT rate',
        ]
    ],

    'activity' => [
        "field" => [
            "title" => "The title",
            "subtitle" => "subtitle",
            "cover_image" => "List cover drawing",
            "content" => "Activities that",
            "type" => "The activity type",
            "apply_type" => "Application way",
            "apply_url" => "To apply for the address",
            "apply_desc" => "Application description",
            "hall_image" => "Hall cover",
            "hall_field" => "Application Information",
            "date_desc" => "Activity time description",
            "date_description" => "The activity time",
            "start_at" => "Activity start time",
            "end_at" => "Activity deadline",
            "rule_content" => "Activity rules",
            "is_open" => "Whether open",
            "is_hot" => "Whether the hot",
            "weight" => "The weight",
            "lang" => "language",
        ],

        'index' => [
            'btn_preview' => 'Preview'
        ],

        'msg' => [
            'hall_image_required' => 'Please upload the cover of the activity hall',
            'apply_url_required' => 'Please fill in the jump address'
        ]
    ],

    'activity_apply' => [
        'field' => [
            "member_id" => "id of Members",
            "user_id" => "Administrator ID",
            "activity_id" => "Activity ID",
            "data_content" => "Application Information",
            "status" => "Status of application",
            "remark" => "Remarks Information",

            "money" => "Amount paid"
        ],

        'index' => [
            'btn_confirm' => 'audit',
            'btn_reject' => 'audit not approved',
            'notice_confirm' => 'Are you sure to apply through the activities of the members?',
            'notice_reject' => 'Are you sure to reject the member s sign-in award application?',
            'btn_bonus' => 'Incentives for distribution'
        ],

        'edit' => [
            'title_confirm' => 'audit',
            'title_reject' => 'audit not approved',
            'top_notice' => '<strong>Attention：</strong> If you need to distribute the award, please process it after the approval',
            'dealed_error' => 'The application record has been processed, do not repeat',
        ],

        'bonus' => [
            'top_notice' => '<strong>Attention：</strong> The amount of activity is released to the reverse water account by default',
            'money_notice' => 'To which wallet please set up in System Settings - Activity Related'
        ]
    ],

    'modify_pwd' => [
        'field' => [
            "oldpassword" => 'The original password',
            "password" => 'The new password',
            "password_confirmation" => 'Confirm the new password',

            "qk_pwd" => 'New withdrawal code',
            "old_qk_pwd" => 'Original withdrawal code',
            "qk_pwd_confirmation" => 'Confirm the new withdrawal password'
        ]
    ],

    'register' => [
        'field' => [
            'name' => 'account',
            'password' => 'password',
            'password_confirmation' => 'Confirm password',
            'rates' => 'Rebates proportion'
        ]
    ],

    'member_bank' => [
        'field' => [
            "member_id" => "The member ID",
            "card_no" => "The card number",
            "bank_type" => "Bank type",
            "bank_type_text" => "Bank type",
            "phone" => "phone number",
            "owner_name" => "Cardholder's name",
            "bank_address" => "Bank address",
            "remark" => "Operation note",
        ],

        'index' => [
            'title' => ''
        ]
    ],

    'recharge' => [
        'field' => [
            "bill_no" => "Transaction number",
            "member_id" => "The member id",
            "name" => "Name of transferor",
            "account" => "Transfer accounts",
            "origin_money" => "Amount of recharge before conversion",
            "forex" => "Proportion of transactions converted",
            "lang" => "Language/currency",
            "money" => "Top-up amount",
            "payment_type" => "Payment type",
            "payment_pic" => "Payment voucher",
            "diff_money" => "Given the amount of",
            "before_money" => "Amount before recharge",
            "after_money" => "Amount after recharge",
            "score" => "integral",
            "fail_reason" => "The reason for failure",
            "hk_at" => "9/5000  The time of remittance filled in by the customer",
            "confirm_at" => "Confirm transfer time",
            "status" => "Payment status",
            "user_id" => "Administrator ID",

            'payment_id' => 'Gathering information',
            'payment_account' => 'Payment account',
            'payment_name' => 'Payees name',
            'bank_type' => 'Payment Bank'
        ],

        'index' => [
            'btn_confirm' => "Approved",
            'btn_reject' => "Failure to pass",
            'btn_payment_detail' => "Account details"
        ],

        'edit' => [
            'notice_diff' => "Payment Channel :text Percentage of gifts :rate"
        ],

        'msg' => [
            'recharge_dealed' => 'The recharge record was processed',
        ]
    ],

    'drawing' => [
        'field' => [
            "bill_no" => "Transaction number",
            "member_id" => "The member ID",
            "name" => "Payees name",
            "money" => "On withdrawals",
            "account" => "Account information",
            "before_money" => "Amount before withdrawal",
            "after_money" => "Amount after withdrawal",
            "score" => "integral",
            "counter_fee" => "poundage",
            "fail_reason" => "The reason for failure",
            "member_bank_info" => "User bank data JSON",
            "member_remark" => "User withdrawal notes",
            "confirm_at" => "Confirm transfer time",
            "status" => "Withdrawal state",
            "user_id" => "Administrator ID",
        ],

        'index' => [
            'btn_confirm' => 'audit',
            'btn_reject' => 'audit not approved'
        ],

        'msg' => [
            'dealed_error' => 'Application for withdrawal processed'
        ]
    ],

    'message' => [
        'field' => [
            "user_id" => "Administrator ID",
            "pid" => "The previous message ID",
            "url" => "Jump the URL",
            "title" => "Station letter title",
            "content" => "Send content",
            "visible_type" => "Visible type",
            "send_type" => "Send type",
        ],

        'index' => [
            'visible_member' => 'Visible Members',
            'all_member' => 'All Members',
        ],

        'msg' => [
            'member_select_required' => 'Please select which member to send',
            'data_select_required' => 'Select the data you need to manipulate',
        ]
    ],

    'member_message' => [
        'field' => [
            'title' => 'Member Feedback Title',
            'content' => 'Feedback from members',
            'reply_title' => 'Reply title',
            'reply_content' => 'Reply content',
            'status' => 'Reply status'
        ],

        'index' => [
            'btn_batch_read' => 'Volume read',
            'btn_detail' => 'Feedback Details',
            'btn_reply' => 'Message Response',
            'btn_mark' => 'Marking Reply',
            'title_mark' => 'Are you sure you re doing tag recovery?',
            'title_delete' => 'Are you sure to delete the reply?'
        ],

        'history' => [
            'title' => 'Feedback Details',
        ],
    ],

    'member_money_log' => [
        'field' => [
            "member_id" => "The member id",
            "user_id" => "Administrator ID",
            "money" => "Operation amount",
            "money_before" => "Pre-operation amount",
            "money_after" => "Amount after operation",
            "money_type" => "Amount field type",
            "number_type" => "The number of types",
            "operate_type" => "Type of amount change",
            "model_name" => "The model name",
            "model_id" => "Model ID",
            "description" => "Operation description",
            "remark" => "Operation note",
        ],

        'notice' => [
            'activity_bonus' => 'Distribution activities【 :title 】Bonus【 :money money】Membership【 :member 】',
            'system_send_fs' => 'Time frame for administrator release【 :time 】Game type【 :game_type 】Backwater to Backwater Wallet',
            'drawing_reject' => 'The amount will not be withdrawn by the member【 :money money】Refund to Member Account for Rejection：:reason',
            'drawing_counter_fee' => '，Membership code【 :ml_money 】,Less charges【 :count_fee money】',
            'drawing_request' => 'Member s final withdrawal amount【 :money 】',
            'get_fs_now' => 'Date of receipt【 :time 】Before the reverse water, the amount is【 :money 】，Game type【 :game_type】，Issued to Backwater Wallet',

            'transfer_in_game' => 'Transfer【 :title 】Game games【 :money money】，Deduction of account amount',
            'transfer_in_error' => 'Transfer【 :title 】Game failed, refund account amount【 :money money】',
            'transfer_out_game' => 'Transfer【 :title 】Game games【 :money money】，Increase in account value'
        ]
    ],

    'yuebao_plan' => [
        'field' => [
            "SettingName" => "Programme title",
            "MinAmount" => "Minimum purchase amount",
            "MaxAmount" => "Maximum purchase amount",
            "SettleTime" => "Settlement time (hours)",
            "IsCycleSettle" => "Settlement method",
            "Rate" => "Programme rates",
            "TotalCount" => "Total planned",
            "LimitInterest" => "Member ceiling interest",
            "LimitOrderIntervalTime" => "Order interval (hours)",
            "InterestAuditMultiple" => "Multiple of interest code",
            "LimitUserOrderCount" => "Total Member s Maximum Purchase Amount",
            "is_open" => "Open Purchase",
            "weight" => "Sort",
        ],

        'edit' => [
            'notice_no_limit' => 'No restrictions',
            'notice_default_ml' => 'Default is 1x code',
            'notice_weight' => 'The bigger the better'
        ],

        'member_plan' => [
            'created_at' => 'Purchase time'
        ],

        'msg' => [
            'min_money_err' => 'The minimum purchase amount shall not be higher than the minimum purchase amount',
            'max_money_err' => 'The maximum purchase amount shall not exceed the total planned amount',
        ]
    ],

    'member_yuebao_plan' => [
        'field' => [
            "member_id" => "Member id",
            "plan_id" => "Programme ID",
            "amount" => "Purchase amount",
            "status" => "Status",
            "drawing_at" => "Cash time",

            "interest_sum" => "Cumulative interest",
        ],

        'index' => [
            'title_interest_history' => 'Profit record - 【 :name 】'
        ]
    ],

    'interest_history' => [
        'field' => [
            "member_plan_id" => "ID of membership programmes",
            "interest" => "Interest",
            "times" => "Number of times",
            "calc_at" => "Settlement time",
        ]
    ],

    'credit_pay_record' => [
        'field' => [
            "member_id" => "Member id",
            "money" => "Amount borrowed",
            "type" => "Type",
            "borrow_day" => "Borrowing days",
            "status" => "Status",
            "dead_at" => "Loan maturity",

            "is_overdue" => "Overdue"
        ],

        'index' => [
            'btn_confirm' => 'Adoption',
            'notice_confirm' => 'Are you sure of the loan operation through the member?',
            'btn_reject' => 'Are you sure to reject the loan operation of the member?',
            'notice_reject' => 'Refusal',

            'title_lend' => 'Repayment records',
            'title_borrow' => 'Borrowing records',
        ]
    ],

    'quick' => [
        'member_arbitrage_query' => [
            'arbitrage_type' => 'Type of arbitrage',
            'result' => 'Query results',
            'total_number' => 'Total',
            'no_result' => 'No relevant data',
        ],

        'transfer_check' => [
            'start_at' => 'Start time',
            'end_at' => 'End time',
            'transfer_out_account' => 'Transfer of accounts',
            'transfer_in_account' => 'Transfer to account',
            'money' => 'Amount transferred',
            'is_dd' => 'Whether to drop the order',
            'btn_supply' => 'Supplementary only',
            'btn_supply_modify' => 'Replenishment and modification of balance',

            'no_transfer_data' => 'This member has no quota conversion record between [:start_at ~ :end_at]',
            'transfer_count_success' => 'This member has [:count] records between [:start_at ~ :end_at] and has not dropped orders',
            'transfer_count_fail' => 'There are :fail_count orders in the [:count] records between [:start_at ~ :end_at]',
            'money_not_enough' => 'Insufficient balance of membership, please check',
        ],

        'database_clean' => [
            'top_notice' => '<strong>Attention：</strong> The operation is irreversible, be careful;【Membership】and【Agency commission records】Can not be deleted according to the member name, only according to the number of data cleaning days to delete；<br><b>If you delete the member s game record, it will result in the loss of promotion level benefit data<b>；',
            'member_notice' => 'If you do not select a member, you clean up all the data in the system',
            'content' => 'Clean-up content',

            'member' => 'Membership',
            'agent' => 'Agent table',
            'agent_fd_money_log' => 'Agent Return Amount Log',
            'agent_yj_log' => 'Agency commission records',
            'drawing' => 'Withdrawal records',
            'game_record' => 'Member Game Record',
            'member_money_log' => 'Membership log',
            'recharge' => 'Recharge record',
            'transfer' => 'Quota conversion record',
            'member_log' => 'Member operation log',
            'member_wheel' => 'Member Rotation Record',
            'daily_bonus' => 'Membership Check-in Record',
            'member_yuebao_plan' => 'Member s balance record',
            'credit_pay_record' => 'Members borrow records',
            'activity' => 'List of activities',
            'activity_apply' => 'Application for Membership Activities',

            'oldest_date' => 'Last Data Date',
            'latest_date' => 'Latest Data Date',
            'day_before' => ':date Before',

            'day_field' => 'How many days ago',
            'days' => 'Data cleansing days',
            'day_notice' => 'Default cleans data 30 days away',

            'alert_before' => 'Cleanup selected',
            'alert_after' => 'Is it clear',
            'alert_title' => 'Operational Tips',
            'alert_1' => 'I ll get to know',
            'alert_2' => 'I have read the above red text and continue to clean up',

            'item_select_required' => 'Please select Cleanup',
        ]
    ],

    'yj_level' => [
        'field' => [
            'level' => 'Commission level',
            'name' => 'Grade name',
            'active_num' => 'Number of active offline',
            'min' => 'Minimum turnover',
            'rate' => 'Commission ratio (percentage)',
            "lang" => "Currency",
        ],

        'msg' => [
            'top_notice' => 'Note: The criterion for active offline members is that the monthly recharge amount reaches [:money] yuan. If you need to modify it, please modify it in the [System Configuration]-[System Configuration Group]-[Agent Related] page'
        ]
    ],

    'agent_yj_log' => [
        'field' => [
            'created_at' => 'Commission time range',
            'top_title' => 'Agency financial statements',

            'offline' => 'Downline member',
            'balance' => 'Offline balance',
            'transfer' => 'Money Transfer',
            'deposit' => 'deposit',
            'withdraw' => 'withdraw',
            'bonus' => 'bonus',
            'activity' => 'activity',
            'rebate' => 'rebate',
            'other' => 'other',
            'last_at' => 'Last commission time',
            'money' => 'Commission amount',
            'remark' => 'remark',

            'send_yj' => 'Distribute commission',
            'record' => 'record',
            'history' => '【:name】Commission payment history',
        ],

        'msg' => [
            'top_notice' => 'Note: The agency commission payment is a traditional agency model, which is controlled by the administrator. In principle, it is issued once a month',

            'time_range_required' => 'Please choose the time range',
            'yj_send_success' => 'Successful commission issuance',
            'yj_send_fail' => 'Failure to issue commissions:',
        ]
    ],

    'send_fs' => [
        'msg' => [
            'realtime_fs_mode' => 'Currently real-time reverse water mode, can not use one-click back water function',
            'send_success' => 'Successful anti-water distribution',
            'send_fail' => 'Reverse water release failed:',
        ]
    ],

    'transfer' => [
        'field' => [
            "bill_no" => "Transaction Current Number",
            "api_name" => "Interface identification",
            "member_id" => "Member id",
            "transfer_type" => "Type of transfer",
            "money" => "Conversion amount",
            "diff_money" => "Difference (dividend) amount",
            "real_money" => "Actual amount converted",
            "before_money" => "Amount before transfer",
            "after_money" => "Amount transferred",
            "money_type" => "Amount field type",
        ]
    ],

    'fs_level' => [
        'field' => [
            "game_type" => "Game type",
            "member_id" => "Member id",
            "level" => "Reverse water grade",
            "name" => "Level Name",
            "quota" => "Effective Betting Amount",
            "type" => "Type",
            "rate" => "Reverse water ratio",
            "lang" => "Language/currency"
        ],

        'msg' => [
            'select_member' => 'Please select members',
            'same_data_not_allowed' => 'There can only be one piece of data for the same game type, type, level, currency',
            'fs_level_required' => 'Please set the rank name',
            'fs_level_repeat' => 'This level of backwater level data already exists, please delete it after operation',
        ],
    ],

    'aside_adv' => [
        'field' => [
            'name' => 'name',
            'group' => 'Group name',
            'pic_url' => 'ad pictures',
            'pic_index' => 'Picture index',
            'vertical' => 'Vertical position',
            'horizontal' => 'horizontal position',
            'effect' => 'Special effects',
            'url_id' => 'Jump route',
            'remark' => 'remark',
            'lang' => 'language',
            'is_open' => 'Is open',
            'weight' => 'weight',
        ],
    ],

    'option' => [
        'member_status' => [
            1 => 'To enable the',
            -1 => 'disable',
            -2 => 'Kick off'
        ],
        'game_type' => [
            1 => 'reality',
            2 => 'fishing',
            3 => 'electronic',
            4 => 'lottery',
            5 => 'sports',
            6 => 'chess',
            7 => 'other',
            99 => 'System of lottery tickets'
        ],

        'activity_type' => [
            1 => 'Return water activity',
            2 => 'Bonus activity',
            3 => 'Top-up activities',
            4 => 'presentation'
        ],

        'activity_is_apply' => [
            1 => 'Need to apply for',
            0 => 'Do not need to apply for'
        ],

        'activity_apply_type' => [
            0 => 'Do not need to apply for',
            1 => 'Contact customer service for application',
            2 => 'Activity Hall application',
            3 => 'Skip to view details'
        ],

        'activity_apply_field' => [
            'member_name' => 'Member user name',
            'recharge_money' => 'Amount of deposit',
            'game_type' => 'The game type',
            'api_game_type' => 'Game subcategory',//(接口 + 游戏类型),
            'bill_no' => 'Note the single number',
        ],

        'activity_apply_status' => [
            0 => 'To audit',
            1 => 'approved',
            2 => 'Not approved',
            3 => 'The offer has been issued'
        ],

        'is_open' => [
            1 => 'open',
            0 => 'Shut down'
        ],

        'is_read' => [
            1 => 'read',
            0 => 'unread'
        ],

        'boolean' => [
            1 => 'is',
            0 => 'no'
        ],

        'gender' => [
            0 => 'male',
            1 => 'female'
        ],

        'member_money_type' => [
            'money' => 'Balance of central wallet',
            'fs_money' => 'Rebate purse balance',
            'total_money' => 'Total betting amount of the platform',
            'score' => 'Member of the integral',
            'ml_money' => 'Code quantity balance',
            'total_credit' => 'Borrow the total amount',
            'used_credit' => 'Borrowing money has been spent'
        ],

        'member_money_operate_type' => [
            1 => 'Administrator operation',
            2 => 'System is presented',
            3 => 'Turn in/out of the game',
            4 => 'Return water distribution',
            5 => 'Check in activity to collect',
            6 => 'Top-up activities',
            7 => 'Platform dividend',
            8 => 'Grab a red envelope',
            9 => 'Recharge/withdraw',
            10 => 'Top-up gifts',
            11 => 'Refuse to return withdrawals',
            12 => 'Turn into the game failed to return',
            13 => 'Handed out',
            14 => 'The agent commission',
            15 => 'Rotary draw',
            16 => 'Buy financial Products',
            17 => 'Dividends from financial products',
            18 => 'Refund/deduction',
            19 => 'Redemption of financial products',
            20 => 'Promotional awards',
            21 => 'Zhou Salaries',
            22 => 'Monthly salaries',
            23 => 'Borrow a loan',
            24 => 'Repending repayment',
            25 => 'Daily gift',
            26 => 'Weekly gift',
            27 => 'Monthly gift',
            28 => 'Annual gift',
            29 => 'Promotional gifts',
        ],

        'levelup_types' => [
            1 => 'Deposit deposit amount',
            2 => 'Standard ting amount',
            3 => 'Any of them',
            4 => 'All compliance',
        ],

        'money_number_type' => [
            1 => 'increase',
            -1 => 'To reduce'
        ],

        'card_type' => [
            1 => 'A cash card',
        ],

        'agent_assign_types' => [
            1 => 'To recreate the',
            2 => 'Use the old agency'
        ],

        'feedback_type' => [
            1 => 'Platform issues',
            2 => 'Financial problems',
            3 => 'Provide advice'
        ],

        'about_type' => [
            1 => "About us",
            2 => "The savings help",
            3 => "Withdrawals to help",
            4 => "Q&A",
            5 => "partners",
            6 => "Pool agreement",
            7 => "Contact us",
            8 => "Terms and rules"
        ],

        'gamerecord_status' => [
            'N' => 'Has been cancelled',
            'X' => 'No settlement',
            'COMPLETE' => 'Has been settled',
            'CANCEL' => 'Had withdrawn',
        ],

        'client_type' => [
            0 => 'It supports both mobile phones and computers',
            1 => 'pc',
            2 => 'phone'
        ],

        'tag_type' => [
            'hot' => 'hot',
            'recommend' => 'recommended',
            'new' => 'The latest',
        ],

        'apply_status' => [
            0 => 'To audit',
            1 => 'approved',
            2 => 'Not approved'
        ],

        'recharge_status' => [
            1 => 'To be confirmed',
            2 => 'Top-up success',
            3 => 'Top-up failure'
        ],

        'drawing_status' => [
            1 => 'To be confirmed',
            2 => 'Withdrawals success',
            3 => 'Withdrawals failure'
        ],

        'recharge_type' => [
            1 => 'Alipay',
            2 => 'WeChat',
            3 => 'Bank transfer',
            4 => 'Third-party payment',
            5 => 'QQ',
            6 => 'Quick - WeChat',
            7 => 'Quick - Alipay'
        ],

        'payment_type' => [
            'online_alipay' => 'Alipay Payment (Online Payment)',
            'online_wechat' => 'WeChat pay (online pay)',
            'online_union_quick' => 'Unionpay Fast (Online Payment)',
            'online_union_scan' => 'Unionpay scanning code (Online Payment)',
            'company_bankpay' => 'Bank card transfer (company deposit)',
            'company_alipay' => 'Alipay Payment (Company deposit)',
            'company_wechat' => 'WeChat corporate payment (company deposit)',
            'online_cgpay' => 'CGPay (Online Payment)',
            'company_usdt' => 'USDT (company deposit)',
            'online_usdt' => 'USDT (Online Payment)',
        ],

        'transfer_type' => [
            1 => 'Into the game',
            2 => 'Go out of the game'
        ],

        // 消息可见性类型
        'message_visible_type' => [
            1 => 'All members can see',
            2 => 'Single member visible',
            3 => 'Administrator visibility'
        ],

        // 消息发送类型
        'message_send_type' => [
            1 => 'Administrator send',
            2 => 'Members to send'
        ],

        'message_status' => [
            0 => 'To reply',
            1 => 'Have to reply',
            2 => 'Mark reply'
        ],

        // 签到类型 负数表示设置，正数表示领奖
        'daily_bonus_type' => [
            -2 => 'Continuous sign-in reward',
            -1 => 'Accumulated sign-in bonus',
            0 => 'Ordinary sign in',
            1 => 'Cumulative check-in for prizes',
            2 => 'Continuously sign in for prizes'
        ],

        'daily_bonus_set' => [
            -1 => 'The cumulative sign in',
            -2 => 'Continuous sign in'
        ],

        'daily_bonus_state' => [
            0 => 'To be confirmed',
            1 => 'Have been confirmed',
            -1 => 'Has refused to'
        ],

        'member_log_type' => [
            1 => 'Member login',
            2 => 'Member to log out',
            3 => 'Member of the operation',
            4 => 'Agent background login',
            5 => 'Agent logout backstage',
            6 => 'Member goes to interface exception'
        ],

        'task_condition_types' => [
            1 => 'Single top-up',
            2 => 'The accumulated top-up',
            3 => 'withdrawals',
            4 => 'Accumulative total profit',
            5 => 'The cumulative losses',
            6 => 'The cumulative water',
            7 => 'Member SMS registration verification'
        ],

        'task_award_type' => [
            1 => 'The title of reward',
            2 => 'Amount of reward',
            3 => 'Rebates reward',
            4 => 'Credit limit award'
        ],

        'level_award_type' => [
            'level_award' => 'Grade gift',
            'week_award' => 'Weeks salary',
            'month_award' => 'Month salary',
            'name_award' => 'The title of reward',
            'borrow_award' => 'Credit limit award'
        ],

        'fs_type' => [
            1 => 'System rebate level',
            2 => 'Member rebate level'
        ],

        'member_task_status' => [
            1 => 'To receive the',
            2 => 'Brought up'
        ],

        'agent_rate_type' => [
            3 => 'Agent/member points',
            4 => 'The default point for agent referrals'
        ],

        'config_money_type' => [
            'money' => 'Center for the purse',
            'fs_money' => 'Return water wallet',
        ],

        'arbitrage_conditions' => [
            'ip' => 'With IP',
            'psw' => 'With the password',
            'phone' => 'Same telephone number',
            'card' => 'Same bank account name'
        ],

        'wheel_awards' => [
            1 => ['desc' => '500 get 100 coupons','type' => 2,'pic' => 'web/images/wheel/zh_cn/2ead44b68b93b0677b2cffe04cdf08d3.png'],
            2 => ['desc' => '$28','type' => 1,'pic' => 'web/images/wheel/zh_cn/34bacd7183d7e2b95845d2c48e27d10c.png'],
            3 => ['desc' => '100 get 20 coupons','type' => 2,'pic' => 'web/images/wheel/zh_cn/bd8dd02713d3ac8705b38f1602de04a4.png'],
            4 => ['desc' => '$58','type' => 1,'pic' => 'web/images/wheel/zh_cn/96b56053b67e5216b8d2c07562344e56.png'],
            5 => ['desc' => 'Hong Kong and Macau five-day tour','type' => 3,'pic' => 'web/images/wheel/zh_cn/295c5965c9ed549937c3cf5942ccb897.png'],
            6 => ['desc' => '$88','type' => 1,'pic' => 'web/images/wheel/zh_cn/11f2d5122249b7d1adb166ceffdb197e.png'],
            7 => ['desc' => '5000 get 1000 coupons','type' => 2,'pic' => 'web/images/wheel/zh_cn/b07eedbdf8cdf5b89b8d004d0b8e3f37.png'],
            8 => ['desc' => '$18','type' => 1,'pic' => 'web/images/wheel/zh_cn/447075995668a5e04b0bf60885be216e.png'],
            9 => ['desc' => 'IPHONE 12 PRO MAX 512GB','type' => 3,'pic' => 'web/images/wheel/zh_cn/957740284f61bba05611061782f8d639.png'],
            10 => ['desc' => '1000 get 300 coupons','type' => 2,'pic' => 'web/images/wheel/zh_cn/9019cab46b10bc82ab6ba6a94d6beb3c.png'],
            11 => ['desc' => '7-day luxury tour of Southeast Asia','type' => 3,'pic' => 'web/images/wheel/zh_cn/835cfc99c3e77309c238612972996253.png'],
            12 => ['desc' => '$8','type' => 1,'pic' => 'web/images/wheel/zh_cn/939d617c97f3a372980f3362245b3b5c.png']
        ],

        'wheel_status' => [
            1 => 'Stay out',
            2 => 'issued',
            3 => 'Direct distribution'
        ],

        'yuebao_settle_type' => [
            0 => 'A single settlement',
            1 => 'Cycle and settlement'
        ],

        'yuebao_member_status' => [
            0 => 'ongoing',
            1 => 'Has ended'
        ],

        'quick_url_type' => [
            'web' => 'The WEB page',
            'index' => 'A separate page',
            'mobile' => 'Mobile page'
        ],

        'adv_vertical' => [
            'top' => 'top',
            'bottom' => 'bottom',
        ],

        'adv_horizontal' => [
            'left' => 'left',
            'right' => 'right'
        ],

        'adv_effect' => [
            'hover' => 'suspension'
        ],

        "notice_type" => [
            "voice" => "Voice only reminder",
            "alert" => "Only pop-up reminders",
            "voice_and_alert" => "Sound reminders and popover reminders"
        ],

        "is_online" => [
            1 => 'online',
            0 => 'offline'
        ],

        "credit_type" => [
            'borrow' => 'borrowing',
            'lend' => 'reimbursement'
        ],

        "credit_status" => [
            1 => 'To be confirmed',
            2 => 'Borrowing successful',
            3 => 'Refused to borrow',
            4 => 'Payment is successful'
        ],

        'levelup_type' => [
            7 => 'slot level up',
            8 => 'live level up'
        ],

        'notice_group' => [
            'main' => '首页公告',
            'credit' => '借呗公告',
            'pc' => '电脑弹窗',
            'mobile' => '手机弹窗'
        ],

        'register_setting_field' => [
            'isInviteCodeRequired' => 'Is require invite code(Web Version)',
            'isRealNameRequred' => 'Is require real name(Web Version)',
            'isPhoneRequired' => 'Is require phone number(Web Version)',
            'isCaptchaRequired' => 'Is require capthca(Web Version)',

            'isInviteCodeRequired_mobile' => 'Is require invite code(mobile Version)',
            'isRealNameRequred_mobile' => 'Is require real name(mobile Version)',
            'isPhoneRequired_mobile' => 'Is require phone number(mobile Version)',
            'isCaptchaRequired_mobile' => 'Is require capthca(mobile Version)',
        ],

        'web_nav' => [
            "index" => "Home Page",
            "slot" => "Electronic Fun",
            "poker" => "Chess game",
            "casino" => "Live video",
            "lottery" => "Lottery games",
            "sport" => "Sports events",
            "fish" => "Fishing game",
            // "e_sport" => "电子竞技",
            "activity" => "Preferential activities",
            "app" => "Mobile APP",
            "service" => "Online customer service"
        ],

        'member_apis' => 'Balance of the interface',
        'recharges' => 'Prepaid phone records',
        'drawings' => 'Withdrawals records',
        'transfers' => 'Transfer record',
        'gamerecords' => 'The game record',
        'memberlogs' => 'Log on to log',
        'modify_money' => 'Change the balance of',
        'arbitrage_query' => 'Arbitrage query',
        'make_offline' => 'Kick off',
        'make_offline_msg' => 'Are you sure you want to take a member offline？',

    ],

    // 接口相关文字
    'api' => [
        'common' => [
            'demo_not_allowed' => 'The demo account cannot do this',
            'member_forbidden' => 'The account has been disabled',
            'operate_error' => 'Abnormal operation',
            'operate_fail' => 'The operation failure：',
            'operate_forbidden' => 'Illegal request',
            'operate_again' => 'Operation failed, please try again',
            'operate_success' => 'Operation is successful',
            'member_not_exist' => 'Member information does not exist',
            'net_again_err' => 'Network error, please try again',
            'err_code' => 'The error code：',
            'err_msg' => 'The error message：',
            'money_desc' => '$ :money',
            'server_error' => 'Internal server error',
            'phone_not_exist' => 'Phone number does not exist',
            'phone_existed' => 'Phone number already exists',
        ],

        'index' => [
            'main_advertise_title_1' => 'Offers for new members.',
            'main_advertise_title_2' => 'Exclusive offers for video games.',
            'main_advertise_title_3' => 'Live video exclusive discount.',

            'main_advertise_sub_title_1' => 'More discounts for VIP.',
            'main_advertise_sub_title_2' => 'E-game exclusive deposit free 25% discount.',
            'main_advertise_sub_title_3' => 'Members get 30% bonus on the first deposit.',

            'hotgame_sub_title_1' => 'Thailand cockfighting games are fully covered, and the gameplay is diverse and enjoyable, providing you with the richest cockfighting entertainment game in the entire network.',
            'hotgame_sub_title_2' => 'Adhering to the heart of craftsmanship, we will provide players with the ultimate gaming experience. Ten million cumulative prize pools within reach, waiting for you to be released!',
            'hotgame_sub_title_3' => 'The most authentic casino environment, the most beautiful and professional croupiers, present you luxury Baccarat, with diverse and non-repetitive playing methods, and present you with a wonderful live experience!',
        ],

        'lottery' => [
            'OTHERS' => 'Others'
        ],

        'sms' => [
            'code_required' => 'Please fill in the SMS CAP',
            'code_get_first' => 'Please get short message verification code first',
            'code_expired' => 'Short message verification code has expired, please re-access;',
            'code_error' => 'SMS verification code filling in the error, please try again',
            'operation_repeat' => 'Received the verification code within two minutes, and do not operate frequently',
        ],

        'apply_agent' => [
            'member_is_agent' => 'You are already an agent and do not need to apply',
            'has_applied' => 'You have submitted your application. Please wait patiently',
            'apply_success' => 'Application submitted successfully',
            'apply_fail' => 'Application submission failed, please try again',
            'status_fail' => 'You havent applied for an agent yet',
            'not_agent' => 'You are not an agent yet'
        ],

        'member_bank' => [
            'create_success' => 'Bank data creation successful',
            'create_fail' => 'Bank data creation failed. Please try again',
            'update_success' => 'Bank data updated successfully',
            'update_fail' => 'Bank data update failed. Please try again',
            'delete_success' => 'Bank data was deleted successfully',
            'delete_fail' => 'Bank data deletion failed. Please try again'
        ],

        'recharge' => [
            'payment_closed' => 'The payment channel has been closed. Please select it again',
            'pay_between' => 'The transfer amount range is :min ~ :max yuan, please check',
            'pay_success' => 'Submit successfully, please pay',
            'payment_change' => 'The collection information has changed, please resubmit',
            'pay_normal_success' => "The application for recharge has been submitted successfully. Please wait for the administrator's review",
            'pay_normal_fail' => "Application for recharge failed, please try again",

            'not_third_pay' => 'The payment method is not third-party payment',
            'param_not_all' => 'Incomplete parameter',
            'config_err' => 'Third-party payment configuration error',

            'pay_money_err' => 'Please enter an integer number of the transaction ratio',
        ],

        'drawing' => [
            'qk_pwd_required' => 'Please enter the correct withdrawal code',
            'qk_pwd_error' => 'The withdrawal password is incorrect. Please try again',
            'money_not_enough' => 'The withdrawal amount is larger than the current amount, please modify',
            'bank_not_exist' => 'Bank card information does not exist, please check',
            'time_not_allow' => 'No withdrawal is available at the current time',
            'min_money' => 'The withdrawal amount is less than the minimum withdrawal amount :min',
            'max_money' => 'The withdrawal amount is higher than the maximum withdrawal amount :max',
            'times_not_enough' => 'Please come again tomorrow',
            'drawing_success' => 'The withdrawal application has been submitted successfully. Please wait for the administrators review',
            'drawing_fail' => 'Your withdrawal request failed. Please try again:',
            'ml_calc_err' => 'Error in code calculation：'
        ],

        'message' => [
            'send_success' => 'The message has been sent successfully. Please wait for the administrators reply',
            'send_fail' => 'The message failed to be sent. Please try again',
            'update_success' => 'Update the message status of the station：',
            'update_fail' => 'The status update of the station message failed',
            'delete_success' => 'Message deleted successfully',
            'delete_fail' => 'Site letter deletion failed'
        ],

        'modify_pwd' => [
            'password_error' => 'The original password is wrong, please check',
            'password_success' => 'Password changed successfully',
            'password_fail' => 'Password change failed',

            'qk_pwd_set' => 'You have already set the withdrawal password, you do not need to set it again',
            'qk_pwd_success' => 'The withdrawal password has been set successfully',
            'qk_pwd_fail' => 'Withdrawal password setting failed',
            'qk_pwd_error' => 'The original withdrawal password is wrong, please check',
            'qk_pwd_set_success' => 'The withdrawal password has been changed successfully',
            'qk_pwd_set_fail' => 'Withdrawal password change failed'
        ],

        'redbag' => [
            'not_open' => 'The function is disabled',
            'no_times' => 'The number of times to grab red envelopes has reached the limit today. Please come again tomorrow',
            'success' => 'Congratulations, you have got the amount: the red envelope of money yuan, please check the account balance in the transaction record'
        ],

        'dailybonus' => [
            'not_open' => 'The check-in function is not open yet',
            'no_times' => 'You have signed in today, you dont need to sign in again',
            'success' => 'Sign in successfully',
            'fail' => 'Sign in failed',
            'check_day_not_enough' => 'Does not meet the claim requirements, please check',
            'check_repeat' => 'You have already received the reward or are in the process of application. Please do not collect or apply again',
            'check_success' => 'Successful sign-in reward',
            'check_admin_check' => 'The sign-in application has been submitted successfully. Please wait for the administrators review',
            'get_bonus_success' => 'Member【 :name 】Receive sign-in reward【$ :money 】',
        ],

        'fs_now' => [
            'get_success' => 'Real-time rebate claim is successful, please check the details in the transaction record',
            'fs_level_err' => 'Rebate level is not configured, please contact customer service',
            'fs_no_data' => 'No rebate to claim',
            'fs_not_open' => 'This feature is not yet open',
            'fs_repeat' => 'This part of the backwater has been collected, please do not repeat the operation'
        ],

        'yuebao' => [
            'plan_require' => 'Please select the purchase plan',
            'amount_regex' => 'Purchase Price Please select purchase proposal amount must be multiple of 10',
            'plan_not_exist' => 'The purchase plan does not exist',
            'plan_sold_out' => 'The scheme is sold out',
            'no_enough_amount' => 'Purchase quantity exceeds the limit, please try again',
            'member_no_money' => 'The account balance is insufficient, please recharge it',
            'success' => 'Buy success',
            'back_success' => 'Successfully redeemed, [principal + interest] total [$ :money] has been transferred to your account'
        ],

        'transfer' => [
            'api_not_open' => 'Did not open',
            'change_hand' => 'Has been switched to "Go to game manually" mode',
            'change_auto' => 'Has been switched to "Auto into game" mode',

            'field' => [
                'fs_money' => 'As the purse',
                'money' => 'Center for the purse'
            ]
        ],

        'team' => [
            'not_direct_child' => 'This account is not your subordinate account and cannot be operated',
            'member_name_regex' => 'The user name must begin with a lowercase letter and can only contain lowercase letters and numbers',
            'not_set_rate' => 'Please set the return dot for all game types',
        ],

        'register' => [
            'captcha_required' => 'Please enter the correct verification code',
            'register_fail' => 'Registration failed',
            'register_success' => 'Registered successfully',
            'invite_code_required' => 'Please enter the correct invite code'
        ],

        'login' => [
            'name_psd_err' => 'Incorrect account or password',
            'demo_not_open' => 'The system is not enabled to play',
        ],

        'activity' => [
            'no_need_apply' => 'No application is required',
            'apply_repeat' => 'You have already applied for this activity today. Please do not repeat your application',
            'apply_success' => 'Application successful, please wait for processing result',
            'apply_fail' => 'Application failed, please try again',
        ],

        'wheel' => [
            'wheel_desc' => 'If the minimum deposit at Sands is more than money and the effective total bet amount meets the minimum deposit requirement of gift money on that day, the members who are times or above will get the number of lucky dials and have the chance to win: Award. The quota is unlimited.'
        ],

        'credit_pay' => [
            'not_open' => '[Borrow bai] has not been opened',
            'member_not_exist_or_forbidden' => 'Membership does not exist or is disabled',
            'member_info_error' => 'Incorrect member information was entered',
            'user_credit_remained' => 'If you have not paid off the loan, please pay off the loan again',
            'borrow_max' => 'Can only borrow money [:money yuan]',
            'borrow_success' => 'The application has been submitted. Please check the "credit limit" 2 hours after the successful submission',
            'lend_total' => 'Please pay all that is owed at one time',
            'money_not_enough' => 'Please ensure that the center has enough money in the account for repayment',
            'lend_success' => 'Payment is successful'
        ],

        'game' => [
            'not_login' => 'Please login first',
            'no_api_code' => 'The API_code parameter is required',
            'api_member_lang_not_equal' => 'The entered interface currency is inconsistent with the member currency',
            'demo_game' => 'The demo account can only enter the system color interface',
            'api_code_not_exist' => 'The interface does not exist, please check',
            'api_code_not_open' => 'The interface is not open, please select another game',
            'operate_fail' => 'Operation failed, MSG please contact customer service',
            'member_api_create_err' => 'Failed to create member API account locally',
            'api_money_not_enough' => 'Interface balance is insufficient, please contact customer service',
            'member_money_not_enough' => 'The account balance is insufficient and cannot be transferred to the interface: Money yuan',
            'api_money_transfer_fail' => 'Failed to deduct the account amount，',
            'api_money_transfer_add_fail' => 'Abnormal operation of adding interface amount after entering the game，',
            'api_money_transfer_back_fail' => '【 :title 】 Abnormal operation of the game interface to refund the account amount，',
            'api_money_transfer_err' => 'Interface failed to enter [:title], error message:',
            'api_money_transfer_success' => 'The interface of [:title] has been successfully transferred',

            'transfer_out_error' => '[:money] Interface balance insufficient, transfer out of the game failed',
            'transfer_out_api_error' => 'Transfer out of the game [:title] interface quota failed, error message:',
            'transfer_out_add_error' => 'After transferring the [:title] interface, the interface amount is deducted and the user account amount is increased. The operation is abnormal:',
            'transfer_out_success' => 'Transfer out 【:title】The game is successful',
            'api_parameter_err' => 'Wrong system parameter',
            'lottery_error' => 'The system color address is wrong, the local lottery function has not been opened, please contact the account holder',
            'lottery_api_not_exist' => 'The system color address is wrong, the local lottery function has not been opened, please contact the account holder',
        ],

        'agent_fd_rates' => [
            'lower_than_system' => 'The rebate point of game type [:game_type] should not be lower than the lowest point set by the system [:rate]',
            'higher_than_system' => 'The rebate point of game type [:game_type] cannot be higher than the highest point set by the system [:rate]',
            'rate_not_set' => 'The rebate point of your game type [:game_type] has not been set, please contact your superior agent or administrator',
            'child_rate_err' => 'The rebate point of the subordinate game type [:game_type] cannot be higher than its own point [:rate]',
            'top_rate_err' => 'The rebate point of game type [:game_type] cannot be lower than the highest point of the subordinate of the agent [:rate]',
            'agent_rate_err' => 'The rebate point of game type [:game_type] cannot be higher than its own point [:rate]',
        ],

        'invite_rate' => [
            'self_rate_err' => 'The return of the invite Registration link [:game_type] type cannot be higher than your own return',
            'lower_than_system' => 'The return point of type invite Registration link [:game_type] cannot be lower than the lowest point set by the system [:rate]'
        ],

        'captcha' => [
            'check_err' => 'Verification code error',
            'out_of_date' => 'The captcha has expired. Please refresh and try again',
        ],

        'task' => [
            'no_task' => 'There are no tasks to complete',
            'task_complete_title' => 'Task completion notice',
            'task_complete_desc' => 'Congratulations on your completion of the task [:title], task reward：',
            'level_up_desc' => 'Members [:name] from [:old_level] to [:level] will be given promotion rewards. The rewards include：“',
            'level_up_award' => 'Promotion rewards',
            'level_up_title' => 'Promotion award issuing notice',
            'level_up_desc' => 'Congratulations on receiving the old_level ~ :level promotion award.',
            'week_award_title' => 'Week salary pay notice',
            'week_award_desc' => 'Congratulations on receiving [:level] weekly salary [$ :money]',
            'month_award_title' => 'Monthly salary payment notice',
            'month_award_desc' => 'Congratulations on receiving [:level] monthly salary [$ :money]'
        ],

        'level_config' => [
            'level_up_award_title' => 'Notice of Promotion Payment',
            'level_up_award_desc' => 'Congratulations on your upgrade【 :level_name】，Upgrade Award【:money money】,Credit Award 【:credit】',
            'level_up_award_msg' => 'Membership【 :name】Collection【 :level】Grade promotion gift【 :money money】,Credit Award 【:credit】',

            'day_bonus_award_title' => 'Daily Payment Notice',
            'day_bonus_award_desc' => 'Congratulations on receiving【 :level Level】Daily gift【 :money money】',
            'day_bonus_award_msg' => 'Member receive【 :level Level】Daily gifts, awards【 :money money】',

            'week_bonus_award_title' => 'Weekly Payment Notice',
            'week_bonus_award_desc' => 'Congratulations on receiving【 :level Level】Weekly gift【 :money money】',
            'week_bonus_award_msg' => 'Member receive【 :level Level】Weekly gifts, awards【 :money money】',

            'month_bonus_award_title' => 'Monthly Payment Notice',
            'month_bonus_award_desc' => 'Congratulations on receiving【 :level Level】Monthly gift【 :money money】',
            'month_bonus_award_msg' => 'Member receive【 :level Level】Monthly gifts, awards【 :money money】',

            'year_bonus_award_title' => 'Annual Gift Grant Notice',
            'year_bonus_award_desc' => 'Congratulations on receiving【 :level level】Annual gift【 :money money】',
            'year_bonus_award_msg' => 'Member receive【 :level Level】Annual gifts, awards【 :money money】',
        ]
    ],

    'configs' => [
        "is_redbag_open" => "Open the red envelope",
        "redbag_min_money" => "Minimum amount of red envelopes",
        "redbag_max_money" => "Maximum amount of red envelopes",
        "redbag_day_times" => "Red envelopes daily",
        "is_daily_bonus_open" => "Is check-in open",
        "is_daily_bonus_auto" => "Check-in is automatic",
        "activity_money_type" => "Type of Type of Wallet",
        "member_fs_money_type" => "Member s Backwater Wallet",
        "is_realtime_fs_mode" => "Turn on Time Backwater Mode",
        "activity_yuebao_plan_enable" => "Opening of the Yu e Bao programme",
        "activity_yuebao_enable" => "Opening of Yu  e Bao",
        "activity_wheel_is_open" => "Turn on the lucky turntable",
        "is_system_maintenance" => "Open system maintenance",
        "system_maintenance_whitelist" => "white list IP system maintenance",
        "site_domain" => "Event Site Domain Name",
        "wap_qrcode" => "Cell APP Download QR Code",
        "wap_app_link" => "Cell phone APP download address",
        "service_link" => "Customer Service Link",
        "kefu_wechat_qrcode" => "WeChat QR Code",
        "site_logo" => "Website Logo",
        "site_logo2" => "Website standby LOGO",
        "kefu_qq" => "Customer QQ",
        "site_email" => "Website",
        "site_slogan" => "Deputy logo of Website",
        "site_pc" => "Computer address",
        "site_mobile" => "Mobile Phone Website",
        "is_scroll_adv_open" => "Whether or not to rolling ad",
        "is_demo_play_open" => "Whether to turn on the trial play function",
        "is_open_register" => "Open Registration Page",
        "activity_jiebei_enable" => "Is it open to borrow",
        "transfer_start" => "Opening of withdrawals",
        "transfer_end" => "Withdrawal deadline",
        "min_transfer" => "Minimum drawdown",
        "max_transfer" => "Maximum withdrawal amount",
        "ml_percent" => "Percentage of yards",
        "ml_drawing_percent" => "Percentage of withdrawal fee when yardage is surplus",
        "daili_active_money" => "Active Member Rate",
        "agent_fd_mode" => "Enables unlimited proxy mode",
        "is_auto_agent" => "Membership registration default is agent",
        "notice_type" => "Reminder mode",
        "yuebao_audio" => "Yu e Bao purchase sound reminder",
        "activity_audio" => "Activity Application Voice Alert",
        "message_audio" => "Voice reminder",
        "member_audio" => "Player Login Sound Alert",
        "drawing_audio" => "Reminders of withdrawals",
        "rechargel_audio" => "recharge sound reminder",
        "agent_apply_audio" => "Application for Agent Unpaid",
        "credit_apply_audio" => "Loan application pending",
        "credit_overdue_audio" => "Late reminder",
        "system_maintenance_message" => "Website maintenance tips",
        "bank_desc" => "Company Profile",
        "site_title" => "Title of website",
        "site_keyword" => "Website keywords",
        "site_name" => "Website name",
        "online_pay_title" => "Online Payment Title",
        "online_pay_desc" => "Introduction to online payment",
        "company_pay_title" => "Title of Company Entry",
        "company_pay_desc" => "Introduction to Company Entry",
        "register_remark" => "Registration Description",
        "register_agreement" => "Registration Agreement",
        "nav_jiechi" => "Hijacking Academy",
        "guideline_desc" => "Simple Line Description",
        "hotgame_desc" => "Hot Game Description",
        "wheel_rule" => "Lucky turntable terms and rules",
        "credit_detail" => "For details of the event",
        "credit_rule" => "Borrowing credit rules",
        "credit_xize" => "Borrowing activity rules",
        "credit_borrow" => "Borrowing instructions",
        "credit_lend" => "Borrow the repayment instructions",
        "levelup_slot_activity" => "Details of Electronic Upgrade Activities",
        "levelup_slot_example" => "Examples of e-upgrade activities",
        "levelup_slot_level" => "Electronic upgrade instructions",
        "levelup_slot_month" => "Electronic Upgrade Monthly Salaries Note",
        "levelup_live_activity" => "Details of Life Upgrade",
        "levelup_live_example" => "Examples of real person upgrades",
        "levelup_live_level" => "Life upgrade instructions",
        "levelup_live_month" => "Real person upgrade monthly salary statement",
        "app_tuiguang" => "Outreach",
        "app_xima" => "Code washing tutorial",
        "app_fanyong" => "Rate of return",
        "app_xima_text" => "Code Description",
        "activity_shengji_enable" => "Is the upgrade active",
        "vip1_is_register_sms_open" => "Open Registration SMS Verification",
        "service_link" => "Customer Service Link",
        "service_line" => "Line",
        "service_line_pic" => "LineTwo-dimensional code",
        "service_phone" => "Telephone",
        "service_phone2" => "Telephone 2",
        "is_backend_google_auth" => "Does the background login open the Google verification code",
        "service_skype" => "Skype",
        "service_telegram" => "Telegram",
        "service_logo_link" => "LOGOJump link",
        "vip1_is_login_captcha_open" => "Whether to open the member login verification code",

        "vip1_lang_default" => "Front-end default language",
        "vip1_lang_fields" => "Front Open Language"
    ],

    'agent_page' => [
        'login' => [
            'username' => 'Username',
            'password' => 'Password',
            'captcha' => 'Captcha',
            'refresh' => 'Refresh',
            'login' => 'Login',
        ],

        'basic' => [
            'main_title' => 'Agency',
        ],

        'title' => [
            'main' => 'Back home',
            'offline' => 'Offline Member',
            'offline_list' => 'Offline list',
            'promote_site' => 'Promotion site',
            'agent_report' => 'Agency statements',
            'recharge_list' => 'Membership Deposit Record',
            'drawing_list' => 'Member withdrawal records',
            'money_log' => 'Offline balance change record',
            'fd_logs' => 'Offline Return Record',
            'game_records' => 'Member s winning or losing statements'
        ],

        'notice' => [
            'traditional_only' => 'Only the traditional agent mode can access this page. At present, it is the national agent mode',
            'allagent_only' => 'Only [National agent] can access this page. It is currently in the mode of traditional agent mode',
            'rate_not_exist' => 'Member rebate information does not exist',
            'direct_rate_modify' => 'You can only modify the directly subordinate points'
        ],

        'desc' => [
            'offline_num' => 'Number of offline members',
            'agent_default_rate' => 'Default rebate of offline agent',
        ],

        'field' => [
            'is_agent' => 'Agent or not',
            'register_at' => 'Registration time',
            'own_rate' => 'Self return',
            'unset' => 'Not set',
            'offline_default_rate' => 'Offline default point',
            'pc_agent_url' => 'PC promotion website',
            'wap_agent_url' => 'WAP promotion website',
            'qrcode_title' => 'Promotion of QR code',
            'time_range' => 'Starting and ending time',

            'total_deposit' => 'Total deposits',
            'recharge_count' => 'Number of deposits',
            'total_drawing' => 'Total withdrawals',
            'drawing_count' => 'Number of withdrawals',
            'dividend_hongli' => 'Bonus amount',
            'dividend_activity' => 'Activity gift',
            'dividend_fs' => 'Backwater',
            'dividend_other' => 'other',
            'total_profit' => 'Total profit',
            'member_win_and_loss' => 'Members win or lose',

            'add_sub' => 'Increase / decrease',
            'fs_center' => 'Backwater / center Wallet',

            'api_name' => 'API interface'
        ],

        'btn' => [
            'set_offline_default' => 'Set default rebate for lower level',
            'qrcode' => 'View QR code'
        ]
    ]
];
