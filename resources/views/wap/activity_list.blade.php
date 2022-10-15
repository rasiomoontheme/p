<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no, minimal-ui">

    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- 活动办理大厅</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">

    <link rel="shortcut icon" href="/img/9170/favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/web/js/respond.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/web/js/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/web/js/jbootstrappage.js') }}" type="text/javascript"></script>
    <link href="{{ asset('/web/css/activity/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/jbootstrappage.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/wapreset.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity_iconfont.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/wapstyle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/wapstyle9170.css') }}" rel="stylesheet" type="text/css">


</head>

<body>
    {{-- <div id="vote_form">
        <div class="form_item">
            <div class="form_label">申请主题</div>
            <div class="form_html title">新注册会员首存</div>
        </div>
        <div class="form_item form_input">
            <div class="form_label">会员用户名</div>
            <div class="form_html"><input type="text" name="member_name" value="" placeholder="请输入会员用户名" /></div>
        </div>
        <div class="form_item form_input">
            <div class="form_label">存款金额</div>
            <div class="form_html"><input type="number" name="recharge_money" value="" placeholder="请输入存款金额" /></div>
        </div>
        <div class="form_item">
            <div class="form_label">&nbsp;</div>
            <div class="form_html"><button type="button" id="sub" class="btn-sub" style="width: 222px"></button></div>
        </div>
    </div> --}}

    <div class="container">

        <div class="top">
            <a href="{{ route('web.index') }}" class="logo" style="background: url('{{ systemconfig('site_logo') }}') no-repeat center;"></a>
            <a href="javascript:;" class="iconfont query"></a>
        </div>

        <div class="noticelist"><span class="iconfont"></span>
            <ul class="noticelist-ul" style="margin-top: 0rem;">

                <li>恭喜：<span class="red">a****00 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
                <li>恭喜：<span class="red">a*****433 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
                <li>恭喜：<span class="red">a***230 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
                <li>恭喜：<span class="red">l****02 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
                <li>恭喜：<span class="red">l*****a1 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
                <li>恭喜：<span class="red">L**8 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                <li>恭喜：<span class="red">L******8 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
                <li>恭喜：<span class="red">l****67 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                </li>
            </ul>
        </div>

        <div class="newlist">
            <ul>
                @foreach($data as $item)
                <li>
                    <a class="yh yh8" href="javascript:;"
                        data-url="{{ route('web.activity.detail',['activity' => $item->id]) }}"
                        data-id="{{ $item->id }}" title="{{ $item->title }}" data-field="{{ $item->apply_field }}">

                        <img src="{{ $item->hall_image }}">
                        <p>{{ $item->title }}</p>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="clear"></div>
        </div>

    </div>

    <div class="footer">
        <p>Copyright © {{ systemconfig('site_name') }}</p>
        <a href="{{ systemconfig('site_pc') }}" class="gopc">&gt;&gt;访问电脑版</a>
    </div>

    <div class="bottom">
        <ul>
            <li>
                <a href="{{ quicklink('wap_register') }}" target="_blank"><i class="iconfont"></i>
                    <p>免费开户</p>
                </a>
            </li>
            <li class="li2">
                <a class="a" href="{{ systemconfig('wap_app_link') }}" target="_blank"><i class="iconfont1"></i>
                    <p>APP下载</p>
                </a>
            </li>
            {{--
            <li>
                <a href="javascript:void(0)" target="_blank"><i class="iconfont"></i>
                    <p>在线充值</p>
                </a>
            </li>
            --}}
            <li class="li2">
                <a href="{{ systemconfig('service_link') }}" target="_blank"><i class="iconfont"></i>
                    <p>在线客服</p>
                </a>
            </li>
        </ul>
    </div>

    <!-- 优惠申请 -->
    <div class="wrap-form" style="display: none">
        <form enctype="multipart/form-data" id="form1" onsubmit="return false" action="#" method="post">
            <div class="modal tccon yhcon17" id="yhcon17">
                <a class="layui-layer-close closebtn"></a>
                <h2>优惠活动申请</h2>
                <div class="tctitle">
                    <a class="flicker">{{ systemconfig('site_name') }}</a>
                    <a class="showDetails"><img src="/web/images/activity/1.png" alt=""></a>
                </div>
                <div id="activity_body">

                </div>
            </div>
        </form>
    </div>


    <!-- 申请进度查询 -->
    <div class="wrap-form1" style="display: none">
        <div class="layui-layer-content" style="height: 215px;">
            <div class="modal tccon querycon layui-layer-wrap" id="querycon" style="display: block;">
                <a class="layui-layer-close closebtn"></a>
                <a class="tclogo"></a>
                <div class="fg"></div>

                <form class="condition-list">
                    <h2 class="title">申请进度查询</h2>

                    <div id="con1">
                        <p>
                            <input type="text" id="member_name" class="in1" name="member_name" maxlength="15"
                                minlength="12" value="" placeholder="填写你的会员账号" required="required">
                        </p>
                        <p id="query_option-pra">
                            <select name="promotion_id">
                                <option value="">----所有----</option>
                                @foreach(\App\Models\Activity::forMember()->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </p>
                        <div class="line"></div>
                        <p><span>&nbsp;</span>
                            <input type="button" value="点击查询" class="subbtn checksub">
                        </p>
                    </div>
                </form>
                <div class="con2" style="overflow-y: scroll;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:400px;">
                        <thead>
                            <tr>
                                <td>会员账号</td>
                                <td>申请活动</td>
                                <td>申请时间</td>
                                <td>申请状态</td>
                                <td>备注</td>

                            </tr>
                        </thead>
                        <tbody id="query_content">
                            <tr>
                                <td colspan="5">未查询到信息</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pages pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $(function () {
            /**文字上下跑马灯效果 */
            var _wrap = $('.noticelist-ul');
            var _interval = 1600;
            var _moving;
            _wrap.hover(function () {
                clearInterval(_moving);
            }, function () {
                _moving = setInterval(function () {
                    var _field = _wrap.find('li:first');
                    var _h = _field.height();
                    _field.animate({
                        marginTop: -_h + 'px'
                    }, 600, function () {
                        _field.css('marginTop', 0).appendTo(_wrap);
                    })
                }, _interval)
            }).trigger('mouseleave');
        });

        $(function () {
            $('.yh').on('click', function (e) {
                e.stopPropagation();
                $('.addInputBox').remove()
                $('.flicker').text($(this).parents('li').find('a').attr('title'));
                $('.wrap-form').show()
                $('.showDetails').attr({
                    "href": $(this).parents('li').find('a').data('url')
                })

                // 获取字段信息
                // var field = $(this).data('field');
                // var field_array = [];

                // if(apply_field.indexOf(',')){
                //     field_array = field.split(',')
                // }else{
                //     field = 
                // }

                // 动态生成form 表单

                $.ajax({
                    url: "/activity/apply/form/" + $(this).data('id'),
                    type: 'POST',
                    success: function (html) {
                        $("#activity_body").html(html);
                    }
                })

            })

            $('.closebtn').on('click', function () {
                $('.wrap-form').hide()
                $('.wrap-form1').hide()
                $('.submitBtnNow').off('click') //清除绑定的点击事件,防止多次提交;
                $(".condition-list").show();
            })
            $('.iconfont.query').on('click', function () {
                $('.wrap-form1').show();
                $('.con2').hide();
            })
            queryLine();

            $('#activity_body').on('click','#sub',function () {
                $.ajax({
                    //几个参数需要注意一下
                    type: "POST", //方法类型
                    dataType: "json", //预期服务器返回的数据类型
                    url: "/activity/apply/"+$(this).data('id'), //url
                    data: $('#form1').serialize(),
                    success: function (data) {
                        alert(data.message);
                        window.location.reload();
                    },
                    error: function (
                        xhr, textStatus, errorThrown
                    ) {
                        var returnMsg = "错误：";
                        var obj = JSON.parse(xhr.responseText);
                        if (obj.message)
                            returnMsg += obj.message;
                        alert(returnMsg);
                    }
                });
            });
        })


        // 查询活动申请进度
        function queryLine() {

            $(".subbtn.checksub").on('click', function () {

                $.post("/activity/apply/result", $(".condition-list").serializeArray(), function (response) {
                    $(".condition-list").hide();
                    $("#showResult").show();
                    $('.con2').show()
                    $("#usernamespan").text($("[name=member_name]").val());
                    let list = response.data.data;

                    if (list.length > 0) {
                        $(".pagination").jBootstrapPage({
                            pageSize: 5,
                            total: list.length,
                            maxPageButton: 10,
                            data: list,
                            onPageClicked: function (obj, pageIndex, from, to, config) {
                                var list = config.data;
                                var html = "";
                                var comment = ''
                                for (var i = from; i <= to && i < list.length; i++) {

                                    if (list[i]['remark']) {
                                        comment = list[i]['remark']
                                    }
                                    html = html + '<tr><td>' +
                                        list[i].member.name + '</td><td>' +
                                        list[i].activity.title + '</td><td>' +
                                        list[i].created_at + '</td><td>' +
                                        list[i].status_text + '</td><td><a id="comment_' +
                                        i +
                                        '" href="#" onmouseout="$(this).find(\'div\').hide()" onmouseover="$(this).find(\'div\').show()">查看详情<div class="modal_' +
                                        i + '" style="display: none">' +
                                        comment + '</div></a></td></tr>';
                                }
                                $("#query_content").html(html);
                            }
                        });
                        $(".pages [pnum=1] a").trigger('pageClick');
                    }
                }, 'json').error(function (err) {
                    var returnMsg = "错误：";
                    var obj = JSON.parse(err.responseText);
                    if (obj.message)
                        returnMsg += obj.message;
                    alert(returnMsg);
                    // console.log(err.responseText,obj.message)
                });
            })
        }

    </script>
</body>

</html>
