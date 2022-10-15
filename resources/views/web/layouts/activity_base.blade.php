<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- 活动办理大厅</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('/web/css/activity/jbootstrappage.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/reset.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('/web/css/activity/main.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('/web/css/activity/captcha.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/base9170.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/activity/animate.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/web/js/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/web/js/jq_scroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/web/js/jbootstrappage.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/web/js/clicaptcha.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#scrollDiv").Scroll({
                line: 1,
                speed: 500,
                timer: 1000,
                up: "but_up",
                down: "but_down"
            });
        });

    </script>
    <style>
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

    </style>
</head>

<body>
    <div class="container">

        <div id="header" class="head-cen">
            <div class="hBox-cen clearfix">

                <div class="logo">
                    <a href="{{ systemconfig('site_pc') }}" target="_blank" style="max-width: 260px;overflow:hidden;display:block;">
                        <img src="{{ systemconfig('site_logo') }}" alt="">
                    </a>
                </div>

                <div class="slogan"><img src="{{ systemconfig('site_slogan') }}" alt=""></div>
				
				<!-- 查询审核进度 -->
				<div class="slogan2">
                    <a href="javascript:;" id="showQueryForm"> </a>
                </div>

                <!-- 悬浮
                <div class="rightdao rdao">
                    <div class="tac"><a href="https://www..com/cn/register" target="_blank" class="ldao1"></a></div>

                    <div class="tac totop"><img src="/web/images/activity/rdao2.png" alt="" /></div>
                </div>
                -->
                <div class=" ldao">
                    <!-- 返回首页   在线客服  快速充值 APP下载 -->
                    <div class="tac"><a href="{{ systemconfig('site_pc') }}" class="rdao1"></a></div> <!-- 返回首页 -->
                    <div class="tac"><a href="{{ systemconfig('service_link') }}" target="_blank" class="rdao3"></a></div>
                    {{--<div class="tac"><a href="/" target="_blank" class="rdao4"></a></div>--}}
                    <div class="tac"><a href="{{ systemconfig('wap_app_link') }}" target="_blank" class="rdao2"></a></div>


                </div>
            </div>
        </div>

        <div id="main">
            <div class="activity-det-bg">
                <div class="newSection">
                    <div class="newsBox">
                        <dl>
                            <dt>最新消息</dt>
                            <dd class="bd">
                                <ul class="infoList" onclick="$('#news').addClass('animate-enter');">

                                    <li>
                                        <marquee behavior="scoll" direction="left">{{ App\Models\SystemNotice::groupName('活动大厅')->getContentStr() }}</marquee>
                                    </li>

                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>

                @yield('content')


			</div>
			

            <link href="/web/css/activity/dialog.css" rel="stylesheet" type="text/css">
            <style>
                .dialog-container {
                    background: #312;
                }

			</style>
			
			<!-- 点击marqueen的弹窗 -->
            <div class="dialog animated bounce" id="news">
                <div class="dialog-container animated bounceInDown">
                    <span class="closebtn" onclick="$('.dialog').removeClass('animate-enter')"></span>
                    <h2 class="title">最新消息</h2>
                    <div class="content notice">
                        <div class="warp">

							@foreach(App\Models\SystemNotice::groupName('活动大厅')->get() as $item)
                            <div class="note">
                                <div class="fl date"><span>{{ $item->created_at->format('m') }}</span><b>{{ $item->created_at->format('d') }}</b></div>
                                <div class="note-title">
                                    <span class="ellipse"></span>
                                    {{ $item->created_at->toDateString() }}
                                </div>
                                <div class="note-details">
                                    <div class="notes">
                                        <p>{{ $item->content }}</p>
                                    </div>
                                </div>
                            </div>
							@endforeach

                        </div>
                    </div>
                </div>
            </div>
            <script>
                function openNoticeList() {
                    $('#news').addClass('animate-enter')
                }

            </script>




            <!--schedule-->
            <!--当添加class名.animate-enter时，显示该div-->
            <div class="dialog animated bounce" id="result">
                <div class="dialog-container animated bounceInDown">
                    <span class="closebtn" onclick="$('.dialog').removeClass('animate-enter');"></span>
                    <div class="tclogo"></div>

					{{-- 审核进度查询 --}}
                    <form class="condition-list">
                        @csrf
                        <h2 class="title">申请进度查询</h2>
                        <div id="vote_form">
                            <div class="form_item">
                                <div class="form_label">请输入会员账号</div>
                                <div class="form_html">
                                    <input type="text" id="member_name" class="in1" name="member_name" maxlength="15"
                                        minlength="12" value="" placeholder="填写你的会员账号" required="required">
                                    @csrf
                                </div>
                            </div>
                            <div class="form_item">
                                <div class="form_label">选择查询项目：</div>
                                <div class="form_html">
                                    <select name="activity_id">
										<option value="">----所有----</option>
										@foreach(\App\Models\Activity::forMember()->get() as $item)
										<option value="{{ $item->id }}">{{ $item->title }}</option>
										@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form_item">
                                <div class="form_label">&nbsp;
                                </div>
                                <div class="form_html">
                                    <a href="javascript:void(0);" class="but"></a>
                                </div>
                            </div>
                        </div>
					</form>
					
                    <!--查询结果-->
                    <div class="result-list" id="showResult" style="display: none;">
                        <h2 class="title">会员账号：<span id="usernamespan"></span></h2>
                        <div class="content">
                            <table border="0" cellpadding="0" cellspacing="0">
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
                            <div class="pages pagination">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <script>
                $(function () {

					// 审核进度查询弹窗展示
                    $("#showQueryForm").on("click", function () {
                        $(".condition-list").show();
                        $("#query_content").html('<tr><td colspan="5">未查询到信息</td></tr>');
                        $(".pages").empty();
                        $("#showResult").hide();
                        $("#result").addClass("animate-enter")
					});
					
					// 审核进度查询按钮点击
                    $("#vote_form .but").on("click", function () {
                        var member_name = $('#member_name').val()
                        if (!member_name) {
                            return alert('请填写账号！')
                        }
                        var request_data = $(".condition-list").serialize()
                        $.post("/activity/apply/result", request_data, function (response) {
                            $(".condition-list").hide();
                            $("#showResult").show();
                            $("#usernamespan").text(member_name);
							let list = response.data.data;

                            if (list.length > 0) {
                                $(".pagination").jBootstrapPage({
                                    pageSize: 5,
                                    total: list.length,
                                    maxPageButton: 10,
                                    data: list,
                                    onPageClicked: function (obj, pageIndex, from, to,
                                        config) {
                                        var list = config.data;
                                        var html = "";
                                        var comment = ''
                                        for (var i = from; i <= to && i < list.length; i++) {
                                            
                                            if (list[i]['remark']) {
                                                comment = list[i][
                                                    'remark']
                                            }
											html = html + '<tr><td>'
												 + list[i].member.name + '</td><td>' 
												 + list[i].activity.title + '</td><td>' 
												 + list[i].created_at + '</td><td>' 
												 + list[i].status_text +'</td><td><a id="comment_' + i +
                                                '" href="#" onmouseout="$(this).find(\'div\').hide()" onmouseover="$(this).find(\'div\').show()">查看详情<div class="modal_' +
                                                i + '" style="display: none">' +
                                                comment + '</div></a></td></tr>';
										}
										console.log(html);
                                        $("#query_content").html(html);
                                    }
                                });
                                $(".pages [pnum=1] a").trigger('pageClick');
                            }
                        },'json').error(function(err){
							var returnMsg = "错误：";
							var obj = JSON.parse(err.responseText);
							if (obj.message)
								returnMsg += obj.message;
							alert(returnMsg);
							// console.log(err.responseText,obj.message)
						});
					})
					

                    $("#queryForm").keypress(function (e) {
                        if (e.keyCode == 13) {
                            $("#queryForm .checksub").click()
                        }
                        return;
                    })

					// 回到顶部
                    $(".totop").click(function () {
                        $("html,body").stop().animate({
                            scrollTop: 0
                        }, 300)
                    })
                    $(window).scroll(function () {
                        var sc = $(window).scrollTop();
                        $(".rightdao").stop().animate({
                            top: sc + 400
                        }, 400);

                        $(".ldao").stop().animate({
                            top: sc + 180
                        }, 400);
                    });
                })

            </script>

            <div id="footer" class="footer-sm">
                <div id="footer-quick">
                    <a class="deposit" href="{{ quicklink('pc_how_to_deposit') }}">
                        如何存款<br>HOW TO DEPOSIT
                    </a>
                    <div class="line"></div>
                    <a class="withdrawal" href="{{ quicklink('pc_how_to_withdrawal') }}">
                        如何取款<br>WITHDRAW MONEY
                    </a>
                    <div class="line"></div>
                    <a class="agent" href="{{ quicklink('pc_partner') }}">
                        代理加盟 <br>AGENT TO JOIN
                    </a>
                    <div class="line"></div>
                    <a class="mobile" href="{{ systemconfig('site_mobile') }}">
                        手机投注<br>MOBILEBETTING
                    </a>
                </div>


                <div id="footer-logo"></div>
                <div class="fBox">
                    <div class="links">
                        <a href="{{ quicklink('pc_about_us') }}" target="_blank">关于我们</a>|
                        <a href="{{ quicklink('pc_contact') }}" target="_blank">联络我们</a>|
                        <a href="{{ quicklink('pc_partner') }}" target="_blank">代理加盟</a>|
                        <a href="{{ quicklink('pc_how_to_deposit') }}" target="_blank">存款帮助</a>|
                        <a href="{{ quicklink('pc_how_to_withdrawal') }}" target="_blank">取款帮助</a>|
                        {{--<a href="/FAQ" target="_blank">常见问题</a>|--}}
                        <a href="{{ quicklink('pc_guide') }}" target="_blank">条款与规则</a>
                        {{--<a href="#" target="_blank">客户端</a>--}}
                    </div>
                    <p class="copyright">Copyright © {{ systemconfig('site_name') }} {{ getUrl(systemconfig('site_pc')) }} {{ date('Y') }} Reserved</p>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="static/js/yii.js"></script> --}}


</body>

</html>
