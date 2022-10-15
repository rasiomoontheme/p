<?php

return [
    'common' => [
        'operate' => 'Điều khiển',
        'select_default' => '--Hãy chọn--',
        'page_notice' => '<strong>Lưu ý：</strong> nhấn vào nút làm mới bên phải để làm mới trang này',
        'title' => 'Hệ thống quản lý văn phòng',
        "lang" => "Ngôn ngữ",

        'created_at' => 'Tạo lúc',
        'updated_at' => 'Cập nhật lúc',
        'total' => 'Tổng cộng',
        'count' => 'Số lượng',
        'sum' => 'Tổng số',
        'upload_image' => 'Tải ảnh lên',
        'quick_operate' => 'Thao tác nhanh',

        'member_id' => 'ID thành viên',
        'member_name' => 'Tên thành viên',
        'user_id' => 'ID người dùng',
        'api_id' => 'ID API',
        'agent_id' => 'ID đại lý',
        'top_id' => 'ID cấp trên',
        'game_type' => 'Loại trò chơi',
        'deleted' => 'Đã xóa',

        'login_notice' => 'Thông báo đăng nhập',
        'inner' => 'Bên trong',

        'recharge_list' => 'Danh sách nạp tiền',
        'drawing_list' => 'Danh sách rút tiền',
        'user_info' => 'Thông tin cá nhân',
        'modify_pwd' => 'Thay đổi mật khẩu',
        'lang_title' => 'Ngôn ngữ/ngôn ngữ hệ thống',
        'fix_url' => 'Sửa link ảnh',
        'fix_url_notice' => 'Xác định sửa chữa hình ảnh hoạt động? Địa chỉ trước sửa chữa xin vui lòng điền vào "cấu hình hệ thống - trang chủ tên miền", địa chỉ sau sửa chữa xin vui lòng điền vào mục "APP_URL" của tập tin env; Toàn bộ quá trình mất nhiều thời gian, hãy kiên nhẫn',
        'logout' => 'Thoát',
        'logout_title' => 'Bạn có chắc bạn muốn thoát khỏi hệ thống',
        'user_google' => 'Liên kết mã xác minh Google',
        'color_header' => 'Màu header',
        'color_sidebar' => 'Màu sidebar',
        'no_limit' => "Không giới hạn",
        'lang_notice' => 'Vì mạch hệ thống liên quan đến nhiều ngôn ngữ/đơn vị tiền tệ, bạn cần chọn "ngôn ngữ/đơn vị tiền tệ" trước khi Tìm kiếm dữ liệu',

    ],

    'base' => [
        'add_success' => 'Dữ liệu mới được thêm vào thành công',
        'add_fail' => 'Không thể thêm dữ liệu mới',
        'update_success' => 'Cập nhật dữ liệu thành công',
        'update_fail' => 'Không cập nhật được dữ liệu',
        'delete_success' => 'Đã xóa',
        'delete_fail' => 'Gỡ bỏ không thành công',
        'save_success' => 'Lưu thành công',
        'save_fail' => 'Lưu không thành công',
        'operate_success' => 'Hoạt động thành công',
        'operate_fail' => 'Thao tác không thành công, vui lòng thử lại',
        'operate_msg' => 'Thao tác không thành công:',
        'batch_add_success' => 'Thêm hàng loạt thành công',
        'batch_add_fail' => 'Thêm hàng loạt không thành công',

        'account_forbidden' => 'Tài khoản bị vô hiệu hóa',
        'login_success' => 'Đăng nhập thành công',
        'illegal_operation' => 'Hoạt động bất hợp pháp',
        'item_select_required' => 'Vui lòng chọn cột cần được thao tác',
    ],

    'upload' => [
        'file_type_error' => 'Không thể nhận dạng loại tập tin',
        'file_size_error' => 'Tệp tải lên quá lớn để tải lên',
        'image_file_required' => 'Vui lòng chọn ảnh cần tải lên',
        'image_ext_required' => 'Vui lòng tải lên tệp ở định dạng hình ảnh',
        'file_required' => 'Vui lòng chọn tệp cần tải lên',
        'file_ext_error' => 'Vui lòng tải lên tệp ở định dạng được chỉ định',
        'image_size_get_error' => 'Lỗi lấy kích thước tệp',
        'file_delete_error' => 'Lỗi xóa tập tin',
        'file_upload_success' => 'Tải lên tập tin thành công'
    ],

    'notice' => [
        'recharge_title' => 'Danh sách nạp tiền',
        'recharge_notice' => '<p>Bạn có <span id="rechargeNum" data-name="rechargel_audio" data-sec="0" >0</span> yêu cầu chuyển tiền chưa được xử lý',
        'drawing_title' => 'Danh sách rút tiền',
        'drawing_notice' => '<p>Bạn có <span id="drawingNum" data-name="drawing_audio" data-sec="2">0</span> yêu cầu rút tiền chưa được xử lý',
        'message_title' => 'Danh sách thư trong nhà ga',
        'message_notice' => '<p>Bạn có <span id="messageNum" data-name="message_audio" data-sec="4">0</span> danh sách các lá thư chưa được xử lý trong trạm',
        'memberagentapplies_title' => 'Danh sách ứng viên hội viên',
        'memberagentapplies_notice' => '<p>Bạn có <span id="agentAppliesNum" data-sec="6" data-name="agent_apply_audio">0</span> ứng dụng đại lý chưa được xử lý',
        'members_title' => 'Danh sách thành viên',
        'members_notice' => '<p>Bạn có <span id="memberNum" data-name="member_audio">0</span> nhớ đăng nhập của một thành viên cụ thể',
        'activityapplies_title' => 'Ứng dụng hoạt động thành viên',
        'activityapplies_notice' => '<p>Bạn có <span id="activityNum" data-name="activity_audio">0</span> ứng dụng hoạt động thành viên',
        'memberyuebaoplans_title' => 'Danh sách hồ sơ mua yu ebao thành viên',
        'memberyuebaoplans_notice' => '<p>Bạn có <span id="yuebaoNum" data-name="yuebao_audio">0</span> lưu ý mua yu ebao',
        'creditpayrecord_title' => 'Mượn danh sách hồ sơ',
        'creditpayrecord_notice' => '<p>Bạn có <span id="creditAppliesNum" data-name="credit_apply_audio">0</span> mượn đơn nhắc nhở',
        'creditpayrecord_overdue_title' => 'Mượn danh sách hồ sơ',
        'creditpayrecord_overdue_notice' => '<p>Bạn có <span id="creditOverdueNum" data-name="credit_overdue_audio">0</span> mượn quá hạn nhắc nhở'
    ],

    'btn' => [
        'add' => 'Thêm',
        'batch_delete' => 'Loại bỏ hàng loạt',
        'batch_add' => 'Thêm hàng loạt',
        'search' => 'Tìm kiếm',
        'reset' => 'Đặt lại',
        'edit' => 'Chỉnh sửa',
        'detail' => 'Chi tiết',
        'delete' => 'Xoá',
        'refresh' => 'Tải lại',
        'collapse' => 'Thu gọn',
        'back' => 'Trở về',
        'save' => 'Lưu',
        'export' => 'Xuất',

        'title' => 'Tiêu đề',
        'content' => 'Nội dung'
    ],

    'index' => [
        'title' => 'Tiêu đề',
        'today_register' => 'Đăng ký hôm nay',
        'today_free' => 'Chi phí tiếp thị hôm nay',
        'today_bet' => 'Người chơi đặt cược vào ngày hôm nay',
        'today_game_profit' => 'Tổng doanh thu trò chơi ngày hôm nay',
        'month_register' => 'Số người đăng ký tháng này',
        'month_free' => 'Chi phí tiếp thị tháng này',
        'month_bet' => 'Người chơi đặt cược vào tháng này',
        'month_game_profit' => 'Tổng doanh thu trò chơi trong tháng này',
        '10_days_recharge' => '10 ngày cuối cùng nạp tiền hồ sơ',
        '10_days_drawing' => 'Hồ sơ rút tiền 10 ngày qua',
        'welcome' => 'Bạn được chào đón，',
        'recharge_title' => 'Nạp tiền',
        'drawing_title' => 'Rút tiền',

        'site_domain_required' => 'Hãy chắc chắn rằng【Cấu hình hệ thống - Tên miền chính của trang web】Điền URL trước khi thay thế',
        'app_url_required' => 'Hãy đảm bảo rằng nó nằm trong thư mục gốc của trang web".env"Tài liệu của APP_URL Điền vào trường với URL đã thay thế',
        'url_same_error' => 'URL nhất quán trước và sau khi thay thế, vui lòng kiểm tra',
    ],

    'member' => [
        'field' => [
            "name" => "Tên người dùng",
            "password" => "Mật khẩu",
            "original_password" => "Mật khẩu API",
            "o_password" => "Mật khẩu gốc",
            "nickname" => "Tên đăng nhập",
            "realname" => "Tên thật",
            "email" => "email",
            "phone" => "Điện thoại",
            "qq" => "Số QQ",
            "gender" => "Giới tính",
            "invite_code" => "Mã mời",
            "qk_pwd" => "Mật khẩu rút tiền",
            "money" => "Tài khoản chính",
            "fs_money" => "Số dư hoàn trả",
            "total_money" => "Tổng số tiền đặt cược vào nền tảng",
            "ml_money" => "Mã số dư",
            "score" => "Tỉ lệ",
            "total_credit" => "Tổng tín dụng",
            "used_credit" => "Tín dụng đã dùng",
            "register_ip" => "Đăng ký IP.",
            "register_area" => "Khu vực đăng ký",
            "register_site" => "Kênh đăng ký",
            "status" => "Trạng thái",
            "bet_status" => "Trạng thái đặt cược",
            "is_tips_on" => "Bật gợi ý đăng nhập hay không",
            "is_in_on" => "Tài khoản nội bộ",
            "top_id" => "ID đại diện cấp cao.",
            "agent_id" => "ID đại lý.",
            "level" => "VIP.",
            "is_demo" => "Tài khoản thử nghiệm",

            "is_online" => "Trực tuyến",
            "lang" => "Ngôn ngữ",
            "player_name" => "Tên người chơi",
            "game_type" => "Loại trò chơi",
            "api_name" => "Tên trò chơi",
            "bet" => "Số tiền cược",
            "payout" => "Số tiền được thanh toán",
            "bet_start_time" => "Thời gian bắt đầu đặt cược",
            "bet_end_time" => "Thời gian kết thúc cược",
            "result_bet_status" => "Trạng thái đặt cược",
        ],

        'index' => [
            'title' => 'Danh sách thành viên',
            'is_agent_and_top_agent' => 'Đại lý/cấp trên',
            'last_ip' => 'IP vừa đăng nhập.',
            'title_modify_money' => 'Thay đổi số dư thành viên',
            'title_assign_agent' => 'Thiết lập là đại lý',
            'title_assign_member_agent' => 'Thiết lập tài khoản [:name] là đại lý',
            'title_modify_top' => '4/5000
Phân phối các đại lý',
            'title_modify_member_top' => 'Đại lý cấp trên của tài khoản [:name]'
        ],
        'edit' => [
            'title_edit' => 'Sửa đổi thành viên',
            'title_create' => 'Tạo thành viên mới',
            'is_tips_on_notice' => 'Âm thanh thông báo đăng nhập',
            'is_in_on_notice' => 'Tắt thống kê thắng/thua của thành viên'
        ],

        'member_apis' => [
            'title' => 'Giao diện thành viên',
            'api_title' => 'Tên giao diện',
            'money' => 'Tiền',
            'null' => 'Rỗng',
            'refresh' => 'Làm mới',
            'recycle' => 'Xóa tạm bằng một cú nhấp chuột',
        ],

        'modify_money' => [
            'title' => 'Sửa giới hạn thành viên',
            'is_add_ml' => 'Đồng thời tăng kích thước',
            'is_add_ml_notice' => 'Tăng tỷ lệ tham khảo "cấu hình hệ thống" - "đại lý liên quan" - "phần trăm rút tiền"',
        ],

        'modify_top' => [
            'notice' => '<strong>Lưu ý:</strong> Tài khoản này không được thiết lập trước khi điểm trở lại, sau khi cấp trên sẽ tự động cấp điểm điểm trở lại theo tài khoản cấp trên được chỉ định'
        ],

        'money_report' => [
            'title' => 'Báo cáo tài chính',
            'notice' => '<strong>Chú ý:</strong> tích cực cho lợi nhuận nền tảng, tiêu cực cho thất bại nền tảng',
            'created_at' => 'Tạo lúc',
            'is_agent_and_top_agent' => 'Đại lý/cấp trên',
            'recharge_count' => 'Số tiền nạp',
            'drawing_count' => 'Số tiền rút',
            'recharge_sum' => 'Tổng nạp',
            'drawing_sum' => 'Tổng rút',
            'total_fs' => 'Tổng hoàn trả',
            'total_dividend' => 'Tổng lợi tức',
            'total_other' => 'Tổng số khác',
            'total_profit' => 'Tổng số lợi nhuận và thô lỗ',

            'profit_formula_notice' => 'Tính toán chi phí và công thức và hướng dẫn',
            'profit_formula' => 'Nạp tiền - rút tiền - hoàn trả - lợi tức - còn lại = lợi tức thực tế',
            'yinli' => 'Lợi nhuận：',
            'kuisun' => 'Lôi kéo：'
        ],

        'msg' => [
            'money_negative_error' => 'Số tiền sửa đổi là tiêu cực, kiểm tra',
            'password_at_least_6' => 'Độ dài mật khẩu ít nhất là sáu chữ số',
            'balance_error' => 'Truy vấn số dư không thành công, thông báo lỗi:',
            'offline_success' => 'Thành viên đã được【 :name 】 ở tuyến dưới',
            'member_offlined' => 'Các thành viên【 :name 】Hiện đã ngoại tuyến',
        ]
    ],

    'member_bank' => [
        'field' => [
            "member_id" => "ID thành viên",
            "card_no" => "Số thẻ",
            "bank_type" => "Ngân hàng",
            "bank_type_text" => "Tên ngân hàng",
            "phone" => "Số điện thoại",
            "owner_name" => "Tên chủ thẻ",
            "bank_address" => "Địa chỉ ngân hàng",
            "remark" => "Ghi chú hoạt động",
        ],

        'index' => [
            'title' => ''
        ]
    ],

    'agent' => [
        'field' => [
            "member_id" => "ID Thành viên",
            "agent_pc_uri" => "Liên kết máy tính đại lý",
            "agent_wap_uri" => "Liên kết WAP proxy",
            "agent_real_pc_url" => "Liên kết máy tính đại lý",
            "agent_real_wap_url" => "Liên kết WAP proxy",
            "agent_uri_pre" => "Tiền tố liên kết proxy",
            "apply_data" => "Thông tin ứng dụng",
            "remark" => "Ghi chú",
        ],

        'assign' => [
            'notice' => 'Số proxy trước đó của thành viên đã bị xóa, vui lòng chọn tạo lại proxy hoặc tiếp tục sử dụng tài khoản proxy cũ'
        ],

        'index' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Để tạo đại lý mới, vui lòng【Danh sách thành viên】Thiết lập thành viên để trở thành đại lý',
            'btn_fd_rate' => 'hoàn trả',
            'title_fd_rate' => 'Cơ quan :name hoàn trả',
            'btn_fd_record' => 'Hồ sơ điểm ngược',
            'title_fd_record' => 'Cơ quan :name Hồ sơ điểm ngược',
        ],

        'msg' => [
            'assign_type_required' => 'Vui lòng chọn chế độ phân phối',
            'assign_operate_error' => 'Lỗi phân bổ đại lý:',
            'assign_operate_success' => 'Đại lý phân phối thành công',
        ]
    ],

    'user' => [
        'field' => [
            "name" => "Tên người dùng",
            "password" => "Mật khẩu",
            "status" => 'Trạng thái',
            "create_ip" => "Tạo IP",
            "google_secret" => "Mã xác minh Google",
            "is_google_secret" => "Có bật mã xác minh của Google hay không",
        ],

        'status' => [
            1 => 'Bình thường.',
            -1 => 'Ban'
        ],

        'index' => [
            'btn_assgin' => 'Phân công vai trò'
        ],

        'modify_pwd' => [
            'oldpassword' => 'Mật khẩu gốc',
            'password' => 'Mật khẩu mới',
            'password_confirmation' => 'Xác nhận mật khẩu mới',
        ],

        'assign' => [
            'role' => '角色'
        ],

        'msg' => [
            'oldpassword_error' => 'Mật khẩu gốc sai, vui lòng kiểm tra',
            'modify_success_login' => "Thay đổi mật khẩu thành công, vui lòng đăng nhập lại",
            'modify_error' => 'Thay đổi mật khẩu không thành công',
            'assign_success' => 'Thành công trong việc phân công vai trò',
            'assign_fail' => 'Phân công vai trò không thành công',
        ],

        'login' => [
            'google_auth_error' => 'Lỗi điền mã xác minh Google',
        ],

        'google' => [
            'first_notice' => 'Đối với xác nhận đầu tiên, vui lòng sử dụng Google Xác thực APP để quét trực tiếp mã QR, nhập mã xác minh của Google trên điện thoại, sau đó gửi xác nhận;',
            'reset_notice' => 'Bạn đã liên kết mã xác minh của Google, nếu bạn cần liên kết lại, vui lòng liên hệ với quản trị viên',
            'scan_qrcode' => 'Quét mã xác thực',
            'secret_notice' => 'Vui lòng nhập mã xác minh của Google trên điện thoại của bạn sau khi quét mã',
            'submit' => 'Gửi xác nhận',
            'reset_own_error' => 'Không thể đặt lại tài khoản của bạn, vui lòng liên hệ với quản trị viên chính',
            'reset_btn' => 'Đặt lại mã xác minh Google',
            'reset_message' => 'Bạn có chắc chắn muốn đặt lại mã xác minh Google cho tài khoản này không?',
        ]
    ],

    'role' => [
        'field' => [
            'name' => 'Tên người dùng',
            'description' => 'Mô tả',
        ],

        'index' => [
            'btn_assign' => 'Phân công thẩm quyền',
        ],

        'assign' => [
            'permission' => 'Quyền hạn',
            'check_all' => 'Lựa chọn đầy đủ'
        ],

        'msg' => [
            'assign_success' => 'Việc giao quyền thành công',
            'assign_fail' => 'Phân bổ quyền không thành công',
        ]
    ],

    'permission' => [
        'field' => [
            'name' => 'Tên quyền',
            'icon' => 'Biểu tượng',
            'pid' => 'Người chaID',
            'route_name' => 'NAME OF TRANSLATORS',
            'weight' => 'Trọng lượng',
            'description' => 'Mô tả',
            'remark' => 'Ghi chú',
            'is_show' => 'Cho dù hiện'
        ],

        'is_show' => [
            0 => 'Không thể hiện',
            1 => 'Hiện'
        ],

        'index' => [
            'btn_child' => 'Tạo quyền phụ',
        ],

        'msg' => [
            'lang_json_error' => 'Lỗi điền tên quyền đa ngôn ngữ'
        ]
    ],

    'black_ip' => [
        'field' => [
            "ip" => "IPĐịa chỉ",
            "is_open" => "Có mở hay không",
            "remark" => "Thông tin nhận xét",
        ]
    ],

    'apis' => [
        'field' => [
            "api_id" => "API ID",
            "api_name" => "Nhận diện nền tảng",
            "api_title" => "Mô tả nền tảng Name",
            "api_money" => "Số dư giao diện",
            "prefix" => "Tiền tố tài khoản",
            "is_open" => "Mở",
            "lang" => "Tiền tệ",
            "lang_list" => "Ngôn ngữ hỗ trợ",
            "weight" => "Trọng lượng",
            "remark" => "Ghi chú",
            'icon_url' => 'Biểu tượng thanh bên điện tử',
            'logo_url' => 'pc máy tính thả xuống logo hiển thị'
        ],

        'index' => [
            'top_title' => 'API Cấu hình giao diện cơ bản',
            'api_domain' => 'Tên miền cơ bản',
            'api_prefix' => 'Tiền tố',
            'btn_refresh' => 'Làm mới số dư giao diện',
            'config_title' => 'Cấu hình cơ bản của trang web',
        ],

        'msg' => [
            'no_need_update_game' => 'Không có trò chơi nào cần cập nhật',
            'update_game_success' => 'Cập nhật thành công【 :update_count 】Dữ liệu trò chơi，Thành công mới【 :create_count】Dữ liệu trò chơi',
        ]
    ],

    'api_game' => [
        'field' => [
            "title" => "Tiêu đề trò chơi",
            "subtitle" => "Phụ đề",
            "web_pic" => "Hình ảnh phía máy tính",
            "mobile_pic" => "Hình ảnh điện thoại di động",
            "api_name" => "Nhận dạng giao diện",
            "class_name" => "Nhận diện kiểu dáng",
            "game_type" => "Các loại trò chơi",
            "params" => "Các thông số",
            "client_type" => "Nền tảng điều hành",
            "is_open" => "Cho dù mở",
            "weight" => "Trọng lượng",
            "tags" => "Nhãn",
            "lang" => "Ngôn ngữ",
            "remark" => "Ghi chú",
        ],

        'index' => [
            'top_notice' => 'Trò chơi hiển thị văn bản Trong những sửa đổi như vậy',
            'btn_update' => 'Cập nhật trò chơi',
            'web_pic_notice' => '【Điện tử】Hình ảnh đã phân loại tương ứng với danh sách trò chơi Logo'
        ],

        'mobile_category' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Sau khi hoạt động, nó cần được lưu để có hiệu lực',
            'web_title' => 'Điều hướng và sắp xếp trang chủ máy tính',
            'key' => 'Nhận diện',
            'name' => 'Tên gọi',
            'weight' => 'Trọng lượng',
        ]
    ],

    'game_list' => [
        'field' => [
            "api_name" => "Nhận dạng giao diện",
            "name" => "Tên tiếng Trung của trò chơi",
            "en_name" => "Tên tiếng Anh",
            "game_type" => "Các loại trò chơi",
            "game_code" => "ID trò chơi",
            "tcg_game_type" => "Thể loại trò chơi TCG",
            "param_remark" => "Bổ sung thông số",
            "img_path" => "Đường dẫn hình ảnh",
            "img_url" => "Địa chỉ hình ảnh",
            "client_type" => "Nền tảng điều hành",
            "platform" => "Hỗ trợ môi trường",
            "is_open" => "Cho dù mở cửa",
            "weight" => "Trọng lượng",
            "tags" => "Nhãn",
        ]
    ],

    'game_hot' => [
        'field' => [
            "name" => "Tên sảnh",
            "api_name" => 'Tên giao diện',
            "desc" => "Mô tả sảnh",
            "en_name" => "Tên sảnh[AnhName]",
            "en_desc" => "Mô tả sảnh[AnhName]",
            "tw_name" => "Tên sảnh[Nhiều]",
            "tw_desc" => "Mô tả sảnh[Nhiều]",
            "th_name" => "Tên sảnh[Thái]",
            "th_desc" => "Mô tả sảnh[Thái]",
            "vi_name" => "Tên sảnh[Việt]",
            "vi_desc" => "Mô tả sảnh[Việt]",
            "icon_path" => "Trước khi chọn icon",
            "icon_path2" => "Sau khi chọn icon",
            "img_url" => "Địa chỉ hình",
            "game_code" => "Tham số trò chơi",
            "is_online" => "Lên mạng hay không",
            "sort" => "chuẩn",
            'game_type' =>'Kiểu trò chơi',
            'type' =>'Kiểu vị trí',
            "lang" => "Ngôn ngữ",
            'jump_link' =>'Cột link',
            'jump_link_p' => 'Nếu bạn nhập trực tiếp trò chơi, bạn không cần phải điền vào',
            'icon_path2_p' => 'Nếu bạn chọn vị trí của hạng game nhà, bạn không cần phải tải lên',
            'is_new_window' => 'Có mở trong một cửa sổ mới không'
        ],
        'hot_game_place_type' => [
            1 => 'Trò chơi bình dân',
            2 => 'Hạng game nhà'
        ],
    ],

    'admin_log' => [
        'field' => [
            'user_id' => 'Quản trị viên ID',
            'user_name' => 'Tên người dùng quản trị viên',
            'url' => 'Địa chỉ hoạt động',
            'data' => 'Dữ liệu hoạt động',
            'ip' => 'Hoạt động IP',
            'address' => 'Địa chỉ IP thực',
            'ua' => 'Môi trường hoạt động',
            'type' => 'Loại hình hoạt động',
            'type_text' => 'Mô tả loại hoạt động',
            'description' => 'Mô tả hoạt động',
            'remark' => 'Ghi chú hoạt động',
        ],

        'title' => [
            'login_title' => 'Nhật ký đăng nhập quản trị viên',
            'logout_title' => 'Nhật ký đăng xuất của quản trị viên',
            'operate_title' => 'Nhật ký hoạt động của quản trị viên',
            'system_title' => 'Nhật ký ngoại lệ hệ thống'
        ],

        'type' => [
            '1' => 'Đăng nhập nền',
            '2' => 'Đăng xuất trong nền',
            '3' => 'Hoạt động nền',
            '4' => 'Sự bất thường của hệ thống'
        ]
    ],

    'member_log' => [
        'field' => [
            "member_id" => "ID thành viên",
            "ip" => "Hoạt động IP",
            "address" => "Địa chỉ IP thực",
            "ua" => "Môi trường hoạt động",
            "type" => "Loại hình hoạt động",
            "description" => "Mô tả hoạt động",
            "remark" => "Ghi chú",
        ]
    ],

    'member_agent_apply' => [
        'field' => [
            "member_id" => "ID thành viên",
            "name" => "Tên thật",
            "phone" => "Số điện thoại",
            "email" => "Thư điện tử",
            "msn_qq" => "Thông tin liên hệ MSN/QQ",
            "reason" => "Lý do áp dụng",
            "status" => "Tình trạng ứng dụng",
            "fail_reason" => "Nguyên nhân thất bại",
            "assign_type" => "Mô hình phân phối"
        ],

        'index' => [
            'btn_deal' => 'Việc xử lý'
        ],

        'msg' => [
            'saved_cannot_modify' => 'Các ứng dụng đã được xem xét không được phép sửa đổi',
            'update_and_fill_data' => 'Cập nhật dữ liệu thành công, vui lòng điền thông số proxy',
        ],
    ],

    'agent_fd_rate' => [
        'field' => [
            "parent_id" => "ID tác nhân cha",
            "member_id" => "ID thành viên hiện tại",
            "game_type" => "Các loại trò chơi",
            "type" => "Loại điểm",
            "rate" => "Tỷ lệ điểm trở lại(%)",
            "remark" => "Ghi chú",
        ],

        'agent' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Tác nhân chưa đặt điểm ngược',
            'operate_total' => 'Đặt điểm thống nhất',
            'btn_apply' => 'Ứng dụng',
            'title' => 'Thiết lập cơ quan【 :name 】Điểm hoàn',
            'system_highest' => 'Điểm cao nhất của hệ thống',
            'system_lowest' => 'Điểm thấp nhất của hệ thống',
            'system_default' => 'Điểm mặc định của hệ thống',
            'quick_notice' => 'Vui lòng nhập giá trị của điểm đặt thống nhất'
        ],

        'system' => [
            'highest_title' => 'Điểm trả lại cao nhất mặc định của tác nhân',
            'lowest_title' => 'Điểm trả lại tối thiểu mặc định của tác nhân',
            'default_title' => 'Điểm trả lại mặc định cho tác nhân tạo hệ thống',
        ],

        'msg' => [
            'system_highest_error' => 'Loại trò chơi hệ thống【 :game_type 】Điểm hoàn trả cao nhất thấp hơn điểm hoàn trả thấp nhất của loại này, vui lòng kiểm tra',
            'system_lowest_error' => 'Loại trò chơi hệ thống【 :game_type 】Của điểm hoàn trả thấp nhất cao hơn điểm hoàn trả cao nhất của loại hình này, kiểm tra',
        ],
    ],

    'agent_fd_money_log' => [
        'field' => [
            "member_id" => "ID thành viên người chơi",
            "member_rate" => "Tỷ lệ điểm trả lại của người chơi(%)",
            "agent_member_id" => "Cơ quanID",
            "agent_member_rate" => "Tỷ lệ chiết khấu đại lý(%)",
            "child_member_id" => "Thành viên cấp dướiID",
            "child_member_rate" => "Tỷ lệ điểm trở lại của thành viên cấp dưới(%)",
            "game_type" => "Các loại trò chơi",
            "bet_amount" => "Số tiền đặt cược",
            "fd_money" => "Số tiền trả lại",
            "money_before" => "Số dư trước nhật ký",
            "money_after" => "Số dư sau nhật ký",
            "remark" => "Ghi chú",
        ]
    ],

    'daily_bonus' => [
        'field' => [
            "member_id" => "Id thành viên",
            "bonus_money" => "Số tiền thưởng đăng nhập",
            "days" => "Ngày cài đặt đăng nhập",
            "serial_days" => "Số ngày đăng nhập liên tiếp",
            "total_days" => "Số ngày đăng nhập tích lũy",
            "type" => "Các loại",
            "state" => "Bang",
            "remark" => "Ghi chú",
            "lang" => "Ngôn ngữ/Đơn vị tiền tệ"
        ],

        'record' => [
            'btn_confirm' => 'Việc kiểm toán thông qua',
            'notice_confirm' => 'Xác nhận đơn đăng ký giải thưởng thông qua thành viên?',
            'btn_reject' => 'Kiểm toán không đạt',
            'notice_reject' => 'Bạn có chắc chắn từ chối đơn đăng nhập giải thưởng của thành viên không?',
        ],

        'setting' => [
            'deposit' => 'Số tiền gửi trong ngày',
            'valid_num' => 'Dòng chảy hiệu quả (bội số)',
            'times' => 'Số lần bốc thăm trúng thưởng',
            'is_open' => 'Bật hay không',
            'currency' =>'Tiền tệ',
            'min' => 'Thưởng thấp nhất',
            'max' => 'Thưởng cao nhất',
        ],

        'msg' => [
            'same_day_error' => 'Phần thưởng đăng nhập cho cùng một số ngày cài đặt đăng nhập đã được thiết lập, vui lòng kiểm tra'
        ]
    ],

    'game_record' => [
        'field' => [
            "billNo" => "Số hóa đơn",
            'game_name' => 'Tên trò chơi',
            "api_name" => "Nhận dạng giao diện",
            "name" => "Tài khoản người chơi",
            "gameType" => "Các loại trò chơi",
            "status" => "Tình trạng giải quyết",
            "betTime" => "Thời gian cá cược",
            "betAmount" => "Số tiền đặt cược",
            "validBetAmount" => "Số tiền đặt cược hợp lệ",
            "netAmount" => "Số tiền trúng thưởng",
            "roundNo" => "Thông tin phiên",
            "playDetail" => "Chi tiết cách chơi",
            "wagerDetail" => "Chi tiết đặt cược",
            "gameResult" => "Kết quả xổ số",
            "is_fd" => "Điểm quay lại hay không",

            "shuyinAmount" => "Số tiền thắng thua"
        ],

        'index' => [
            'btn_send_fd' => 'Trả lại',
            'notice_send_fd' => 'Bạn có chắc chắn về việc phát hành chuyển ví của lịch sử trò chơi không?',

        ]
    ],

    'member_wheel' => [
        'field' => [
            "member_id" => "Id thành viên",
            "user_id" => "ID quản trị viên",
            "award_id" => "ID giải thưởng",
            "award_desc" => "Mô tả giải thưởng",
            "status" => "Tình trạng nhận",
        ],

        'index' => [
            'btn_send' => 'Xác nhận việc cấp',
            'notice_send' => 'Bạn có chắc chắn thực hiện xử lý phân phối xác nhận không?'
        ],

        'setting' => [
            'deposit' => 'Số tiền gửi trong ngày',
            'valid_num' => 'Dòng chảy hiệu quả (bội số)',
            'times' => 'Số bàn xoay',
            'awards' => 'Có thể trúng giải',
            'is_open' => 'Bật hay không'
        ]
    ],

    'system_notice' => [
        'field' => [
            "title" => "Tiêu đề",
            "content" => "Nội dung",
            "text_content" => "APP Nội dung",
            "group_name" => "Tên nhóm",
            "weight" => "Trọng lượng",
            "url" => "Liên kết",
            "is_open" => "Bật hay không",
            "lang" => "Ngôn ngữ",
        ],

        'index' => [
            'app_title' => 'Danh sách thông báo của APP'
        ],

        'edit' => [
            'notice_group' => 'Nhóm đã có:'
        ]
    ],

    'system_config' => [
        'config_groups' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Nó sẽ có hiệu lực nếu nó cần được lưu sau khi hoạt động;Bạn cần nhấp vào văn bản nút làm mới ở bên phải để làm mới trang này',
            'system' => 'Liên quan đến hệ thống',
            'service' => 'Dịch vụ khách hàng',
            'line' => 'Line',
            'site' => 'Tên trang web',
            'activity' => 'Các hoạt động liên quan',
            'recharge' => 'Liên quan đến thanh toán',
            'drawing' => 'Liên quan đến việc rút tiền',
            'agent' => 'Cơ quan liên quan',
            'notice' => 'Nhắc nhở những người có liên quan',
            'group_notice' => '<strong>Chú ý đến：</strong> Sau khi nội dung của trang được lưu, toàn bộ trang cần được làm mới để có hiệu lực',
            'btn_choose' => 'Chọn tập tin',
            'btn_preview' => 'Xem thử',
            'register'	=> 'Đăng ký',
        ],

        'app_content' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Nó sẽ có hiệu lực nếu nó cần được lưu sau khi hoạt động',
            'app_content' => 'Nội dung liên quan'
        ],

        'config_content' => [
            'register' => 'Đăng ký liên quan',
            'navigate' => 'Liên quan đến điều hướng',
            'activity_about' => 'Các hoạt động liên quan',
            'credit' => 'Mượn liên quan',
            'levelup_slot' => 'Nâng cấp điện tử',
            'levelup_live' => 'Nâng cấp người thật'
        ],
    ],

    'banner' => [
        'field' => [
            "id" => "ID",
            "title" => "Tiêu đề",
            "description" => "Mô tả",
            "url" => "Địa chỉ",
            "dimensions" => "Chiều rộng và chiều cao",
            "groups" => "Việc phân nhóm",
            "weight" => "Trọng lượng",
            "lang" => "Ngôn ngữ",
            "is_open" => "Có bật hay không",
            "created_at" => "Thời gian tạo",
            "updated_at" => "Thời gian cập nhật",
        ],

        'index' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Bản ghi tải lên và tệp trong "Quản lý tệp đính kèm" sẽ không bị xóa khi xóa biểu đồ băng chuyền trong danh sách;Kích thước tham khảo：webKích thước bản vẽ bánh xe cuối【1920*418】，h5Kết thúc【750*350】',
        ],

        'edit' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Vui lòng giữ nguyên kích thước của cùng một nhóm ảnh',
            'group_notice' => 'Vui lòng điền vào biểu đồ băng chuyền điện thoại di động“mobile1”,PC Vui lòng điền vào bản đồ băng chuyền“new1”'
        ]
    ],

    'about' => [
        'field' => [
            "id" => "ID",
            "title" => "Tiêu đề",
            "subtitle" => "Phụ đề",
            "cover_img" => "Ảnh bìa",
            "content" => "Nội dung",
            "type" => "Các loại",
            "is_open" => "Cho dù mở",
            "is_hot" => "Cho dù nóng",
            "weight" => "Trọng lượng",
            "lang" => "Ngôn ngữ",
        ]
    ],

    'sport' => [
        'field' => [
            "home_team_name" => "Tên đội chủ nhà",
            "home_team_name_en" => "Tên đội chủ nhà bằng tiếng Anh",
            "home_team_img" => "Hình ảnh đội chủ nhà",
            "home_odds" => "Tỷ lệ cược của đội chủ nhà",
            "visiting_team_name" => "Tên đội khách",
            "visiting_team_name_en" => "Tên đội khách bằng tiếng Anh",
            "visiting_team_img" => "Hình ảnh đội khách",
            "visiting_odds" => "Tỷ lệ cược của đội khách",
            "let_ball" => "Để quả bóng",
            "match_cup" => "Tên cuộc thi",
            "match_cup_en" => "Tên cuộc thi bằng tiếng Anh",
            "match_at" => "Thời gian thi đấu",
            "is_open" => "Có bật hay không",
            "weight" => "Trọng lượng",
        ]
    ],

    'level_config' => [
        'field' => [
            "level" => "Mức độ",
            "level_name" => "Tên cấp bậc",
            "deposit_money" => "Số tiền gửi khuyến mại",
            "bet_money" => "Số tiền cá cược khuyến mại",
            "level_bonus" => "Quà khuyến mãi",
            "day_bonus" => "Quà tặng hàng ngày",
            "week_bonus" => "Quà tặng hàng tuần",
            "month_bonus" => "Quà tặng hàng tháng",
            "year_bonus" => "Hằng năm, tiền quà",
            "credit_bonus" => "Mượn phần thưởng hạn ngạch",
            "levelup_type" => "Loại điều kiện khuyến mại",
            "lang" => "Ngôn ngữ/Đơn vị tiền tệ",
        ]
    ],

    'payment' => [
        'field' => [
            "desc" => "Mô tả phương thức thanh toán",
            "account" => "Tài khoản thu tiền",
            "type" => "Phương thức thanh toán",
            "name" => "Tên người nhận tiền",
            "qrcode" => "Thanh toán mã QR",
            "memo" => "Ghi chú thanh toán",
            "rate" => "Tỷ lệ quà tặng",
            "min" => "Số tiền nạp tiền tối thiểu",
            "max" => "Số tiền nạp tiền tối đa",
            "forex" => "Tỷ trọng giao dịch",
            "lang" => "Ngôn ngữ/Đơn vị tiền tệ",
            "is_open" => "Có bật hay không",

            "detail" => "Thông tin chi tiết",
            "range" => "Hạn mức một lần",
            "bank_type" => "Các loại hình ngân hàng",
            "bank_address" => "Địa chỉ ngân hàng mở tài khoản",
            "account_id" => "Số thương nhân của bên thứ ba",
            "key" => "Khóa của bên thứ ba",
            "url" => "URL thanh toán của bên thứ ba",
            "api" => "Biểu trưng thanh toán của bên thứ ba",
            "paytype" => "Mã loại thanh toán của bên thứ ba",
            "usdt_type" => "USDT Các loại",
            "usdt_rate" => "Tỷ giá hối đoái USDT",
            "usdt_num" => "Số lượng tiền USDT"
        ],

        "index" => [
            'top_notice' => 'Vui lòng tham khảo tiêu đề và thông tin giới thiệu của trang phương thức gửi tiền tại【Cấu hình hệ thống】 - 【Nhóm cấu hình hệ thống】 - 【Liên quan đến thanh toán】 Cấu hình trong'
        ],

        "edit" => [
            "notice_memo" => "Thông tin nhận xét cần điền khi thanh toán",
            "notice_range" => "Khi số tiền nạp tối thiểu và tối đa đều bằng 0, có nghĩa là không giới hạn số tiền nạp",
            "notice_min_max" => "Số tiền nạp tiền tối thiểu và số tiền nạp tiền tối đa được tính bằng số tiền nền tảng",
            "notice_forex" => "Cần bao nhiêu tiền để đổi số tiền nền tảng với số lượng 1，Được liệt kê như sau: 10 RMB đổi số tiền nền tảng là 1，Bên dưới\"Ngôn ngữ/Đơn vị tiền tệ\"Chọn tiếng Trung, điền 10 cho tỷ lệ giao dịch",
        ],

        'msg' => [
            'account_id_required' => 'Vui lòng nhập số thương nhân của bên thứ ba',
            'key_required' => 'Vui lòng nhập khóa của bên thứ ba',
            'url_required' => 'Vui lòng nhập URL thanh toán của bên thứ ba',
            'bank_type_required' => 'Vui lòng chọn loại thẻ ngân hàng',
            'account_required' => 'Vui lòng nhập tài khoản thanh toán',
            'name_required' => 'Vui lòng nhập tên người nhận tiền',
            'money_range_err' => 'Số tiền nạp tối đa không được thấp hơn số tiền nạp tối thiểu',
            'usdt_account_required' => 'Vui lòng nhập tài khoản nhận USDT',
            'usdt_rate_required' => 'Vui lòng nhập tỷ giá hối đoái USDT',
            'usdt_rate_valid' => 'Vui lòng nhập tỷ giá hối đoái USDT hợp lệ',
        ]
    ],

    'activity' => [
        'field' => [
            "title" => "Tiêu đề",
            "subtitle" => "Phụ đề",
            "cover_image" => "Danh sách hình bìa",
            "content" => "Hoạt động mô tả",
            "type" => "Các loại hoạt động",
            "apply_type" => "Cách áp dụng",
            "apply_url" => "Ứng dụng địa chỉ",
            "apply_desc" => "Mô tả ứng dụng",
            "hall_image" => "Hội trường bìa",
            "hall_field" => "Áp dụng để điền thông tin",
            "date_desc" => "Hoạt động thời gian mô tả",
            "date_description" => "Thời gian hoạt động",
            "start_at" => "Thời gian bắt đầu hoạt động",
            "end_at" => "Thời gian đóng cửa hoạt động",
            "rule_content" => "Quy tắc hoạt động",
            "is_open" => "Mở",
            "is_hot" => "Là nóng",
            "weight" => "Yếu tố",
            "lang" => "Ngôn ngữ",
        ],

        'index' => [
            'btn_preview' => 'Xem thử'
        ],

        'msg' => [
            'hall_image_required' => 'Vui lòng tải lên hình ảnh bìa của phòng tổ chức sự kiện',
            'apply_url_required' => 'Vui lòng điền vào địa chỉ chuyển đơn đăng ký sự kiện'
        ]
    ],

    'activity_apply' => [
        'field' => [
            "member_id" => "Id thành viên",
            "user_id" => "ID quản trị viên",
            "activity_id" => "ID hoạt động",
            "data_content" => "Thông tin ứng dụng",
            "status" => "Tình trạng ứng dụng",
            "remark" => "Thông tin nhận xét",

            "money" => "Số tiền giải ngân"
        ],

        'index' => [
            'btn_confirm' => 'Việc kiểm toán thông qua',
            'btn_reject' => 'Kiểm toán không đạt',
            'notice_confirm' => 'Xác định áp dụng thông qua các hoạt động của thành viên?',
            'notice_reject' => 'Bạn có chắc chắn từ chối đơn đăng nhập giải thưởng của thành viên không?',
            'btn_bonus' => 'Giải thưởng sự kiện'
        ],

        'edit' => [
            'title_confirm' => 'Việc kiểm toán thông qua',
            'title_reject' => 'Kiểm toán không đạt',
            'top_notice' => '<strong>Chú ý đến：</strong> Nếu bạn cần phân phối phần thưởng, vui lòng xử lý nó sau khi đánh giá được thông qua',
            'dealed_error' => 'Nếu bạn cần phân phối phần thưởng, vui lòng xử lý nó sau khi đánh giá được thông qua',
        ],

        'bonus' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Số tiền hoạt động được cấp mặc định vào tài khoản hoàn trả',
            'money_notice' => 'Vui lòng đặt ví nào để phát hành trong hệ thống - Cài đặt liên quan đến hoạt động'
        ]
    ],

    'modify_pwd' => [
        'field' => [
            "oldpassword" => 'Mật khẩu gốc',
            "password" => 'Mật khẩu mới',
            "password_confirmation" => 'Xác nhận mật khẩu mới',

            "qk_pwd" => 'Mã rút tiền mới',
            "old_qk_pwd" => 'Mật mã rút tiền gốc',
            "qk_pwd_confirmation" => 'Xác nhận mã rút tiền mới'
        ]
    ],

    'register' => [
        'field' => [
            'name' => 'Tài khoản',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Xác nhận mật khẩu',
            'rates' => 'Tỷ lệ trở lại'
        ]
    ],

    'bank' => [
        'field' => [
            "key" => "Phương thức thanh toán",
            "name" => "Tên",
            "url" => "Url",
            "is_open" => "Có bật hay không",
            "weight" => "Số",
            "lang" => "Ngôn ngữ"
        ]
    ],

    'memberbank' => [
        'field' => [
            "member_id" => "ID thành viên",
            "card_no" => "Số thẻ",
            "bank_type" => "Loại ngân hàng",
            "bank_type_text" => "Loại ngân hàng",
            "phone" => "Thẻ số điện thoại dự trữ",
            "owner_name" => "Tên người giữ thẻ",
            "bank_address" => "Địa chỉ ngân hàng",
            "remark" => "Hoạt động lưu ý",
        ],

        'index' => [
            'title' => ''
        ]
    ],

    'recharge' => [
        'field' => [
            "bill_no" => "Mã giao dịch",
            "member_id" => "Id thành viên",
            "name" => "Chuyển tên",
            "account" => "Tài khoản chuyển tiền",
            "origin_money" => "Số tiền nạp tiền trước khi chuyển đổi",
            "forex" => "Tỷ lệ giao dịch (chuyển đổi)",
            "lang" => "Ngôn ngữ/Đơn vị tiền tệ",
            "money" => "Nạp tiền",
            "payment_type" => "Các loại thanh toán",
            "payment_pic" => "Chứng từ thanh toán",
            "diff_money" => "Số lượng miễn phí loại",
            "before_money" => "Nạp tiền trước",
            "after_money" => "Số tiền sau khi nạp tiền",
            "score" => "Xác nhận",
            "fail_reason" => "Nguyên nhân thất bại",
            "hk_at" => "Thời gian chuyển tiền của khách hàng",
            "confirm_at" => "Xác nhận chuyển thời gian",
            "status" => "Tình trạng thanh toán",
            "user_id" => "ID của người quản trị.",

            'payment_id' => 'Thu thập thông tin',
            'payment_account' => 'Tài khoản thanh toán',
            'payment_name' => 'Người nhận tên',
            'bank_type' => 'Ngân hàng tiếp nhận'
        ],

        'index' => [
            'btn_confirm' => "Việc kiểm toán thông qua",
            'btn_reject' => "Kiểm toán không đạt",
            'btn_payment_detail' => "Chi tiết tài khoản thu tiền"
        ],

        'edit' => [
            'notice_diff' => "Kênh thanh toán :text Tỷ lệ quà tặng là :rate"
        ],

        'msg' => [
            'recharge_dealed' => 'Hồ sơ nạp tiền này được xử lý',
        ]
    ],

    'drawing' => [
        'field' => [
            "bill_no" => "Mã giao dịch",
            "member_id" => "ID thành viên",
            "name" => "Người nhận tên",
            "money" => "Số lượng rút tiền",
            "account" => "Thông tin tài khoản",
            "before_money" => "Số tiền trước khi rút tiền",
            "after_money" => "Sau khi rút tiền",
            "score" => "Xác nhận",
            "counter_fee" => "Lệ phí",
            "fail_reason" => "Nguyên nhân thất bại",
            "member_bank_info" => "Dữ liệu ngân hàng của người dùng json",
            "member_remark" => "Ghi chú rút tiền của người dùng",
            "confirm_at" => "Xác nhận thời gian chuyển tiền lưu ý người dùng rút tiền",
            "status" => "Tình trạng rút tiền",
            "user_id" => "ID của người quản trị.",
        ],

        'index' => [
            'btn_confirm' => 'Việc kiểm toán thông qua',
            'btn_reject' => 'Kiểm toán không đạt'
        ],

        'msg' => [
            'dealed_error' => 'Đơn xin rút tiền này đã được xử lý'
        ]
    ],

    'message' => [
        'field' => [
            "user_id" => "ID của người quản trị.",
            "pid" => "ID thông báo trước",
            "url" => "đi tới địa chỉ URL.",
            "title" => "Tiêu đề của lá thư trong box",
            "content" => "Gửi nội dung",
            "visible_type" => "Kiểu nhìn thấy được",
            "send_type" => "Gửi các loại",
        ],

        'index' => [
            'visible_member' => 'Thành viên hiển thị',
            'all_member' => 'Tất cả các thành viên',
        ],

        'msg' => [
            'member_select_required' => 'Vui lòng chọn thành viên nào để gửi',
            'data_select_required' => 'Vui lòng chọn dữ liệu cần được thao tác',
        ]
    ],

    'member_message' => [
        'field' => [
            'title' => 'Tiêu đề phản hồi thành viên',
            'content' => 'Nội dung phản hồi của thành viên',
            'reply_title' => 'Tiêu đề trả lời',
            'reply_content' => 'Nội dung trả lời',
            'status' => 'Tình trạng trả lời'
        ],

        'index' => [
            'btn_batch_read' => 'Đã đọc hàng loạt',
            'btn_detail' => 'Chi tiết phản hồi',
            'btn_reply' => 'Phản hồi tin nhắn',
            'btn_mark' => 'Đánh dấu phản hồi',
            'title_mark' => 'Bạn có chắc chắn thực hiện xử lý trả lời đánh dấu không?',
            'title_delete' => 'Bạn có chắc chắn xóa câu trả lời không?'
        ],

        'history' => [
            'title' => 'Chi tiết phản hồi',
        ],
    ],

    'member_money_log' => [
        'field' => [
            "member_id" => "Id thành viên",
            "user_id" => "ID của người quản trị.",
            "money" => "Số tiền hoạt động",
            "money_before" => "Số tiền trước khi hoạt động",
            "money_after" => "Số tiền sau khi hoạt động",
            "money_type" => "Số lượng trường loại",
            "number_type" => "Số lượng các loại",
            "operate_type" => "Số tiền thay đổi kiểu",
            "model_name" => "Tên mô hình",
            "model_id" => "ID mô hình.",
            "description" => "Mô tả hoạt động",
            "remark" => "Hoạt động lưu ý",
        ],

        'notice' => [
            'activity_bonus' => 'Các hoạt động phát【 :title 】Tiền thưởng【 :money VND】Đối với các thành viên【 :member 】',
            'system_send_fs' => 'Khung thời gian phát hành của quản trị viên【 :time 】Các loại trò chơi【 :game_type 】Ví hoàn trả đến ví hoàn trả',
            'drawing_reject' => 'Không thông qua việc rút tiền mặt của các thành viên, số tiền sẽ【 :money VND】Hoàn trả vào tài khoản thành viên, lý do từ chối：:reason',
            'drawing_counter_fee' => '，Số lượng mã thành viên là【 :ml_money 】,Trừ phí xử lý【 :count_fee VND】',
            'drawing_request' => 'Số tiền rút tiền cuối cùng của thành viên là【 :money 】',
            'get_fs_now' => 'Ngày nhận【 :time 】Trước sự hoàn trả，Số tiền được【 :money 】，Các loại trò chơi【 :game_type】，Phân phối cho ví hoàn trả',

            'transfer_in_game' => 'Chuyển sang【 :title 】Trò chơi【 :money VND】，Khấu trừ số tiền tài khoản',
            'transfer_in_error' => 'Chuyển sang【 :title 】Trận đấu thất bại，Hoàn trả số tiền tài khoản【 :money VND】',
            'transfer_out_game' => 'Chuyển ra ngoài【 :title 】Trò chơi【 :money VND】，Tăng số tiền tài khoản'
        ]
    ],

    'yuebao_plan' => [
        'field' => [
            "SettingName" => "Tiêu đề chương trình",
            "MinAmount" => "Số tiền mua tối thiểu",
            "MaxAmount" => "Số tiền mua tối đa",
            "SettleTime" => "Thời gian giải quyết (giờ)",
            "IsCycleSettle" => "Cách giải quyết",
            "Rate" => "Chương trình lãi suất",
            "TotalCount" => "Tổng số kế hoạch",
            "LimitInterest" => "Lãi suất cao nhất của hội viên",
            "LimitOrderIntervalTime" => "Khoảng thMở cửa để muaời gian đặt hàng (giờ)",
            "InterestAuditMultiple" => "Nhân số lượng mã lãi suất",
            "LimitUserOrderCount" => "Thành viên mua tổng số lãi suất tối đa multiple",
            "is_open" => "Mở cửa để mua",
            "weight" => "Sắp xếp",
            'lang' => 'Ngôn ngữ'
        ],

        'edit' => [
            'notice_no_limit' => 'Không điền có nghĩa là không có hạn chế',
            'notice_default_ml' => 'Mặc định là 1 lần số lượng mã',
            'notice_weight' => 'Càng lớn càng tiến về phía trước'
        ],

        'member_plan' => [
            'created_at' => 'Thời gian mua'
        ],

        'msg' => [
            'min_money_err' => 'Số tiền mua tối thiểu không được cao hơn số tiền mua tối thiểu',
            'max_money_err' => 'Số tiền mua tối đa không được cao hơn tổng số tiền kế hoạch',
        ]
    ],

    'member_yuebao_plan' => [
        'field' => [
            "member_id" => "Id thành viên",
            "plan_id" => "ID chương trình",
            "amount" => "Số tiền mua",
            "status" => "Trạng thái",
            "drawing_at" => "Thời gian rút tiền mặt",

            "interest_sum" => "Lãi tích lũy",
        ],

        'index' => [
            'title_interest_history' => 'Kỷ lục lợi nhuận - 【 :name 】'
        ]
    ],

    'interest_history' => [
        'field' => [
            "member_plan_id" => "ID gói thành viên",
            "interest" => "Lãi suất",
            "times" => "Số lần",
            "calc_at" => "Thời gian giải quyết",
        ]
    ],

    'credit_pay_record' => [
        'field' => [
            "member_id" => "Id thành viên",
            "money" => "Số tiền vay",
            "type" => "Các loại",
            "borrow_day" => "Số ngày vay",
            "status" => "Trạng thái",
            "dead_at" => "Thời gian đáo hạn khoản vay",

            "is_overdue" => "Cho dù quá hạn"
        ],

        'index' => [
            'btn_confirm' => 'Thông qua',
            'notice_confirm' => 'Xác định hoạt động vay tiền thông qua các thành viên?',
            'btn_reject' => 'Bạn có chắc chắn từ chối hoạt động vay của thành viên không?',
            'notice_reject' => 'Từ chối',

            'title_lend' => 'Hồ sơ trả nợ',
            'title_borrow' => 'Hồ sơ vay vốn',
        ]
    ],

    'quick' => [
        'member_arbitrage_query' => [
            'arbitrage_type' => 'Loại chênh lệch giá',
            'result' => 'Kết quả Tìm kiếm',
            'total_number' => 'Tổng số người',
            'no_result' => 'Không có dữ liệu liên quan'
        ],

        'transfer_check' => [
            'start_at' => 'Thời gian bắt đầu',
            'end_at' => 'Thời gian kết thúc',
            'transfer_out_account' => 'Chuyển ra khỏi tài khoản',
            'transfer_in_account' => 'Chuyển vào tài khoản',
            'money' => 'Số tiền chuyển',
            'is_dd' => 'Cho dù đơn đặt hàng',
            'btn_supply' => 'Chỉ bổ sung đơn hàng',
            'btn_supply_modify' => 'Bổ sung hóa đơn và sửa đổi số dư',

            'no_transfer_data' => 'Thành viên này không có hồ sơ chuyển đổi hạn ngạch giữa[: start_at ~: end_at]',
            'transfer_count_success' => 'Thành viên này có một hồ sơ[: count]ở giữa[: start_at ~: end_at]và chưa rời khỏi đơn đặt hàng',
            'transfer_count_fail' => 'có một đơn đặt hàng fail_count trong hồ sơ [: count]ở giữa[: start_at ~: end_at]',
            'money_not_enough' => 'Số dư thành viên không đủ, vui lòng kiểm tra',
        ],

        'database_clean' => [
            'top_notice' => '<strong>Chú ý đến：</strong> Thao tác không thể đảo ngược, thao tác cẩn thận;【Bảng thành viên】Và【Hồ sơ hoa hồng đại lý】Không thể xóa dựa trên tên thành viên，Chỉ xóa theo số ngày làm sạch dữ liệu；<br><b>Nếu bạn xóa bản ghi trò chơi thành viên, dữ liệu phúc lợi cấp thăng hạng sẽ bị mất<b>；',
            'member_notice' => 'Nếu bạn không chọn thành viên, có nghĩa là tất cả dữ liệu của hệ thống đã được dọn dẹp',
            'content' => 'Làm trong sạch nội dung',

            'member' => 'Bảng thành viên',
            'agent' => 'Bảng đại diện',
            'agent_fd_money_log' => 'Nhật ký số tiền giảm giá đại lý',
            'agent_yj_log' => 'Hồ sơ hoa hồng đại lý',
            'drawing' => 'Biên bản rút tiền',
            'game_record' => 'lịch sử trò chơi thành viên',
            'member_money_log' => 'Nhật ký số lượng thành viên',
            'recharge' => 'Hồ sơ nạp tiền',
            'transfer' => 'Bản ghi chuyển đổi hạn ngạch',
            'member_log' => 'Nhật ký hoạt động thành viên',
            'member_wheel' => 'Bản ghi roulette thành viên',
            'daily_bonus' => 'Hồ sơ đăng ký thành viên',
            'member_yuebao_plan' => 'Hồ sơ thành viên Yu ebao',
            'credit_pay_record' => 'Thành viên mượn hồ sơ',
            'activity' => 'Danh sách các hoạt động',
            'activity_apply' => 'Đơn đăng ký hoạt động thành viên',

            'oldest_date' => 'Ngày dữ liệu cũ nhất',
            'latest_date' => 'Dữ liệu mới nhất ngày',
            'day_before' => ':date Cách đây vài ngày',

            'day_field' => 'Dọn dẹp dữ liệu bao nhiêu ngày trước',
            'days' => 'Ngày làm sạch dữ liệu',
            'day_notice' => 'Dọn dẹp dữ liệu sau 30 ngày theo mặc định',

            'alert_before' => 'Đã chọn nội dung dọn dẹp',
            'alert_after' => 'Xác nhận dọn dẹp?',
            'alert_title' => 'Mẹo hoạt động',
            'alert_1' => 'Tôi sẽ tìm hiểu lại.',
            'alert_2' => 'Tôi đã đọc dòng chữ màu đỏ trên, tiếp tục dọn dẹp',

            'item_select_required' => 'Vui lòng chọn mục dọn dẹp',
        ],
    ],

    'yj_level' => [
        'field' => [
            'level' => 'Mức hoa hồng',
            'name' => 'Tên lớp',
            'active_num' => 'Số lượng hoạt động ngoại tuyến',
            'min' => 'Doanh thu tối thiểu',
            'rate' => 'Tỷ lệ hoa hồng (phần trăm)',
            "lang" => "Tiền tệ",
        ],

        'msg' => [
            'top_notice' => 'Lưu ý: Tiêu chí dành cho thành viên ngoại tuyến tích cực là số tiền nạp hàng tháng đạt [:money] nhân dân tệ. Nếu bạn cần sửa đổi, vui lòng sửa đổi trong trang [Cấu hình hệ thống] - [Nhóm cấu hình hệ thống] - [Liên quan đến đại lý]'
        ]
    ],

    'agent_yj_log' => [
        'field' => [
            'created_at' => 'Khoảng thời gian hoa hồng',
            'top_title' => 'Báo cáo tài chính đại lý',

            'offline' => 'Thành viên tuyến dưới',
            'balance' => 'Số dư ngoại tuyến',
            'transfer' => 'Gửi và rút tiền thường xuyên',
            'deposit' => 'tiền gửi',
            'withdraw' => 'Rút tiền',
            'bonus' => 'Phân phối tiền thưởng',
            'activity' => 'Quà tặng hoạt động',
            'rebate' => 'phân phối hoàn trả',
            'other' => 'Các trường hợp khác',
            'last_at' => 'Thời gian hoa hồng cuối cùng',
            'money' => 'Hoa hồng',
            'remark' => 'Nhận xét của hoa hồng',

            'send_yj' => 'Phân phối hoa hồng',
            'record' => 'ghi âm',
            'history' => '【:name】Lịch sử thanh toán hoa hồng',
        ],

        'msg' => [
            'top_notice' => 'Lưu ý: Hình thức chi hoa hồng đại lý là mô hình đại lý truyền thống, do quản trị viên kiểm soát, về nguyên tắc là phát hành mỗi tháng một lần.',

            'time_range_required' => 'Vui lòng chọn khung thời gian hoa hồng trước',
            'yj_send_success' => 'Hoa hồng được phát hành thành công',
            'yj_send_fail' => 'Chi hoa hồng không thành công:',
        ]
    ],

    'send_fs' => [
        'msg' => [
            'realtime_fs_mode' => 'Hiện ở chế độ realtime rebounds, không thể sử dụng chức năng rebounds một chạm',
            'send_success' => 'Giải phóng mặt bằng hoàn trả thành công',
            'send_fail' => 'Phân phối ngược hoàn trả không thành công:',
        ]
    ],

    'transfer' => [
        'field' => [
            "bill_no" => "Số dòng giao dịch",
            "api_name" => "Nhận dạng giao diện",
            "member_id" => "ID thành viên",
            "transfer_type" => "Các loại hình chuyển",
            "money" => "Số tiền quy đổi",
            "diff_money" => "Số tiền chênh lệch (cổ tức)",
            "real_money" => "Số tiền chuyển đổi thực tế",
            "before_money" => "Số tiền trước khi chuyển",
            "after_money" => "Số tiền sau khi chuyển",
            "money_type" => "Loại trường số tiền",
        ],
    ],

    'fs_level' => [
        'field' => [
            "game_type" => "Các loại trò chơi",
            "member_id" => "ID thành viên",
            "level" => "Cấp bậc",
            "name" => "Tên cấp bậc",
            "quota" => "Hạn mức cá cược hợp lệ",
            "type" => "Các loại",
            "rate" => "Tỷ lệ hoàn trả ngược",
            "lang" => "Ngôn ngữ/Đơn vị tiền tệ"
        ],

        'msg' => [
            'select_member' => 'Vui lòng chọn thành viên',
            'same_data_not_allowed' => 'Liệu của cùng một thể loại trò chơi, thể loại, cấp độ, tiền tệ chỉ có thể tồn tại một',
            'fs_level_required' => 'Vui lòng đặt tên cấp',
            'fs_level_repeat' => 'Dữ liệu cấp độ hoàn trả của cấp độ này đã tồn tại, vui lòng xóa nó sau khi hoạt động',
        ],
    ],

    'aside_adv' => [
        'field' => [
            'name' => 'Tên',
            'group' => 'Tên nhóm',
            'pic_url' => 'hình ảnh quảng cáo',
            'pic_index' => 'Chỉ mục hình ảnh',
            'vertical' => 'Vị trí dọc',
            'horizontal' => 'vị trí nằm ngang',
            'effect' => 'Hiệu ứng đặc biệt',
            'url_id' => 'Đường nhảy',
            'remark' => 'Thông tin ghi chú',
            'lang' => 'Ngôn ngữ',
            'is_open' => 'Nó mở rồi',
            'weight' => 'Loại',
        ],
    ],

    'option' => [
        'member_status' => [
            1 => 'bật',
            -1 => 'Bị tắt',
            -2 => 'Kick off dòng'
        ],
        'game_type' => [
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
            99 => 'Xổ số hệ thống'
        ],

        'activity_type' => [
            1 => 'Hoạt động ví hoàn trả',
            2 => 'Các hoạt động lợi tức',
            3 => 'Hoạt động nạp tiền',
            4 => 'Cho thấy sự kiện'
        ],

        'activity_is_apply' => [
            1 => 'Cần phải áp dụng cho',
            0 => 'Không cần phải áp dụng'
        ],

        'activity_apply_type' => [
            0 => 'Không cần phải áp dụng',
            1 => 'Liên hệ với ứng dụng dịch vụ khách hàng',
            2 => 'Hoạt động hall áp dụng',
            3 => 'Nhảy xuống xem chi tiết'
        ],

        'activity_apply_field' => [
            'member_name' => 'Thành viên tên người dùng',
            'recharge_money' => 'Số tiền gửi',
            'game_type' => 'Các loại trò chơi',
            'api_game_type' => 'Trò chơi phân loại',//(giao diện + loại trò chơi),
            'bill_no' => 'Số đĩa đơn',
        ],

        'activity_apply_status' => [
            0 => 'Chờ xem xét',
            1 => 'Phê duyệt',
            2 => 'Kiểm toán không được thông qua',
            3 => 'Giảm giá đã được phát hành'
        ],

        'is_open' => [
            1 => 'Mở',
            0 => 'Đóng'
        ],

        'is_read' => [
            1 => 'Đã đọc',
            0 => 'Chưa đọc'
        ],

        'boolean' => [
            1 => 'Có',
            0 => 'Không'
        ],

        'gender' => [
            0 => 'Người đàn ông',
            1 => 'Phụ nữ'
        ],

        'member_money_type' => [
            'money' => 'Số dư ví chính',
            'fs_money' => 'Số dư ví hoàn trả',
            'total_money' => 'Tổng số tiền đặt cược vào nền tảng',
            'score' => 'Thành viên điểm',
            'ml_money' => 'Số dư kích thước',
            'total_credit' => 'Tổng số vay',
            'used_credit' => 'Mượn đã được sử dụng'
        ],

        'member_money_operate_type' => [
            1 => 'Hoạt động quản trị',
            2 => 'Hệ thống miễn phí',
            3 => 'Trò chơi bật/tắt',
            4 => 'Quay lại hoàn trả phát hành',
            5 => 'Đăng nhập các hoạt động để nhận được',
            6 => 'Hoạt động nạp tiền',
            7 => 'Lợi tức nền tảng',
            8 => 'Lấy một phong bì màu đỏ',
            9 => 'Nạp tiền/rút tiền',
            10 => 'Quà tặng nạp tiền',
            11 => 'Từ chối rút tiền trở lại',
            12 => 'Thất bại trong trò chơi hoàn lại',
            13 => 'Hoạt động phát hành',
            14 => 'Ủy nhiệm đại lý',
            15 => 'Xổ số bàn xoay',
            16 => 'Mua sản phẩm tài chính',
            17 => 'Sản phẩm tài chính cổ tức',
            18 => 'Hình thức hoàn lại/khấu trừ',
            19 => 'Mua lại sản phẩm tài chính',
            20 => 'Kim phần thưởng',
            21 => 'Ben châu',
            22 => 'Bằng cách này',
            23 => 'Vay mượn',
            24 => 'Vay nợ',
            25 => 'Quà tặng hàng ngày',
            26 => 'Quà tặng hàng tuần',
            27 => 'Quà tặng hàng tháng',
            28 => 'Hằng năm, tiền quà',
            29 => 'Quà khuyến mãi',
        ],

        'levelup_types' => [
            1 => 'Số tiền gửi đạt tiêu chuẩn',
            2 => 'Số tiền đặt cược đạt tiêu chuẩn',
            3 => 'Bất kỳ ai đạt tiêu chuẩn',
            4 => 'Tất cả đều đạt tiêu chuẩn',
        ],

        'money_number_type' => [
            1 => 'Gia tăng',
            -1 => 'Giảm thiểu'
        ],

        'card_type' => [
            1 => 'Thẻ tiết kiệm',
        ],

        'agent_assign_types' => [
            1 => 'Tái tạo lại',
            2 => 'Theo các Đại Lý cũ'
        ],

        'feedback_type' => [
            1 => 'Vấn đề nền tảng',
            2 => 'Vấn đề tài chính',
            3 => 'Cho lời khuyên'
        ],

        'about_type' => [
            1 => "Về chúng ta",
            2 => "Trợ giúp tiền gửi",
            3 => "Rút tiền trợ giúp",
            4 => "Câu hỏi thường gặp",
            5 => "Đối tác",
            6 => "Hợp đồng",
            7 => "liên hệ chúng tôi",
            8 => "Điều khoản và quy tắc"
        ],

        'gamerecord_status' => [
            'N' => 'Hủy bỏ',
            'X' => 'Không giải quyết',
            'COMPLETE' => 'Đã giải quyết',
            'CANCEL' => 'Đã bị hủy bỏ',
        ],

        'client_type' => [
            0 => 'Điện thoại di động máy tính được hỗ trợ',
            1 => 'pc',
            2 => 'phone'
        ],

        'tag_type' => [
            'hot' => 'Nóng nhất',
            'recommend' => 'Giới thiệu',
            'new' => 'Mới nhất',
        ],

        'apply_status' => [
            0 => 'Chờ xem xét',
            1 => 'Phê duyệt',
            2 => 'Kiểm toán không được thông qua'
        ],

        'recharge_status' => [
            1 => 'Để xác nhận',
            2 => 'Nạp tiền thành công',
            3 => 'Nạp tiền thất bại'
        ],

        'drawing_status' => [
            1 => 'Để xác nhận',
            2 => 'Rút tiền thành công',
            3 => 'Rút tiền thất bại'
        ],

        'recharge_type' => [
            1 => 'alipay',
            2 => 'Vi bức thư',
            3 => 'Chuyển khoản ngân hàng',
            4 => 'Thanh toán bên thứ ba',
            5 => 'QQ',
            6 => 'Cách gõ-Vi bức thư',
            7 => 'Cách gõ-alipay'
        ],

        'payment_type' => [
            'online_alipay' => 'Alipay thanh toán(Thanh toán trực tuyến)',
            'online_wechat' => 'Vi-thanh toán(Thanh toán trực tuyến)',
            'online_union_quick' => 'Unionpay nhanh(Thanh toán trực tuyến)',
            'online_union_scan' => 'Cúp quốc gia quét mã（Thanh toán trực tuyến）',
            'company_bankpay' => 'Chuyển tiền thẻ ngân hàng(Công ty thu nhập)',
            'company_alipay' => 'Alipay thanh toán(Công ty thu nhập)',
            'company_wechat' => 'Vi-thanh toán(Công ty thu nhập)',
            'online_cgpay' => 'CGPayTrả tiền(Thanh toán trực tuyến)',
            'company_usdt' => 'USDT (Công ty thu nhập)',
            'online_usdt' => 'USDT (Thanh toán trực tuyến)',
        ],

        'transfer_type' => [
            1 => 'Vào trò chơi',
            2 => 'Ra khỏi trò chơi'
        ],

        // 消息可见性类型
        'message_visible_type' => [
            1 => 'Tất cả các thành viên có thể nhìn thấy',
            2 => 'Một thành viên có thể nhìn thấy',
            3 => 'Quản trị viên có thể nhìn thấy'
        ],

        // 消息发送类型
        'message_send_type' => [
            1 => 'Quản trị viên gửi',
            2 => 'Thành viên gửi'
        ],

        'message_status' => [
            0 => 'Chờ trả lời',
            1 => 'Trả lời',
            2 => 'Thẻ trả lời'
        ],

        // 签到类型 负数表示设置，正数表示领奖
        'daily_bonus_type' => [
            -2 => 'Phần thưởng đăng ký liên tục',
            -1 => 'Phần thưởng đăng ký tích lũy',
            0 => 'Thường đăng nhập',
            1 => 'Đăng ký để nhận giải thưởng',
            2 => 'Đăng ký liên tục để nhận giải thưởng'
        ],

        'daily_bonus_set' => [
            -1 => 'Đăng nhập tích lũy',
            -2 => 'Đăng nhập liên tục'
        ],

        'daily_bonus_state' => [
            0 => 'Để xác nhận',
            1 => 'Đã xác nhận',
            -1 => 'Đã bị từ chối'
        ],

        'member_log_type' => [
            1 => 'Thành viên đăng nhập',
            2 => 'Thoát khỏi thành viên',
            3 => 'Hoạt động thành viên',
            4 => 'Đại lý đăng nhập nền văn phòng',
            5 => 'Tài liệu Đại Lý xuất hiện ở hậu trường',
            6 => 'Thành viên chuyển sang ngoại lệ giao diện',
            7 => 'Gởi kiểm tra SMS'
        ],

        'task_condition_types' => [
            1 => 'Nạp tiền duy nhất',
            2 => 'Nạp tiền tích lũy',
            3 => 'Rút tiền tích lũy',
            4 => 'Lợi nhuận tích lũy',
            5 => 'Mất mát tích lũy',
            6 => 'Tích lũy hoàn trả'
        ],

        'task_award_type' => [
            1 => 'Giải thưởng danh hiệu',
            2 => 'Số tiền thưởng',
            3 => 'Trở lại phần thưởng',
            4 => 'Phần thưởng tín dụng'
        ],

        'level_award_type' => [
            'level_award' => 'Quà tặng cấp',
            'week_award' => 'Ben châu',
            'month_award' => 'Bằng cách này',
            'name_award' => 'Giải thưởng danh hiệu',
            'borrow_award' => 'Phần thưởng tín dụng'
        ],

        'fs_type' => [
            1 => 'Mức độ hoàn trả của hệ thống',
            2 => 'Tăng trưởng Cấp độ của thành viên'
        ],

        'member_task_status' => [
            1 => 'Nhận được',
            2 => 'Đã dẫn đến'
        ],

        'agent_rate_type' => [
            3 => 'Quyền/Thành viên điểm',
            4 => 'Dấu chấm mặc định trên đường dây của các Đại Lý'
        ],

        'config_money_type' => [
            'money' => 'Ví chính',
            'fs_money' => 'Ví hoàn trả',
        ],

        'arbitrage_conditions' => [
            'ip' => 'Cùng IP',
            'psw' => 'Cùng với mật khẩu',
            'phone' => 'Số điện thoại',
            'card' => 'Cùng tên tài khoản ngân hàng'
        ],

        'wheel_awards' => [
            1 => ['desc' => '500 nhận 100 phiếu giảm giá','type' => 2,'pic' => 'web/images/wheel/zh_cn/2ead44b68b93b0677b2cffe04cdf08d3.png'],
            2 => ['desc' => '₫28','type' => 1,'pic' => 'web/images/wheel/zh_cn/34bacd7183d7e2b95845d2c48e27d10c.png'],
            3 => ['desc' => '100 được 20 phiếu giảm giá','type' => 2,'pic' => 'web/images/wheel/zh_cn/bd8dd02713d3ac8705b38f1602de04a4.png'],
            4 => ['desc' => '₫58','type' => 1,'pic' => 'web/images/wheel/zh_cn/96b56053b67e5216b8d2c07562344e56.png'],
            5 => ['desc' => 'Tour du lịch Hồng Kông và Ma Cao năm ngày','type' => 3,'pic' => 'web/images/wheel/zh_cn/295c5965c9ed549937c3cf5942ccb897.png'],
            6 => ['desc' => '₫88','type' => 1,'pic' => 'web/images/wheel/zh_cn/11f2d5122249b7d1adb166ceffdb197e.png'],
            7 => ['desc' => '5000 được 1000 phiếu giảm giá','type' => 2,'pic' => 'web/images/wheel/zh_cn/b07eedbdf8cdf5b89b8d004d0b8e3f37.png'],
            8 => ['desc' => '₫18','type' => 1,'pic' => 'web/images/wheel/zh_cn/447075995668a5e04b0bf60885be216e.png'],
            9 => ['desc' => 'IPHONE 12 PRO MAX 512GB','type' => 3,'pic' => 'web/images/wheel/zh_cn/957740284f61bba05611061782f8d639.png'],
            10 => ['desc' => '1000 được 300 phiếu giảm giá','type' => 2,'pic' => 'web/images/wheel/zh_cn/9019cab46b10bc82ab6ba6a94d6beb3c.png'],
            11 => ['desc' => 'Tour du lịch Đông Nam Á sang trọng 7 ngày','type' => 3,'pic' => 'web/images/wheel/zh_cn/835cfc99c3e77309c238612972996253.png'],
            12 => ['desc' => '₫8','type' => 1,'pic' => 'web/images/wheel/zh_cn/939d617c97f3a372980f3362245b3b5c.png']
        ],

        'wheel_status' => [
            1 => 'Để phát hành',
            2 => 'Đã được phát hành',
            3 => 'Phát trực tiếp'
        ],

        'yuebao_settle_type' => [
            0 => 'Giải quyết duy nhất',
            1 => 'Chu kỳ giải quyết'
        ],

        'yuebao_member_status' => [
            0 => 'Đang tiến hành',
            1 => 'Đã kết thúc'
        ],

        'quick_url_type' => [
            'web' => 'WEBtrang',
            'index' => 'Một trang riêng biệt',
            'mobile' => 'Trang điện thoại di động'
        ],

        'adv_vertical' => [
            'top' => 'trên',
            'bottom' => 'Tiếp theo',
        ],

        'adv_horizontal' => [
            'left' => 'Bên trái',
            'right' => 'Bên phải'
        ],

        'adv_effect' => [
            'hover' => 'Trôi nổi'
        ],

        "notice_type" => [
            "voice" => "Chỉ âm thanh nhắc nhở",
            "alert" => "Chỉ cần bật cửa sổ nhắc nhở",
            "voice_and_alert" => "Cảnh báo âm thanh và cảnh báo bật cửa sổ"
        ],

        "is_online" => [
            1 => 'Trực tuyến',
            0 => 'offline'
        ],

        "credit_type" => [
            'borrow' => 'Khoản nợ',
            'lend' => 'Đủ trả'
        ],

        "credit_status" => [
            1 => 'Để xác nhận',
            2 => 'Vay mượn thành công',
            3 => 'Từ chối vay mượn',
            4 => 'Trả nợ thành công'
        ],

        'levelup_type' => [
            7 => 'Nâng cấp Slot điện tử',
            8 => 'Nâng cấp Casino trực tiếp'
        ],

        'notice_group' => [
            'main' => 'Thông báo Trang chủ',
            'credit' => 'Thông báo',
            'pc' => 'cửa sổ bật lên máy tính',
            'mobile' => 'điện thoại di động bật lên'
        ],

        'register_setting_field' => [
            'isInviteCodeRequired' => 'Bạn có cần điền mã mời cho phiên bản máy tính không',
            'isRealNameRequred' => 'Phiên bản máy tính có cần điền tên thật không',
            'isPhoneRequired' => 'Phiên bản máy tính có cần điền số điện thoại di động không',
            'isCaptchaRequired' => 'Bạn có cần điền mã xác minh cho phiên bản máy tính không',

            'isInviteCodeRequired_mobile' => 'Bạn có cần điền mã mời cho phiên bản di động không',
            'isRealNameRequred_mobile' => 'Phiên bản dành cho điện thoại di động có cần điền tên thật hay không',
            'isPhoneRequired_mobile' => 'Phiên bản điện thoại di động có cần điền số điện thoại di động không',
            'isCaptchaRequired_mobile' => 'Bạn có cần điền mã xác minh cho phiên bản điện thoại di động không',
        ],

        'web_nav' => [
            "index" => "Trang chủ",
            "slot" => "Giải trí điện tử slot",
            "poker" => "Trò chơi cờ vua",
            "casino" => "Casino trực tiếp",
            "lottery" => "Trò chơi xổ số",
            "sport" => "thể thao",
            "fish" => "Bắn cá",
            // "e_sport" => "电子竞技",
            "activity" => "Các hoạt động ưu đãi",
            "app" => "APP điện thoại di động",
            "service" => "Dịch vụ khách hàng trực tuyến"
        ],

        'member_apis' => 'Cân bằng số dư Ví',
        'recharges' => 'Lịch sử nạp tiền',
        'drawings' => 'Lịch sử rút tiền',
        'transfers' => 'Lịch sử chuyển ví',
        'gamerecords' => 'Lịch sử  cá cược',
        'memberlogs' => 'Lịch sử đăng nhập',
        'modify_money' => 'Thay đổi số dư',
        'arbitrage_query' => 'Kiểm tra & truy vấn',
        'make_offline' => 'Thoát tất cả phiên đăng nhập',
        'make_offline_msg' => 'Có chắc là đá các thành viên ra khỏi đường dây không?',

    ],

    // 接口相关文字
    'api' => [
        'common' => [
            'demo_not_allowed' => 'Thử tài khoản không thể làm điều này',
            'member_forbidden' => 'Tài khoản đã bị vô hiệu hóa',
            'operate_error' => 'Hoạt động bất thường',
            'operate_fail' => 'Hoạt động thất bại：',
            'operate_forbidden' => 'Yêu cầu bất hợp pháp',
            'operate_again' => 'Hoạt động thất bại，Xin vui lòng thử lại',
            'operate_success' => 'Hoạt động thành công',
            'member_not_exist' => 'Thông tin thành viên không tồn tại',
            'net_again_err' => 'Lỗi mạng，Xin vui lòng thử lại',
            'err_code' => 'Lỗi mã：',
            'err_msg' => 'Thông tin sai lệch：',
            'money_desc' => ':money Đô la',
            'server_error' => 'Lỗi nội bộ máy chủ',
            'phone_not_exist' => 'Số điện thoại không tồn tại',
            'phone_existed' => 'Số điện thoại đã tồn tại',
        ],

        'index' => [
            'main_advertise_title_1' => 'Ưu đãi thành viên mới',
            'main_advertise_title_2' => 'Giảm giá độc quyền trò chơi điện tử Slot',
            'main_advertise_title_3' => 'Giảm giá độc quyền Casino trực tiếp',

            'main_advertise_sub_title_1' => 'Nhiều ưu đãi hơn nằm ở VIP',
            'main_advertise_sub_title_2' => 'Giảm giá 25% cho tiền gửi độc quyền giải trí điện tử',
            'main_advertise_sub_title_3' => 'Thành viên nhận được 30% tiền gửi đầu tiên',

            'hotgame_sub_title_1' => 'Cuộc thi Đá gà Thái Lan được bao phủ đầy đủ, cách chơi đa dạng và thú vị nhất, mang đến cho bạn những trò chơi giải trí chọi gà phong phú nhất trên toàn mạng。',
            'hotgame_sub_title_2' => 'Tôn trọng tấm lòng của người thợ thủ công, giới thiệu cái cũ và đưa ra cái mới, mang đến cho người chơi trải nghiệm chơi game tuyệt vời nhất. Một nhóm giải thưởng tích lũy hàng chục triệu trong tầm tay, đang chờ bạn！',
            'hotgame_sub_title_3' => 'Môi trường sòng bạc chân thực nhất, người phụ trách sòng bạc đẹp nhất và chuyên nghiệp nhất, sẽ giới thiệu cho bạn baccarat sang trọng, với nhiều cách chơi khác nhau và không lặp lại, mang đến cho bạn trải nghiệm trực tiếp tuyệt vời！',
        ],

        'lottery' => [
            'VNC' => 'Màu Việt Nam',
            'OTHERS' => 'khác'
        ],

        'sms' => [
            'code_required' => 'Vui lòng điền vào mã xác minh SMS',
            'code_get_first' => 'Vui lòng lấy mã xác minh SMS trước',
            'code_expired' => 'Mã xác minh SMS đã hết hạn, vui lòng lấy lại；',
            'code_error' => 'Mã xác minh SMS điền sai, vui lòng thử lại',
            'operation_repeat' => 'Đã nhận được mã xác minh trong vòng hai phút, vui lòng không thao tác thường xuyên',
        ],

        'apply_agent' => [
            'member_is_agent' => 'Bạn đã là một Đại Lý，Không cần phải áp dụng cho',
            'has_applied' => 'Anh đã nộp đơn，Xin vui lòng kiên nhẫn chờ đợi',
            'apply_success' => 'Ứng dụng thành công',
            'apply_fail' => 'Nộp đơn thất bại，Xin vui lòng thử lại',
            'status_fail' => 'Bạn chưa nộp đơn xin ủy quyền',
            'not_agent' => 'Bạn chưa phải là Đại Lý'
        ],

        'member_bank' => [
            'field' => [
                "member_id" => "ID thành viên",
                "card_no" => "Số thẻ",
                "bank_type" => "Ngân hàng",
                "bank_type_text" => "Tên ngân hàng",
                "phone" => "Số điện thoại",
                "owner_name" => "Tên chủ thẻ",
                "bank_address" => "Địa chỉ ngân hàng",
                "remark" => "Ghi chú hoạt động",
            ],

            'create_success' => 'Dữ liệu ngân hàng được tạo ra thành công',
            'create_fail' => 'Dữ liệu ngân hàng đã thất bại，Xin vui lòng thử lại',
            'update_success' => 'Cập nhật dữ liệu ngân hàng thành công',
            'update_fail' => 'Cập nhật dữ liệu ngân hàng đã thất bại，Xin vui lòng thử lại',
            'delete_success' => 'Xóa dữ liệu ngân hàng thành công',
            'delete_fail' => 'Việc xoá dữ liệu ngân hàng đã thất bại，Xin vui lòng thử lại'
        ],

        'recharge' => [
            'payment_closed' => 'Kênh thanh toán đã đóng cửa，Xin vui lòng chọn lại',
            'pay_between' => 'Số tiền chuyển khoản là :min ~ :max Đô la，Xin hãy kiểm tra',
            'pay_success' => 'Gửi thành công，Xin vui lòng trả tiền',
            'payment_change' => 'Thông tin thu ngân đã thay đổi，Xin vui lòng gửi lại',
            'pay_normal_success' => "Nạp tiền đăng ký thành công，Xin vui lòng chờ cho người quản trị xem xét",
            'pay_normal_fail' => "Ứng dụng nạp tiền đã thất bại，Xin vui lòng thử lại",

            'not_third_pay' => 'Đây không phải là một khoản thanh toán từ bên thứ ba',
            'param_not_all' => 'Thông số là không đầy đủ',
            'config_err' => 'Lỗi cấu hình thanh toán bên thứ ba',

            'pay_money_err' => 'Vui lòng nhập số tiền bội số nguyên của tỷ lệ giao dịch',
        ],

        'drawing' => [
            'qk_pwd_required' => 'Vui lòng nhập mật khẩu rút tiền chính xác',
            'qk_pwd_error' => 'Lỗi nhập mật khẩu rút tiền，Xin vui lòng thử lại',
            'money_not_enough' => 'Số tiền rút ra lớn hơn số tiền hiện có，Xin vui lòng sửa đổi',
            'bank_not_exist' => 'Thông tin thẻ ngân hàng không tồn tại，Xin hãy kiểm tra',
            'time_not_allow' => 'Thời gian hiện tại không thể rút tiền',
            'min_money' => 'Số tiền rút ra ít hơn số tiền rút ra tối thiểu :min',
            'max_money' => 'Số tiền rút ra cao hơn số tiền rút ra tối đa :max',
            'times_not_enough' => 'Hôm nay có quá nhiều ứng dụng rút tiền，Hãy quay lại vào ngày mai',
            'drawing_success' => 'Đơn rút tiền được nộp thành công，Xin vui lòng chờ cho người quản trị xem xét',
            'drawing_fail' => 'Đơn rút tiền thất bại，Xin vui lòng thử lại:',
            'ml_calc_err' => 'Kích thước tính toán lỗi：'
        ],

        'message' => [
            'send_success' => 'Tín hiệu đã được gửi，Xin vui lòng chờ trả lời của người quản trị',
            'send_fail' => 'Việc gửi thư trong nhà ga đã thất bại，Xin vui lòng thử lại',
            'update_success' => 'Trạng thái tín hiệu trong trạm cập nhật：',
            'update_fail' => 'Cập nhật tình trạng tín hiệu trong trạm không thành công',
            'delete_success' => 'Đã thành công trong việc xoá thư',
            'delete_fail' => 'Lỗi xóa thư bên trong nhà ga'
        ],

        'modify_pwd' => [
            'password_error' => 'Mật khẩu gốc lỗi，Xin hãy kiểm tra',
            'password_success' => 'Sửa đổi mật khẩu thành công',
            'password_fail' => 'Sửa đổi mật khẩu thất bại',

            'qk_pwd_set' => 'Bạn đã đặt mật khẩu rút tiền，Không cần phải cài đặt một lần nữa',
            'qk_pwd_success' => 'Mật khẩu rút tiền đã được thiết lập',
            'qk_pwd_fail' => 'Mật khẩu rút tiền đã thất bại',
            'qk_pwd_error' => 'Mật khẩu rút tiền gốc là sai，Xin hãy kiểm tra',
            'qk_pwd_set_success' => 'Sửa đổi mật khẩu rút tiền thành công',
            'qk_pwd_set_fail' => 'Sửa đổi mật khẩu rút tiền đã thất bại'
        ],

        'redbag' => [
            'not_open' => 'Chức năng này đã bị tắt',
            'no_times' => 'Hôm nay, số lần cướp một phong bì màu đỏ đã lên đến giới hạn，Hãy quay lại vào ngày mai',
            'success' => 'Xin chúc mừng，Lấy số tiền :money Lì xì đỏ，Hãy kiểm tra sổ sách trong hồ sơ giao dịch'
        ],

        'dailybonus' => [
            'not_open' => 'Chức năng đăng nhập chưa được mở',
            'no_times' => 'Hôm nay anh đã đăng ký，Không cần phải đăng ký lần nữa',
            'success' => 'Đăng nhập thành công',
            'fail' => 'Đăng nhập thất bại',
            'check_day_not_enough' => 'Không đáp ứng yêu cầu nhận được，Xin hãy kiểm tra',
            'check_repeat' => 'Bạn đã nhận được phần thưởng đăng ký này hoặc trong đơn xin việc，Không được lặp lại',
            'check_success' => 'Phần thưởng đăng ký nhận được thành công',
            'check_admin_check' => 'Đơn đăng ký đã được nộp thành công，Xin vui lòng chờ cho người quản trị xem xét',
            'get_bonus_success' => 'Thành viên 【 :name 】 Nhận phần thưởng đăng nhập 【₫ :money】',
        ],

        'fs_now' => [
            'get_success' => 'tốc độ thời gian thực đã thành công，Hãy xem các chi tiết trong hồ sơ giao dịch',
            'fs_level_err' => 'Không có lớp choàn trả，Xin vui lòng liên hệ với dịch vụ khách hàng',
            'fs_no_data' => 'Không có khoản giảm giá để yêu cầu',
            'fs_not_open' => 'Tính năng này chưa được mở',
            'fs_repeat' => 'Phần hoàn trả đọng này đã được thu gom, vui lòng không lặp lại thao tác'
        ],

        'yuebao' => [
            'plan_require' => 'Hãy chọn cách mua',
            'amount_regex' => 'Số tiền mua phải là gấp 10 lần',
            'plan_not_exist' => 'Kế hoạch mua hàng không tồn tại',
            'plan_sold_out' => 'Chương trình đã được bán ra',
            'no_enough_amount' => 'Số lượng mua hàng vượt quá giới hạn，Xin vui lòng thử lại',
            'member_no_money' => 'Số dư tài khoản là không đủ，Xin vui lòng nạp tiền',
            'success' => 'Mua thành công',
            'back_success' => 'Chuộc lại thành công，【Cho chính+Tiền lãichúng】chuvash【 :money Đô la】Đã được chuyển vào tài khoản của bạn'
        ],

        'transfer' => [
            'api_not_open' => 'Không mở',
            'change_hand' => 'Đã chuyển sang【Hướng dẫn sử dụng vào trò chơi】Mô hình',
            'change_auto' => 'Đã chuyển sang【Tự động chuyển vào trò chơi】Mô hình',

            'field' => [
                'fs_money' => 'Ví hoàn trả',
                'money' => 'Ví chính'
            ]
        ],

        'team' => [
            'not_direct_child' => 'Tài khoản này không phải là tài khoản của bạn trực tiếp cấp dưới，Không thể hoạt động',
            'member_name_regex' => 'Tên người dùng phải bắt đầu với chữ cái thường và chỉ có thể chứa chữ cái thường và số',
            'not_set_rate' => 'Hãy đặt các dấu chấm trở lại cho tất cả các loại trò chơi',
        ],

        'register' => [
            'captcha_required' => 'Hãy nhập đúng captcha',
            'register_fail' => 'Đăng ký thất bại',
            'register_success' => 'Đăng ký thành công',
            'invite_code_required' => 'Vui lòng điền thông tin mã mời'
        ],

        'login' => [
            'name_psd_err' => 'Tài khoản hoặc mật khẩu sai',
            'demo_not_open' => 'Hệ thống không mở chức năng thử nghiệm',
        ],

        'activity' => [
            'no_need_apply' => 'Không cần phải đăng ký cho sự kiện này',
            'apply_repeat' => 'Anh đã đăng ký vào hôm nay，Không lặp lại các ứng dụng',
            'apply_success' => 'Ứng dụng thành công，Hãy chờ kết quả xử lý',
            'apply_fail' => 'Đơn xin thất bại，Xin vui lòng thử lại',
        ],

        'wheel' => [
            'wheel_desc' => 'Tiết kiệm tối thiểu tại giải trí sands vào ngày đó :money Nhiều hơn，Và tổng số tiền đặt cược hiệu quả đáp ứng yêu cầu tối thiểu tiền gửi cho quà tặng :times Nhiều hơn và nhiều hơn，Sẽ nhận được số lượt may mắn，Và có cơ hội tiếp cận :award ，Không giới hạn，Nhanh chóng tham gia！'
        ],

        'credit_pay' => [
            'not_open' => '【Mượn season】Chưa được mở',
            'member_not_exist_or_forbidden' => 'Các thành viên không tồn tại hoặc bị vô hiệu hóa',
            'member_info_error' => 'Thông tin thành viên nhập sai',
            'user_credit_remained' => 'Truy vấn bạn vẫn còn nợ，Xin vui lòng trả nợ sau khi vay tiền',
            'borrow_max' => 'Lên đến vay mượn【 :money Đô la】',
            'borrow_success' => 'Ứng dụng đã được gửi，Hãy đến đó trong 2 giờ nữa“Truy vấn tín dụng”Cho dù vay mượn thành công',
            'lend_total' => 'Xin vui lòng hoàn thành tất cả các khoản nợ tại một thời điểm',
            'money_not_enough' => 'Hãy đảm bảo tài khoản chính có đủ tiền để trả nợ',
            'lend_success' => 'Trả nợ thành công'
        ],

        'game' => [
            'not_login' => 'Xin vui lòng đăng nhập',
            'no_api_code' => 'cần api_code Tham số',
            'api_member_lang_not_equal' => 'Đơn vị tiền tệ giao diện đã nhập không nhất quán với đơn vị tiền tệ thành viên',
            'demo_game' => 'Thử tài khoản chỉ có thể truy cập vào hệ thống màu giao diện',
            'api_code_not_exist' => 'Ví trò chơi không tồn tại，Xin hãy kiểm tra',
            'api_code_not_open' => 'Ví trò chơi không được mở，Hãy chọn trò chơi khác',
            'operate_fail' => 'Hoạt động thất bại，:msg Xin vui lòng liên hệ với dịch vụ khách hàng',
            'member_api_create_err' => 'Thành viên thành lập địa phương API Tài khoản thất bại',
            'api_money_not_enough' => 'Số dư Ví cân bằng là không đủ，Xin vui lòng liên hệ với dịch vụ khách hàng',
            'member_money_not_enough' => 'Số dư tài khoản là không đủ，Không thể chuyển Ví :money Đô la',
            'api_money_transfer_fail' => 'Khoản khấu trừ tài khoản thất bại，',
            'api_money_transfer_add_fail' => 'Nhập vào các trò chơi sau khi tăng số lượng giao diện hoạt động ngoại lệ，',
            'api_money_transfer_back_fail' => '【 :title】 Ví trò chơi hoàn lại số tiền tài khoản hoạt động ngoại lệ，',
            'api_money_transfer_err' => 'chuyển vào【 :title】 Ví thất bại，Thông tin sai lệch:',
            'api_money_transfer_success' => 'Chuyển vào【 :title】 Ví thành công',

            'transfer_out_error' => '【 :money】 Ví cân bằng là không đủ，Biến trò chơi thất bại',
            'transfer_out_api_error' => 'Chuyển hạn ngạch Ví [:title] ra khỏi trò chơi không thành công, thông báo lỗi:',
            'transfer_out_add_error' => 'Sau khi chuyển Ví [:title], số tiền Ví bị trừ và số tiền tài khoản người dùng tăng lên. Thao tác bất thường:',
            'transfer_out_success' => 'Chuyển ra 【:title】 Trò chơi thành công',
            'api_parameter_err' => 'Thông số hệ thống không chính xác',
            'lottery_error' => 'Lỗi địa chỉ màu hệ thống，Không mở tính năng vé số địa phương，Xin vui lòng liên hệ với người mở tài khoản',
            'lottery_api_not_exist' => 'Lỗi địa chỉ màu hệ thống，Không mở tính năng vé số địa phương，Xin vui lòng liên hệ với người mở tài khoản',
        ],

        'agent_fd_rates' => [
            'lower_than_system' => 'Các loại trò chơi【 :game_type】Phản lực không thể thấp hơn vị trí thấp nhất của hệ thống【 :rate】',
            'higher_than_system' => 'Các loại trò chơi【 :game_type】Không thể cao hơn điểm cao nhất của hệ thống【 :rate】',
            'rate_not_set' => 'Loại trò chơi của bạn【 :game_type】Vẫn chưa thiết lập，Xin hãy liên lạc với người quản lý cao cấp của bạn',
            'child_rate_err' => 'Các loại trò chơi cấp dưới【 :game_type】kích thước của hoàn trả không thể cao hơn chính nó【 :rate】',
            'top_rate_err' => 'Các loại trò chơi【 :game_type】Không thể thấp hơn điểm cao nhất của cấp dưới của đại lý【 :rate】',
            'agent_rate_err' => 'Các loại trò chơi【 :game_type】 số lượng của hoàn trả không thể cao hơn chính nó【 :rate】',
        ],

        'invite_rate' => [
            'self_rate_err' => 'Mời đăng ký liên kết【 :game_type】Kiểu trả lại không thể cao hơn chính bạn',
            'lower_than_system' => 'Mời đăng ký liên kết【 :game_type】Kiểu điểm trở về không thể thấp hơn vị trí thấp nhất mà hệ thống đã đặt【 :rate】'
        ],

        'captcha' => [
            'check_err' => 'Lỗi mã xác minh',
            'out_of_date' => 'Captcha đã hết hạn，vui lòng thử lại',
        ],

        'task' => [
            'no_task' => 'Không có nhiệm vụ phải làm',
            'task_complete_title' => 'Thông báo nhiệm vụ hoàn thành',
            'task_complete_desc' => 'Chúc mừng bạn đã hoàn thành nhiệm vụ【 :title】，Nhiệm vụ thưởng：',
            'level_up_desc_start' => 'Phát hành các thành viên【 :name】từ【:old_level Khoảng 12】đến【:level Khoảng 12】Của các phần thưởng，Phần thưởng bao gồm：“',
            'level_up_award' => 'Kim phần thưởng',
            'level_up_title' => 'Thông báo phân phát phần thưởng',
            'level_up_desc' => 'Xin chúc mừng bạn nhận được【 :old_level Khoảng 12 ~ :level Khoảng 12】Kim phần thưởng。',
            'week_award_title' => 'Trợ cấp cho bạn',
            'week_award_desc' => 'Xin chúc mừng bạn nhận được【 :level Khoảng 12】Ben châu【 :money Đô la】',
            'month_award_title' => 'Sự trợ cấp của tháng này',
            'month_award_desc' => 'Xin chúc mừng bạn nhận được【 :level Khoảng 12】Bằng cách này【 :money Đô la】'
        ],

        'level_config' => [
            'level_up_award_title' => 'Thông báo phát hành quà tặng khuyến mại',
            'level_up_award_desc' => 'Chúc mừng bạn đã nâng cấp lên【 :level_name】，Phần thưởng nâng cấp là【:money Nhân dân tệ】,Phần thưởng hạn mức tín dụng 【:credit Nhân dân tệ】',
            'level_up_award_msg' => 'Các thành viên【 :name】Nhận【 :level】Quà tặng thăng hạng【 :money Nhân dân tệ】,Phần thưởng hạn mức tín dụng 【:credit Nhân dân tệ】',

            'day_bonus_award_title' => 'Thông báo phát hành quà tặng hàng ngày',
            'day_bonus_award_desc' => 'Chúc mừng bạn đã nhận được【 :level Mức độ】Quà tặng hàng ngày【 :money Nhân dân tệ】',
            'day_bonus_award_msg' => 'Các thành viên nhận【 :levelMức độ】Quà tặng hàng ngày, phần thưởng【 :money Nhân dân tệ】',

            'week_bonus_award_title' => 'Thông báo quà tặng hàng tuần',
            'week_bonus_award_desc' => 'Chúc mừng bạn đã nhận được【 :level Mức độ】Quà tặng hàng tuần【 :money Nhân dân tệ】',
            'week_bonus_award_msg' => 'Các thành viên nhận【 :levelMức độ】Quà tặng hàng tuần, phần thưởng【 :money Nhân dân tệ】',

            'month_bonus_award_title' => 'Thông báo phát hành quà tặng hàng tháng',
            'month_bonus_award_desc' => 'Chúc mừng bạn đã nhận được【 :level Mức độ】Quà tặng hàng tháng【 :money Nhân dân tệ】',
            'month_bonus_award_msg' => 'Các thành viên nhận【 :levelMức độ】Quà tặng hàng tháng, phần thưởng【 :money Nhân dân tệ】',

            'year_bonus_award_title' => 'Thông báo phát hành quà tặng hàng năm',
            'year_bonus_award_desc' => 'Chúc mừng bạn đã nhận được【 :level Mức độ】Hằng năm, tiền quà【 :money Nhân dân tệ】',
            'year_bonus_award_msg' => 'Các thành viên nhận【 :levelMức độ】Quà tặng và phần thưởng hàng năm【 :money Nhân dân tệ】',
        ]
    ],

    'configs' => [
        "is_redbag_open" => "Có mở lì xì đỏ hay không",
        "redbag_min_money" => "Số tiền phong bao lì xì tối thiểu",
        "redbag_max_money" => "Số tiền lì xì đỏ tối đa",
        "redbag_day_times" => "Số lượng lì xì đỏ mỗi ngày",
        "is_daily_bonus_open" => "Có mở đăng nhập hay không",
        "is_daily_bonus_auto" => "Đăng nhập có tự động nhận giải thưởng hay không",
        "activity_money_type" => "Các loại ví phân phối phần thưởng sự kiện",
        "member_fs_money_type" => "Thành viên hoàn trả phát hành ví",
        "is_realtime_fs_mode" => "Có bật chế độ hoàn trả theo thời gian hay không",
        "activity_yuebao_plan_enable" => "Có mở gói Hồng Bao để mua hay không",
        "activity_yuebao_enable" => "Có mở Hồng Bao hay không",
        "activity_wheel_is_open" => "Có bật hoạt động bàn xoay may mắn hay không",
        "is_system_maintenance" => "Có bật bảo trì hệ thống hay không",
        "system_maintenance_whitelist" => "Danh sách trắng IP bảo trì hệ thống",
        "site_domain" => "Tên miền trạm hoạt động",
        "wap_qrcode" => "Mã QR tải xuống APP trên điện thoại di động",
        "wap_app_link" => "Địa chỉ tải xuống APP di động",
        "service_link" => "Liên kết dịch vụ khách hàng",
        "kefu_wechat_qrcode" => "Mã QR dịch vụ khách hàng WeChat",
        "site_logo" => "Logo trang web",
        "site_logo2" => "LOGO thay thế trang web",
        "kefu_qq" => "QQ dịch vụ khách hàng",
        "site_email" => "Hộp thư trang web",
        "site_slogan" => "Logo phụ của trang web",
        "site_pc" => "Địa chỉ máy tính",
        "site_mobile" => "URL điện thoại di động",
        "is_scroll_adv_open" => "Có bật quảng cáo cuộn hay không",
        "is_demo_play_open" => "Có bật chức năng dùng thử hay không",
        "is_open_register" => "Có mở trang đăng ký hay không",
        "activity_jiebei_enable" => "Có mở cho mượn hay không",
        "transfer_start" => "Thời gian bắt đầu rút tiền",
        "transfer_end" => "Thời hạn rút tiền",
        "min_transfer" => "Số tiền rút tối thiểu",
        "max_transfer" => "Số tiền rút tối đa",
        "ml_percent" => "Phần trăm mã",
        "ml_drawing_percent" => "Tỷ lệ phần trăm phí rút tiền khi số lượng mã còn lại",
        "daili_active_money" => "Tiêu chuẩn số tiền nạp cho thành viên đang hoạt động",
        "agent_fd_mode" => "Có bật chế độ proxy không giới hạn hay không",
        "is_auto_agent" => "Đăng ký thành viên mặc định là đại lý",
        "notice_type" => "Chế độ nhắc nhở",
        "yuebao_audio" => "Yu'e Bao mua nhắc nhở âm thanh",
        "activity_audio" => "Lời nhắc bằng giọng nói ứng dụng sự kiện",
        "message_audio" => "Lời nhắc bằng giọng nói",
        "member_audio" => "Lời nhắc bằng giọng nói đăng nhập của người chơi",
        "drawing_audio" => "Âm thanh nhắc nhở rút tiền",
        "rechargel_audio" => "Nạp tiền nhắc nhở bằng giọng nói",
        "agent_apply_audio" => "Ứng dụng đại lý chưa được xử lý",
        "credit_apply_audio" => "Ứng dụng mượn chưa được xử lý",
        "credit_overdue_audio" => "Mượn lời nhắc quá hạn",
        "system_maintenance_message" => "Lời nhắc bảo trì trang web",
        "bank_desc" => "Hồ sơ công ty",
        "site_title" => "Tiêu đề trang web",
        "site_keyword" => "Từ khóa trang web",
        "site_name" => "Tên trang web",
        "online_pay_title" => "Thanh toán trực tuyến chức danh",
        "online_pay_desc" => "Giới thiệu thanh toán trực tuyến",
        "company_pay_title" => "Tiêu đề thu nhập công ty",
        "company_pay_desc" => "Giới thiệu thu nhập của công ty",
        "register_remark" => "Hướng dẫn đăng ký",
        "register_agreement" => "Thỏa thuận đăng ký",
        "nav_jiechi" => "Hướng dẫn chiếm quyền điều khiển",
        "guideline_desc" => "Mô tả dòng đơn giản",
        "hotgame_desc" => "Mô tả trò chơi phổ biến",
        "wheel_rule" => "Các điều khoản và quy tắc hoạt động của bàn xoay may mắn",
        "credit_detail" => "Thông tin chi tiết về hoạt động mượn",
        "credit_rule" => "Quy tắc tín dụng vay",
        "credit_xize" => "Quy tắc chi tiết cho các hoạt động mượn",
        "credit_borrow" => "Hướng dẫn vay",
        "credit_lend" => "Hướng dẫn vay và trả nợ",
        "levelup_slot_activity" => "Chi tiết về các hoạt động nâng cấp điện tử slot",
        "levelup_slot_example" => "Ví dụ về các hoạt động nâng cấp điện tử Slot",
        "levelup_slot_level" => "Hướng dẫn nâng cấp điện tử Slot",
        "levelup_slot_month" => "Mô tả tiền lương hàng tháng nâng cấp điện tử Slot",
        "levelup_live_activity" => "Chi tiết về các hoạt động nâng cấp trực tiếp",
        "levelup_live_example" => "Ví dụ về các hoạt động nâng cấp trực tiếp",
        "levelup_live_level" => "Hướng dẫn nâng cấp trực tiếp",
        "levelup_live_month" => "Giải thích về mức thưởng hàng tháng của người thực được nâng cấp",
        "app_tuiguang" => "Hướng dẫn quảng bá",
        "app_xima" => "Hướng dẫn dùng code",
        "app_fanyong" => "Tỷ lệ hoàn trả",
        "app_xima_text" => "Hướng dẫn sử dụng code",
        "activity_shengji_enable" => "Có bật hoạt động nâng cấp hay không",
        "vip1_is_register_sms_open" => "Có bật xác minh SMS đã đăng ký hay không",
        "service_link" => "Liên kết dịch vụ khách hàng",
        "service_line" => "Line",
        "service_line_pic" => "Line Mã hai chiều",
        "service_phone" => "Điện thoại",
        "service_phone2" => "Điện thoại 2",
        "is_backend_google_auth" => "Đăng nhập nền có bật mã xác minh của Google hay không",
        "service_skype" => "Skype",
        "service_telegram" => "Telegram",
        "service_logo_link" => "Liên kết LOGO",
        "vip1_is_login_captcha_open" => "Có bật mã xác minh đăng nhập thành viên hay không",

        "vip1_lang_default" => "Ngôn ngữ mặc định giao diện người dùng",
        "vip1_lang_fields" => "Ngôn ngữ mở giao diện người dùng"
    ],

    'agent_page' => [
        'login' => [
            'username' => 'tên tài khoản',
            'password' => 'mật khẩu',
            'captcha' => 'Mã xác nhận',
            'refresh' => 'Nhấp vào làm mới',
            'login' => 'đăng nhập ngay lập tức',
        ],

        'basic' => [
            'main_title' => 'Nền quản lý đại lý',
        ],

        'title' => [
            'main' => 'Trang chủ nền',
            'offline' => 'Thành viên tuyến dưới',
            'offline_list' => 'Danh sách tuyến dưới',
            'promote_site' => 'Trang web khuyến mãi',
            'agent_report' => 'Báo cáo đại lý',
            'recharge_list' => 'Lịch sử nạp tiền thành viên',
            'drawing_list' => 'lịch sử rút tiền của thành viên',
            'money_log' => 'Hồ sơ thay đổi số dư tuyến dưới',
            'fd_logs' => 'Bản ghi điểm trả về ngoại tuyến',
            'game_records' => 'Báo cáo thắng thua của thành viên'
        ],

        'notice' => [
            'traditional_only' => 'Chỉ có chế độ Đại Lý cơ bản có thể truy cập trang này. Hiện tại, nó là chế độ Đại Lý Cao Cấp.',
            'allagent_only' => 'Chỉ có Đại Lý Cao Cấp có thể truy cập trang này. Hiện tại, nó là chế độ Đại Lý Cơ bản.',
            'rate_not_exist' => 'Không có thông tin về gói hàng',
            'direct_rate_modify' => 'Chỉ có thể sửa đổi các điểm cấp dưới trực tiếp'
        ],

        'desc' => [
            'offline_num' => 'Số bộ phận ngoại tuyến',
            'agent_default_rate' => 'Giảm giá mặc định của Đại Lý',
        ],

        'field' => [
            'is_agent' => 'Đại Lý hay là không',
            'register_at' => 'Thời gian ký',
            'own_rate' => 'Tự về',
            'unset' => 'Chưa đặt',
            'offline_default_rate' => 'Giá trị mặc định',
            'pc_agent_url' => 'PCTrang web quảng cáo',
            'wap_agent_url' => 'WAPTrang web quảng cáo',
            'qrcode_title' => 'Quảng cáo mã QR',
            'time_range' => 'Bắt đầu và kết thúc thời gian',

            'total_deposit' => 'Tổng nạp',
            'recharge_count' => 'Số lần đầu',
            'total_drawing' => 'Tổng rút tiền',
            'drawing_count' => 'Số lần rút tiền',
            'dividend_hongli' => 'Tiền thưởng',
            'dividend_activity' => 'Năng lực',
            'dividend_fs' => 'Name',
            'dividend_other' => 'khác',
            'total_profit' => 'Tổng lợi nhuận',
            'member_win_and_loss' => 'Thành viên thắng hay thua',

            'add_sub' => 'tăng/giảm',
            'fs_center' => 'Name/Ví chính',

            'api_name' => 'tên API'
        ],

        'btn' => [
            'set_offline_default' => 'Đặt giảm giá mặc định cho cấp thấp',
            'qrcode' => 'Xem mã QR'
        ]
    ]
];
