// ;(function (win, doc, $){
//     $.fn.util = function(){

//     }
// })(window, document, jQuery);


$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

jQuery.utils = {
    init: function() {
        // js 全局函数
        layer = parent.layer;
        this.ajaxSetup();
        this.adjustArea();

        $(document).ajaxError(function(
            event,
            XMLHttpRequest,
            textStatus,
            errorThrown
        ) {
            //console.log(event,XMLHttpRequest,textStatus,errorThrown)
            // layer.close($.ajaxSetup.layerIndex);
            // var returnMsg = "错误：";
            // if (XMLHttpRequest.responseJSON)
            //     returnMsg += XMLHttpRequest.responseJSON.message;
            // layer.alert(returnMsg, { title: "错误提示" });
            $.ajaxSetup().error(XMLHttpRequest, textStatus, errorThrown);
        });
        this.operateListenerInit();

        this.configCheckbox();

        // 解决input number 输入框数字滚动 的问题
        $('input[type="number"]').bind('mousewheel', function(){
            return false;
        });

        //this.configImageUpload();

        this.quickTextConfig();

        this.configLayDate();

        if(typeof(jQuery.fn.select2) == 'function'){
            $(".js_select2").select2();
        }
    },

    // serialize 方法无法读取 checkbox 的值，配合点击事件，生成一个hidden的input
    configCheckbox: function() {
        var _this = this;
        $("form .switch-col").on("click", 'input[type="checkbox"]', function() {
            var name = $(this).attr("name");
            var value_true = $(this).data("true") ? $(this).data("true") : 1;
            var value_false = $(this).data("false") ? $(this).data("false") : 0;

            if ($(this).is(":checked")) {
                $(this).val(value_true);
                _this.createOrUpdateInputValue($(this), name, value_true);
                //$(this).parent().find('input[type="hidden"][name="' + name + '"]').remove();
            } else {
                $(this).val(value_false);
                _this.createOrUpdateInputValue($(this), name, value_false);
                //$(this).parent().append('<input type="hidden" name="' + name + '" value="'+value_false+'">');
            }
        });
    },

    // 创建或者更新checkbox 旁边hidden input 的值
    createOrUpdateInputValue: function($obj, name, value) {
        var $hidden = $obj
            .parent()
            .find('input[type="hidden"][name="' + name + '"]');

        if ($hidden.length) {
            $hidden.val(value);
        } else {
            $obj.parent().append(
                '<input type="hidden" name="' +
                    name +
                    '" value="' +
                    value +
                    '">'
            );
        }

        value ? $hidden.remove() : '';
    },

    // 点击文字 赋值到文本框
    // 使用方法 class="quick-text" data-target="group_name"
    quickTextConfig:function(){
        $('.quick-text').click(function(){
            $('[name="'+$(this).data('target')+'"]').val($(this).html().toString().trim())
        });
    },

    configImageUpload: function() {
        var $objs = $('[data-component="imageUpload"]');
        if ($objs.length > 0) {
            $objs.each(function(index, element) {
                var field = $(element).data("field-name");
                $(element).imageUpload({
                    $callback_input: $('.form-control[name="' + field + '"]'),
                    showErrorDialog: $.utils.layerError,
                    showSuccessDialog: $.utils.layerSuccess
                });
            });
        }
    },

    //日期时间范围
    configLayDate:function(){
        var $objs = $('[data-laydate-component]');

        var lang = document.querySelector('html').lang;
        lang = lang.indexOf('zh') != -1 ? 'zh' : 'en';

        if ($objs.length > 0) {
            $objs.each(function(index, element) {
                var field = $(element).attr("name");

                var config = {
                    elem: '[name='+field+']',
                    type: $(element).data('laydate-component').toString().indexOf('datetime') == 0 ? 'datetime' : $(element).data('laydate-component'),
                    theme: "#33cabb",
                    lang: lang,
                };

                if(config.type == 'datetime' && $(element).data('laydate-component').toString() == 'datetime') config.range = "~";
                laydate.render(config);
            });
        }
    },

    area: ["960px", "80%"],
    adjustArea: function() {
        if (document.body.clientWidth < 960)
            return (this.area = ["100%", "80%"]);
    },

    ajaxSetup: function() {
        $.ajaxSetup({
            layerIndex: -1,
            isAuto:false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            beforeSend: function(event,request,ajaxOptions) {
                // console.log(event, request, ajaxOptions);
                //if(request.url.indexOf('loading=false') == -1){

                if((request.data && typeof(request.data) == 'string' && request.data.indexOf('loading=false'))
                    || !request.data || typeof(request.data) != 'string'){
                    this.isAuto = true;
                    this.layerIndex = layer.load(2, {
                        shade: [0.2, "#ccc"] //遮罩层背景色、透明度,
                    });
                }
            },
            complete: function() {
                layer.close(this.layerIndex);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                // console.log(XMLHttpRequest, textStatus, errorThrown)
                /**
                 * XMLHttpRequest.status HTTP 状态码
                 */

                console.log('error',this.data,this.data === undefined);
                layer.close(this.layerIndex);

                if(XMLHttpRequest.status == 401){
                    alert(XMLHttpRequest.responseJSON.message);

                    console.log(XMLHttpRequest.responseJSON.redirect)
                    if(XMLHttpRequest.responseJSON.redirect)
                        window.location.href = XMLHttpRequest.responseJSON.redirect
                    else
                        window.location.reload()
                }

                if((this.data && this.data.indexOf('loading=false') == -1) || !this.data ){
                    var langFunc = $.utils.getLangs;
                    var returnMsg = langFunc('error_title');
                    if (XMLHttpRequest.responseJSON){
                        returnMsg += XMLHttpRequest.responseJSON.message;
                        layer.alert(returnMsg, { title: langFunc('error_notice'),btn:[langFunc('btn_yes'),langFunc('btn_no')] });
                    }
                }
            }
        });
    },

    // 监听有 data-operate 的元素
    operateListenerInit: function() {
        $(document).on("click", "[data-operate]", function() {
            var _this = this;
            var button = $(this);
            var operate = button.data("operate");

            if (operate === "ajax-submit") {
                return $.utils.handleFormSubmit(button);
            }

            if (operate === "show-image") {
                return $.utils.showBigImage(button.data("src"));
            }

            if (operate === "select-icon") {
                return $.utils.showIconSelectPage();
            }

            var url = button.data("url");
            if (!url) throw "请先定义元素的 data-url 属性";

            if(operate === 'simple-deal'){
                return $.utils.simpleAjaxRequest(url,button.data("method") || 'get',button)
            }

            if (operate === "alert-deal") {
                return $.utils.handleButtonDelete(
                    button,
                    url,
                    button.data("method")
                );
            }

            // 删除单个文件，多个文件，退出登录时调用
            if (operate === "delete") {
                return $.utils.handleButtonDelete(button, url);
            }

            if(operate === "batch"){
                return $.utils.handleButtonBatch(button,url);
            }

            if (operate === "show-uploader") {
                return $.utils.showPictureUpload(url);
            }

            // 详情页面展示
            if (operate === "show-page") {
                return $.utils.showDetailPage(url, button.data("reload"),button.data("title"));
            }

            // iframe 页面展示
            if (operate === "iframe-page") {
                return $.utils.showIframePage(url, button.data("title"));
            }
        });
    },

    // 获取批量删除的ids数据
    getBatchDeleteData: function() {
        var ids = [];
        Array.prototype.forEach.call($("input[name='ids[]']"), function(elem) {
            if ($(elem).val() && $(elem).prop("checked") == true) {
                ids.push($(elem).val());
            }
        });

        return ids;
    },

    // 基础ajax请求，根据data-method,data-url进行处理
    simpleAjaxRequest:function(url,method,btn){
        $.ajax({
            type: method,
            url: url,
            success: function(data) {
                btn.attr("disabled", false);
                $.utils.dealWithResponse(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                btn.attr("disabled", false);
            }
        });
    },

    dealAjaxRequest: function(url, method, data, btn) {
        if (method.toLowerCase() == "delete") {
            // method = "post";
            data["_method"] = "delete";
        }

        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: "json",
            success: function(data) {
                btn.attr("disabled", false);
                // console.log(data);
                $.utils.dealWithResponse(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                btn.attr("disabled", false);
                // console.log(XMLHttpRequest, textStatus, errorThrown);
                // layer.alert(returnMsg, { title: "错误提示" });

                // 如果提交地址包含 login，并且有 #captcha元素，则刷新验证码
                if(window.location.href.toString().indexOf('login') && $('#captcha')){
                    $('#captcha').click();
                }
            }
        });
    },

    // 处理ajax响应数据
    dealWithResponse: function(data) {
        if (!data.message) {
            // layer.alert(data.message);
            // data.message = "操作成功";
            data.message = this.getLangs('success_message');
        }

        this.layerSuccess(data.message);

        // 有url参数，表示当前页面跳转
        if (data.url) {
            setTimeout(function() {
                window.location.href = data.url;
            }, 1000);
        }

        // 有redirect参数表示，top页面跳转
        if (data.redirect) {
            setTimeout(function() {
                parent.window.location.href = data.redirect;
            }, 1000);
        }

        if (data.reload) {
            setTimeout(function() {
                window.location.reload();
            }, 1000);
        }

        if (data.close_reload) {
            // 获取打开该iframe 的页面
            var iframe_id = $(document)
                .find("#iframe_id")
                .val();
            setTimeout(function() {
                // 关闭当前layer
                $.utils.closeIframeLayer();
                // console.log($.utils.getSiblingFrame(iframe_id));
                $.utils.getSiblingFrame(iframe_id).location.reload(true);
            }, 1000);
        }
    },

    // 获取编辑器默认配置
    // 文本框dom，上传地址
    getTinymceConfig: function(dom, upload_url) {
        var lang = document.querySelector('html').lang;
        if(lang == 'en') lang = 'en_US';
        if(lang == 'zh_cn') lang = 'zh_CN';

        return {
            selector: dom,
            // language: "zh_CN",
            language: lang,
            directionality: "ltl",
            browser_spellcheck: true,
            contextmenu: false,

            valid_elements:'*[*]',

            height: 480,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools wordcount",
                "code"
            ],
            toolbar:
                "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
            // images_upload_credentials: true,
            convert_urls: false,
            images_upload_url: upload_url, // 后端返回的json格式{ location : "/demo/image/1.jpg" }
            images_upload_handler: function(blobInfo, success, failure) {
                formData = new FormData();
                formData.append("file", blobInfo.blob(), blobInfo.filename());
                $.ajax({
                    url: upload_url,
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        success(data.file_url); // 这里为图片上传成功之后所获取的图片路径赋值给下面的截图中的地址一栏
                    },
                    error: function(e) {
                        $.utils.layerError("图片上传失败");
                    }
                });
            }
        };
    },

    // 表单的提交事件 data-operate="ajax-submit"
    handleFormSubmit: function(btn) {
        btn.attr("disabled", true);

        var go = true;
        var form = btn.parents("form");

        var url = form.attr("action");
        var method = form.attr("method");

        //var data = form.serialize();

        var data = form.serializeObject();

        // 带上tinymce的参数
        if (btn.data("tinymce")) {
            /*
            data +=
                "&" +
                btn.data("tinymce") +
                "=" +
                tinymce.activeEditor.getContent();
                */

            // data += this.getEditorContentData(btn.data("tinymce"));
            data = this.getEditorContentData(btn.data("tinymce"),data);
        }

        // 循环处理 checkbox
        if(form.find('.switch-col input[type="checkbox"]').length > 0){
            $('input[type="checkbox"]').each(function(){
                // 只有在表格的td中的开关才可以有多个 数组参数
                if($(this).parent().parent().get(0).tagName != 'TD'){
                    var checkbox_name = $(this).attr('name');
                    if(typeof data[checkbox_name] == 'object'){
                        data[checkbox_name] = data[checkbox_name][0];
                    }
                }
            });
        }

        // 带上 select2 选项

        // if(btn.data("select2")){
        // console.log('select2',this.getSelect2ContentData(btn.data("select2")));
        // data += this.getSelect2ContentData(btn.data("select2"));
        // }

        var rest_method = form.find("input[name='_method']");
        var method = rest_method.length > 0 ? rest_method.val() : method;

        if (go == true) {
            return $.utils.dealAjaxRequest(url, method, data, btn);
        }
    },

    getEditorContentData(id,data) {

        if (id.indexOf(",") != -1) {
            var result = "";
            var _this = this;

            id.split(",").forEach(function(item, index) {
                /**
                result += _this.generateQueryData(
                    item,
                    tinymce.editors[index].getContent()
                );
                 */

                data[item] = tinymce.editors[item].getContent();
            });

            return data;
        } else {
            /*
            return this.generateQueryData(
                id,
                tinymce.activeEditor.getContent()
            );
            */

            data[id] = tinymce.get(id) ? tinymce.get(id).getContent() : tinymce.activeEditor.getContent();

            return data;
        }
    },

    getSelect2ContentData(id) {
        if (id.indexOf(",")) {
            var result = "";
            var _this = this;

            id.split(",").forEach(function(item, index) {
                result += _this.generateQueryData(
                    item,
                    _this.convertArrayToString($("#" + item).val())
                );
            });

            return result;
        } else {
            return this.generateQueryData(
                id,
                this.convertArrayToString($("#" + id).val())
            );
        }
    },

    convertArrayToString(data) {
        if (data instanceof Array) {
            return data.join(",");
        } else {
            return data;
        }
    },

    generateQueryData(key, value) {
        return "&" + key + "=" + value;
    },

    generateQueryObj(key,value){

    },

    // 按钮的删除事件
    handleButtonDelete: function(button, url, method) {
        var title = button.data("title");
        var message = button.data("message");

        if (!title) title = this.getLangs('delete_title');
        if (!message) message = this.getLangs('delete_message');
        if (!method) method = "delete";

        var data = {};
        // 如果是批量操作
        if (button.attr("id") == "batchDelete") {
            data["ids"] = this.getBatchDeleteData();

            if(!data["ids"].length){
                return $.utils.layerError(this.getLangs('delete_uncheck'));
            }
        }

        var langFunc = this.getLangs;

        // 危险操作提示
        return layer.confirm(message, { title: title,btn:[langFunc('btn_yes'),langFunc('btn_no')] }, function() {
            $.utils.dealAjaxRequest(url, method, data, button);
        });
    },

    /**
     * 批量操作事件
     */
    handleButtonBatch:function(button,url,method){
        var title = button.data("title");
        var message = button.data("message");

        if (!title) title = this.getLangs('delete_title');
        if (!message) message = this.getLangs('batch_message');
        if (!method) method = "post";

        var data = {};
        data["ids"] = this.getBatchDeleteData();
        if(!data["ids"].length){
            return $.utils.layerError(this.getLangs('delete_uncheck'));
        }

        var langFunc = this.getLangs;

        // 危险操作提示
        return layer.confirm(message, { title: title,btn:[langFunc('btn_yes'),langFunc('btn_no')] }, function() {
            $.utils.dealAjaxRequest(url, method, data, button);
        });
    },

    // 获取调用该方法的当前页面的 iframe_id
    getIframeId: function() {
        return (window.frameElement && window.frameElement.id) || "";
    },

    // 关闭当前Iframe显示层
    closeIframeLayer: function() {
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    },

    // 在子iframe中获取同级iframe的页面
    getSiblingFrame: function(id) {
        return parent.document.getElementById(id).contentWindow;
    },

    // 判断图片是否失效，dom表示 image的dom元素
    checkImageValid: function(url, dom) {
        if (dom.length) {
            var ImgObj = new Image();
            ImgObj.src = url;
            if (
                ImgObj.fileSize > 0 ||
                (ImgObj.width > 0 && ImgObj.height > 0)
            ) {
                return true;
            } else {
                dom.attr("src", "/images/img_error.jpg");
                if (dom.siblings("figcaption .btn-primary").length > 0) {
                    dom.siblings("figcaption .btn-primary").remove();
                }
            }
        }
    },

    showIframePage: function(url, title) {
        // 记录 iframe 的 id
        var iframe_id = this.getIframeId();
        return layer.open({
            type: 2,
            title: title,
            // area: ["800px", "80%"], //宽高
            area: this.area,
            anim: 2,
            shadeClose: false, //开启遮罩关闭
            content: url,
            success: function(layero, index) {
                //向iframe页的id=age的元素传值
                var body = layer.getChildFrame("body", index);
                // 这里的 icon_field 是用来存放调用页面的 iframe_id
                if(!body.find("#iframe_id").length){
                    body.append('<input type="hidden" id="iframe_id" value="'+iframe_id+'">');
                }else{
                    body.find("#iframe_id").val(iframe_id);
                }
            }
        });
    },

    // 显示详情页面
    showDetailPage: function(url, reload, title) {
        var langFunc = this.getLangs;
        return layer.open({
            type: 2,
            title: title || langFunc('detail_title'),
            shadeClose: false,
            shade: 0.5,
            maxmin: true, //开启最大化最小化按钮
            //area: ["893px", "600px"],
            area: this.area,
            content: url,
            end: function() {
                if (reload) {
                    window.location.reload();
                }
            }
        });
    },

    // 显示大图
    showBigImage: function(url) {
        return layer.ready(function() {
            layer.open({
                type: 1,
                title: false,
                closeBtn: 2,
                area: "auto",
                skin: "layui-layer-nobg", //没有背景色
                shadeClose: true,
                content: '<img src="' + url + '"/>'
            });
        });
    },

    // 显示图片选择界面
    showIconSelectPage: function() {
        var iframe_id = this.getIframeId();

        var langFunc = this.getLangs;

        return layer.open({
            type: 2,
            title: langFunc('select_icon_title'),
            //area: ["800px", "80%"], //宽高
            area: this.area,
            anim: 2,
            shadeClose: true, //开启遮罩关闭
            content: "/admin/iconlist",
            success: function(layero, index) {
                //向iframe页的id=age的元素传值
                var body = layer.getChildFrame("body", index);
                // 这里的 icon_field 是用来存放调用页面的 iframe_id
                body.find("#icon_field").val(iframe_id);
            }
        });
    },

    showPictureUpload: function(url) {
        // 调用页面的 iframe id
        var iframe_id = this.getIframeId();

        return layer.open({
            type: 2,
            // title: title,
            //area: ["800px", "80%"], //宽高
            area: this.area,
            anim: 2,
            shadeClose: false, //开启遮罩关闭
            content: url,
            success: function(layero, index) {
                //向iframe页面传值
                var body = layer.getChildFrame("body", index);
                // 这里的 iframe_id 是用来存放调用页面的 iframe_id
                body.find("#iframe_id").val(iframe_id);
            }
            // error: function(){
            //     $.utils.getSiblingFrame(iframe_id).$('#picture-url').removeAttr('id')
            // }
        });
    },

    layerError: function($msg) {
        layer.msg($msg, {
            icon: 5,
            shade: 0.3,
            time: 1000
        });
    },

    layerSuccess: function($msg) {
        layer.msg($msg, {
            icon: 1,
            shade: 0.3,
            time: 1000
        });
    },

    getLangs: function(key){
        var language = {
            zh_cn:{
                'error_title':'错误：',
                'error_notice':'错误提示：',
                'success_message':'操作成功',
                'delete_title':'操作提醒',
                'delete_message':'确定进行删除操作吗',
                'delete_uncheck':'请勾选需要操作的列',
                'batch_message':'确定进行批量操作吗',
                'detail_title':'详情页面',
                'select_icon_title':'点击选择图标',
                'btn_yes':'确定',
                'btn_no':'取消',
                'new_msg_notice':'您有新的信息请及时处理',

                // menu
                'show_active_tab':'显示当前选项卡',
                'close_all_tabs':'关闭所有标签页',
                'close_other_tabs':'关闭其他标签页',
                'menu_refersh':'刷新',
                'menu_close':'关闭',
                'menu_close_other':'关闭其他'
            },
            zh_hk:{
                'error_title':'錯誤：',
                'error_notice':'錯誤提示：',
                'success_message':'操作成功',
                'delete_title':'操作提醒',
                'delete_message':'確定進行刪除操作嗎',
                'delete_uncheck':'請勾選需要操作的列',
                'batch_message':'確定進行批量操作嗎',
                'detail_title':'詳情頁面',
                'select_icon_title':'點擊選擇圖標',
                'btn_yes':'確定',
                'btn_no':'取消',
                'new_msg_notice':'您有新的信息請及時處理',

                // menu
                'show_active_tab':'顯示當前選項卡',
                'close_all_tabs':'關閉所有標簽頁',
                'close_other_tabs':'關閉其他標簽頁',
                'menu_refersh':'刷新',
                'menu_close':'關閉',
                'menu_close_other':'關閉其他'
            },
            en:{
                'error_title':'Error:',
                'error_notice':'Error Notice：',
                'success_message':'Operation Success',
                'delete_title':'Operate Notice',
                'delete_message':'Are you sure to delete?',
                'delete_uncheck':'Please check the column that needs to be operated',
                'batch_message':'Are you sure to do batch operation?',
                'detail_title':'Detail',
                'select_icon_title':'Click the Icon',
                'btn_yes':'Yes',
                'btn_no':'No',
                'new_msg_notice':'You have new information, please deal',

                // menu
                'show_active_tab':'Show active tabs',
                'close_all_tabs':'Close all tabs',
                'close_other_tabs':'Close other tabs',
                'menu_refersh':'refresh',
                'menu_close':'close',
                'menu_close_other':'close others'
            },
            th:{
                'error_title':'ผิดพลาด：',
                'error_notice':'ข้อความผิดพลาด：',
                'success_message':'การดำเนินงานที่ประสบความสำเร็จ',
                'delete_title':'ตัวเตือนการทำงาน',
                'delete_message':'แน่ใจว่าจะลบ',
                'delete_uncheck':'โปรดตรวจสอบคอลัมน์ที่ต้องดำเนินการ',
                'batch_message':'คุณแน่ใจหรือไม่ว่าจะดำเนินการแบบกลุ่ม',
                'detail_title':'หน้ารายละเอียด',
                'select_icon_title':'คลิกไอคอนเลือก',
                'btn_yes':'กำหนด',
                'btn_no':'ยกเลิก',
                'new_msg_notice':'คุณมีข้อมูลใหม่โปรดจัดการกับมันในเวลา',

                // menu
                'show_active_tab':'แสดงแท็บปัจจุบัน',
                'close_all_tabs':'ปิดแท็บทั้งหมด',
                'close_other_tabs':'ปิดแท็บอื่นๆ',
                'menu_refersh':'รีเฟรช',
                'menu_close':'ปิดตัวลง',
                'menu_close_other':'ปิดอื่นๆ'
            },
            vi:{
                'error_title':'lỗi：',
                'error_notice':'Thông báo lỗi：',
                'success_message':'Hoạt động thành công',
                'delete_title':'Nhắc nhở hoạt động',
                'delete_message':'Bạn có chắc muốn xóa không',
                'delete_uncheck':'Vui lòng kiểm tra cột cần được vận hành',
                'batch_message':'Bạn có chắc chắn thực hiện hoạt động hàng loạt không',
                'detail_title':'Trang chi tiết',
                'select_icon_title':'Nhấp vào biểu tượng chọn',
                'btn_yes':'mục đích',
                'btn_no':'hủy bỏ',
                'new_msg_notice':'Bạn có thông tin mới, hãy giải quyết kịp thời',

                // menu
                'show_active_tab':'Hiển thị tab hiện tại',
                'close_all_tabs':'Đóng tất cả cửa sổ',
                'close_other_tabs':'Đóng các tab khác',
                'menu_refersh':'Làm tươi',
                'menu_close':'tắt',
                'menu_close_other':'Đóng khác'
            }
        };

        var lang = document.querySelector('html').lang;
        if(!lang) lang = 'zh_cn';

        // 获取网页的语言
        var result = language[lang][key];
        return result ? result : 'language[' + lang +'] key \"' + key + '\" not exist';
    }
};
$.utils.init();

(function($, window, document, undefined) {
    var ImageUpload = function(ele, opt) {
        var _this = this;

        // jquery 对象
        this.$element = ele;
        // 定义默认参数
        this.defaults = {
            // 展示图片区域

            // $display_image: this.$element.find("figure img"),

            $image_preview_btn: this.$element.siblings(
                "figcaption .btn-primary"
            ),
            display_image_dom: "figure img",
            image_delete_dom: 'figure [data-operate="delete-image"]',

            error_image_url: "/images/img_error.jpg",

            file_input_dom: 'input[type="file"]',

            // 错误消息处理
            showErrorDialog: function(message) {
                window.alert(message);
            },
            showSuccessDialog: function(message) {
                window.alert(message);
            },
            $callback_input: null
        };
        this.options = $.extend({}, this.defaults, opt);

        // 外层的ul元素
        if (
            this.$element.data("upload-url") &&
            this.$element.data("delete-url")
        ) {
            this.options.uploadUrl = this.$element.data("upload-url");
            this.options.deleteUrl = this.$element.data("delete-url");
        }

        if (this.$element.data("image-url")) {
            this.options.imageUrl = this.$element.data("image-url");
        }
    };

    // 定义插件的方法
    ImageUpload.prototype = {
        init: function() {
            // console.log("插件的 init 方法");

            var _this = this;

            // 初始化上传区域
            this.insertHtmlToRoot(
                this.getImageUploadHtml(
                    this.options.uploadUrl,
                    this.options.deleteUrl
                )
            );

            this.displayExistImage();
            this.bindDeleteOperate();

            // console.log(this.options.$file_input.html());
            // 绑定元素的点击事件
            // this.options.$file_input.change(function () {
            this.$element.on("change", _this.options.file_input_dom, function(
                e
            ) {
                // console.log('input change事件');
                var inputObj = $(this);

                // 判断文件个数 // 如果没有检测到文件，则返回
                if (inputObj[0].files.length < 1) {
                    e.target.value = "";
                    return;
                }

                // 如果预览文件已存在，则提示
                // onchange事件是先调用再创建li元素，所以这里元素的个数是1
                if (
                    _this.$element.find(_this.options.display_image_dom)
                        .length == 1
                ) {
                    e.target.value = "";
                    return _this.error("请删除当前文件再上传");
                }

                var fileObj = inputObj[0].files[0];
                // 执行文件上传操作
                var formData = new FormData();
                formData.append("file", fileObj);

                $.ajax({
                    type: "post",
                    url: _this.options.uploadUrl,
                    data: formData,
                    //Options to tell JQuery not to process data or worry about content-type
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // 获取上传图片的地址
                        var url = data.file_url;

                        // 上传完成后，添加dom，展示图片
                        _this.createImageShowArea(url);
                        _this.setCallbackInputValue(url);
                        _this.success(data.message);

                        e.target.value = "";
                        // inputObj.val("");
                    },
                    error: function(err) {
                        // inputObj.val("");
                        e.target.value = "";
                    }
                });
            });
        },

        // 展示已经存在的图片
        displayExistImage: function() {
            if (this.options.imageUrl) {
                this.createImageShowArea(this.options.imageUrl);

                // 初始化时，检查图片是否失效
                if (!this.checkImageValid(this.options.imageUrl)) {
                    // 显示默认的 图片失效 图片
                    $(this.options.display_image_dom).attr(
                        "src",
                        this.options.error_image_url
                    );

                    // 移除图片上的预览按钮
                    if (this.defaults.$image_preview_btn.length > 0) {
                        this.defaults.$image_preview_btn.remove();
                    }
                }
            }
        },

        // 设置输入框的内容
        setCallbackInputValue(value) {
            // console.log('设置callback input value:'+this.options.$callback_input);
            // 在input中显示url
            if (
                this.options.$callback_input &&
                this.options.$callback_input.length
            ) {
                // console.log('设置url成功');
                this.options.$callback_input.val(value);
            }
        },

        insertHtmlToRoot: function(html) {
            this.$element.prepend(html);
        },

        getImageShowHtml: function(url) {
            return (
                '<li class="col-xs-4 col-sm-3 col-md-2">' +
                '<figure><img src="' +
                url +
                '">' +
                '<figcaption><a class="btn btn-round btn-square btn-primary" href="javascript:;" data-operate="show-image" data-src="' +
                url +
                '"><i class="mdi mdi-eye"></i></a>' +
                '<a class="btn btn-round btn-square btn-danger" data-url="' +
                url +
                '" href="javascript:;" data-operate="delete-image" ><i class="mdi mdi-delete"></i></a>' +
                "</figcaption></figure></li>"
            );
        },

        createImageShowArea: function(url) {
            this.options.imageUrl = url;
            this.insertHtmlToRoot(this.getImageShowHtml(url));
        },

        // 展示图片的html代码
        getImageUploadHtml: function(uploadUrl, deleteUrl) {
            return (
                '<li class="col-xs-4 col-sm-3 col-md-2" style="width: 200px; height: 55px; line-height: 55px;" ' +
                'data-upload-url="' +
                uploadUrl +
                '" data-delete-url="' +
                deleteUrl +
                '">' +
                '<a class="pic-add" href="javascript:;" title="点击上传"></a><input type="file" style="opacity: 0;position: absolute;top: -1px;left: -1px;width: 100%;"></li>'
            );
        },

        // 判断图片是否失效
        checkImageValid: function(url) {
            var ImgObj = new Image();
            ImgObj.src = url;
            ImgObj.onload = function(){
                if (
                    ImgObj.fileSize > 0 ||
                    (ImgObj.width > 0 && ImgObj.height > 0)
                ) {
                    return true;
                } else {
                    return false;
                }
            }
            ImgObj.onerror = function(){
                return false;
            }
            return true;
        },

        bindDeleteOperate: function() {
            var _this = this;
            // if (!this.options.$image_delete_btn.length) return;

            // this.options.$image_delete_btn.click(function () {
            this.$element.on(
                "click",
                this.options.image_delete_dom,
                function() {
                    // console.log("执行图片的删除事件");

                    $.ajax({
                        type: "post",
                        data: {
                            _method: "delete",
                            file_url: _this.options.imageUrl
                        },
                        url: _this.options.deleteUrl,
                        success: function(data) {
                            _this.$element.find(_this.options.display_image_dom).parents("figure").parent().remove();
                            // $(_this.options.display_image_dom).parents("figure").parent().remove();
                            _this.setCallbackInputValue("");
                            _this.success(data.message);
                        }
                    });
                }
            );
        },

        // 显示错误信息
        error: function(message) {
            this.options.showErrorDialog(message);
        },

        // 显示错误信息
        success: function(message) {
            this.options.showSuccessDialog(message);
        }
    };

    //在插件中使用
    $.fn.imageUpload = function(options) {
        var imageUpload = new ImageUpload(this, options);
        //调用其方法
        return imageUpload.init();
    };
})(jQuery, window, document);

// 调用方法
// $.utils.getIframeId();
