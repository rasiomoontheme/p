<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- 幸运转盘</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('/web/css/wheel/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/wheel/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/web/css/wheel/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

</head>
<body style="min-width: 1100px;">
    <div class="header" style="min-width: 1100px;">
        <div class="a_auto">
            <div class="head">
                <div class="head_1" >
                    <a href="{{ systemconfig('site_domain') }}" target="_blank" style="max-width: 200px;margin-right: 40px;">
                        <img src="{{ systemconfig('site_logo') }}" alt="" style="max-width: 100%">
                    </a>
                </div>
                <div class="head_1" style="margin-left: -10px;">
                    <img src="{{ systemconfig('site_slogan') }}" alt="">
                </div>
                <div class="head_2">
                    <a href="{{ systemconfig('site_domain') }}" title="" target="_blank">官方首页</a>
                    <a href="{{ systemconfig('service_link') }}"
                       title="" target="_blank">在线客服 </a>
                    <a class="san" href="javascript:;" title="">抽奖转盘</a>
                    <a href="#rule" title="">抽奖规则</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bar">
        <div class="a_auto">
            <div class="bar_m">
                <div class="bar_1">

                    <div class="lay_1">

                        <img src="{{ asset('/web/images/wheel') }}/img-zp.png" alt="" />
                    </div>
                    <div class="lay_2">
                        <img src="{{ asset('/web/images/wheel') }}/turntable.png" class="wheel" />
                    </div>
                    <div class="lay_3">
                        <img src="{{ asset('/web/images/wheel') }}/img8.png" alt="" />
                    </div>
                    <div class="lay_4">
                        <a class="ta_2 cj_btn" href="javascript:void(0)" title="">
                            <img src="{{ asset('/web/images/wheel') }}/img9.png" alt="" id="cj_img" class="gray"/>

                        </a>
                    </div>
                </div>

                <div class="bar_2">

                    <div style="height: 353px;">
                        <div style="width: 96%;margin-left: 2%;">

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-3 left-label text-right" style="padding-right: 0;">
                                    会员账号：
                                </div>
                                <div class="col-md-5" style="padding: 0;">

                                    <input type="text" class="form-control account" style="border-radius: 5px;width: 250px;" placeholder="输入游戏账号查询哦" >
                                </div>
                                <div class="col-md-2" style="padding-left: 0;">
                                    <button class="btn btn-success search_account" type="button" style="width: 62px">查 询</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-3 left-label text-right" style="padding-right: 0;">
                                    当日总存款：
                                </div>
                                <div class="col-md-7" style="padding-left: 0;">

                                    <input type="text" class="form-control account save_amount" style="border-radius: 5px;width: 250px;" readonly>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 8px;">
                                <div class="col-md-3 left-label text-right" style="padding-right: 0;">
                                    当日有效投注：
                                </div>
                                <div class="col-md-7" style="padding-left: 0;width: 18px">

                                    <input type="text" class="form-control account bet-amount" style="border-radius: 5px;width: 250px;" readonly>

                                </div>
                            </div>
                            <div class="" role="alert" style="height: 180px;padding-top:10px;margin-left:10px;font-size:14px;color: #bcad8d;margin-bottom:0;">
                                历史中奖记录

                                <div class="liebiao" style="width:550px; height: 120px; overflow: hidden">

                                </div>
                            </div>
                            <span style="font-size: 16px;font-weight: bold;">您当前有 <span class="cj_count" style="color: white;font-size: 1.3rem;"> 0 </span> 次抽奖机会!</span>

                        </div>


                    </div>
                </div>

                <div class="bar_4">
                    <div class="s_bot">
                        <div class="list_lh">
                            <ul class="drawList">
                            </ul>
                        </div>
                        <div class="list_lh">
                            <ul class="drawList2">
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bar_3" style="margin-top: 20px;">
                    <p style="font-size: 16px;color: #b9a888">
                        当日在{{ systemconfig('site_name') }}最低存款500以上，且有效总投注额达到享受礼金最低存款要求的3倍及以上的会员，将获得幸运转盘次数，并有机会获得东南亚七日豪华游，名额不限，赶快参与！
                    </p>
                    <div class="mr_frbox">

                        <div class="mr_frUl">
                            <ul>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/2ead44b68b93b0677b2cffe04cdf08d3.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/9019cab46b10bc82ab6ba6a94d6beb3c.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/b07eedbdf8cdf5b89b8d004d0b8e3f37.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/34bacd7183d7e2b95845d2c48e27d10c.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/96b56053b67e5216b8d2c07562344e56.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/11f2d5122249b7d1adb166ceffdb197e.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/957740284f61bba05611061782f8d639.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/295c5965c9ed549937c3cf5942ccb897.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/939d617c97f3a372980f3362245b3b5c.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/447075995668a5e04b0bf60885be216e.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/bd8dd02713d3ac8705b38f1602de04a4.png" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void (0);" >

                                        <img class="ad" src="{{ asset('/web/images/wheel') }}/835cfc99c3e77309c238612972996253.png" />
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </div>
                </div>

                <style>
                    .zjjl-table{
                        border-spacing: 0;
                        border-collapse: collapse;
                        text-align: center;
                        margin-top: 8px;
                    }

                    .zjjl-table tbody{
                        height: 80px;
                        display: block;
                        overflow-y: scroll;
                        overflow-x: hidden;
                    }

                    .zjjl-table thead, .zjjl-table tbody tr {
                        display: table;
                        width: 100%;
                        table-layout: fixed;
                    }

                    /*关键设置：滚动条默认宽度是16px 将thead的宽度减16px*/
                    .zjjl-table thead {
                        width: calc( 100% - 1em)
                    }

                    .cjtj-table{
                        width: 100%;
                        margin-top: 55px;
                        padding: 20px;
                        color: #b9a888;
                    }
                    .cjtj-table tr{
                        text-align: center;
                        height: 45px;
                    }
                    .cjtj-table th{
                        color: #fff;
                        font-size: 18px;
                    }
                    .cjtj-table td{
                        color: #b9a888;
                        font-size: 15px;
                    }

                </style>
                <div class="bar_6">
                    <table class="cjtj-table" >
                        <tr style="text-align: center;">
                            <th>当日存款</th>
                            <th>有效流水</th>
                            <th>转盘次数</th>
                        </tr>

                        @foreach($setting as $v)
                            <tr>
                                <td>{{ $v['deposit'] }}+</td>
                                <td>{{ $v['valid_num'] }}倍</td>
                                <td>{{ $v['times'] }}</td>
                            </tr>
                        @endforeach
                        {{--
                        <tr>
                            <td>500+</td>
                            <td>3倍</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>1000+</td>
                            <td>3倍</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>5000+</td>
                            <td>3倍</td>
                            <td>1</td>
                        </tr>
                        --}}
                    </table>
                </div>



                <div class="bar_5" id="rule">

                    <p>
                        1. 所有优惠以人民币（CNY）为结算金额，存款总额和有效投注额按照美东时间统计，即每天中午12点至次日中午12点为一个计算周期；
                    </p>
                    <p>
                        2. 当天产生的转盘次数在第二天的北京时间14:00生效，生效后即可凭游戏账号参与{{ systemconfig('site_name') }}幸运大转盘活动，抽奖次数可以累积使用，最多累积到3次，多余次数将在每周星期二维护后清除；
                    </p>
                    <p>
                        3. 本活动抽中港澳台五日游，东南亚七日豪华游的会员, 请第一时间联系在线客服申请，具体出游时间由{{ systemconfig('site_name') }}决定，两人同行，其中包含港澳台通行证，国际往返机票，旅游景点门票，全程中文导游，领队全陪。包括豪华巴士，旅游用车，全程包吃住，以及导游小费，此活动有效兑换期限是1星期,逾期视为放弃；
                    </p>

                    <p>
                        4. 本活动抽中IPhone X256G（黑色，256G，国行）实物奖品的会员，奖品不可折现，请务必于中奖后三个工作日内联系我司客服提供快递收货地址、姓名及联系电话，奖品将在中奖会员提供具体收货地址后十个工作日内寄出，如中奖后三个工作日内未联系我司确认收货地址 或因个人提供的收件信息不完整、不正确、电话无法联系上导致物品无法寄达快递退回的情况，均视为自动放弃不再安排寄送；
                    </p>

                    <p>
                        5. 本活动抽中“现金筹码”的会员无需联系申请, 系统将在30分钟内自动添加到中奖会员账号内, 1倍流水即可申请提款；
                    </p>

                    <p>
                        6. 本活动抽中“电子游艺存xxx送xxx优惠券”的会员务必在中奖后，在美东时间当天内存款xxx元后联系在线客服申请送xxx元的优惠（申请期间不可下注，否则视为弃权处理），此项存送优惠，需在电子游艺中完成（本金+红利）*3倍流水方可全额提款；
                    </p>

                    <p>
                        7. 每一位会员，每一住址，每一电子邮箱地址，每一电话号码， 相同支付方式(相同借记卡/信用卡/银行账户)及IP地址当日最多仅获得3次转盘机会，如发现会员同一个IP下登陆多个账号，公司有权拒绝赠送其彩金并做账号冻结处理，保证正常玩家的利益；
                    </p>

                    <p>
                        8. {{ systemconfig('site_name') }}的所有优惠特为会员而设，如发现任何团体或个人，以不诚实方式套取彩金或任何威胁，滥用优惠彩金等行为，{{ systemconfig('site_name') }}将保留冻结、取消该团体或个人账户余额的权利；
                    </p>

                    <p>
                        9. {{ systemconfig('site_name') }}保留对活动的最终解释权，以及在无通知的情况下修改、终止活动的权利。
                    </p>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('/web') }}/js/jquery-3.3.1.slim.min.js"></script>
    <script src="{{ asset('/web') }}/js/popper.min.js"></script>
    <script src="{{ asset('/web') }}/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="{{ asset('/web') }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/web') }}/js/jquery.superslide2.js"></script>
    <script type="text/javascript" src="{{ asset('/web') }}/js/scroll.js"></script>
    <script type="text/javascript" src="{{ asset('/web') }}/js/tc.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.list_lh li:even').addClass('lieven');

            $("div.list_lh").myScroll({
                speed: 60, //数值越大，速度越慢
                rowHeight: 25 //li的高度
            });
        });


        function supportCss3(style) {
            var prefix = ['webkit', 'Moz', 'ms', 'o'],
                i,
                humpString = [],
                htmlStyle = document.documentElement.style,
                _toHumb = function (string) {
                    return string.replace(/-(\w)/g, function ($0, $1) {
                        return $1.toUpperCase();
                    });
                };

            for (i in prefix)
                humpString.push(_toHumb(prefix[i] + '-' + style));

            humpString.push(_toHumb(style));

            for (i in humpString)
                if (humpString[i] in htmlStyle) return true;

            return false;
        }
        $(function () {

            $(".mr_frbox").slide({
                titCell: "",
                mainCell: ".mr_frUl ul",
                autoPage: true,
                effect: "leftLoop",
                autoPlay: true,
                vis: 3
            });
            $(".backc2").hover(function () {
                $(this).animate({
                    marginTop: "-5px"
                }, 200);
            }, function () {
                $(this).animate({
                    marginTop: "5px"
                }, 200);
            });
            var loading = false;
            $(".search_account").click(function () {

                if (!loading) {
                    loading = true;
                    if (/^[a-zA-z0-9_-]+$/.test($(".account").val())) {
                        loading = true;

                        /**
                         * 数据格式：
                         * bet_amount: 0
                             cjcs: 0
                             code: 1
                             liebiao: ""
                             max_v1: "5000"
                             max_v2: "15000"
                             save_amount: 0
                         * */

                        $.ajax({
                            url: "wheel/myDetail/" + $(".account").val(),
                            type: "GET",
                            dataType: "json",
                            cache: false,
                            success: function (res) {
                                if(res.status == 'success'){
                                    $(".save_amount").val(res.data.save_amount);
                                    $(".bet-amount").val(res.data.bet_amount);
                                    $(".liebiao").html(res.data.liebiao);
                                    $(".cj_count").html(res.data.cjcs);

                                    // var s_r = Math.ceil(res.save_amount / res.max_v1 * 100);
                                    // var b_r = Math.ceil(res.bet_amount / res.max_v2 * 100);
                                    // b_r = b_r > 100 ? 100 : b_r;
                                    // s_r = s_r > 100 ? 100 : s_r;
                                    // // console.log(res.bet_amount,res.max_v2);
                                    // $(".save_pro").css('width',s_r+"%");
                                    // $(".bet_pro").css('width',b_r+"%");
                                    // $(".save_pro").html(res.save_amount + " / " + res.max_v1);
                                    // $(".bet_pro").html(res.bet_amount + " / " + res.max_v2);
                                    if(res.data.cjcs > 0){
                                        can_Choujiang();
                                    }

                                }else{
                                    account_error(res.message);
                                }
                                loading = false;
                            },
                            error: function () {
                                loading = false;
                            }
                        })
                    } else {
                        account_error("请输入正确的用户名")
                    }
                }
            });

            function account_error(msg){
                alert(msg);
                $(".account").html("");
                $(".account").focus();
                loading = false;
            }

            function can_Choujiang() {
                can_cj = true;
                $("#cj_img").removeClass('gray');
            }

            var can_cj = false;
            $(".cj_btn").click(function () {
                if(can_cj){
                    can_cj = false;
                    $.ajax({
                        url: "wheel/iWantRaffle/" + $(".account").val(),
                        type: "GET",
                        dataType: "json",
                        cache: false,
                        success: function (res) {
                            loading = false;
                            if (res.status == 'success') {
                                draw(res.data);
                            } else {
                                account_error(res.message);
                            }
                            can_cj = true;
                        },
                        error: function (res) {
                            account_error(JSON.parse(res.responseText).message || "网络错误，请刷新后重试");
                            can_cj = true;
                        }
                    })
                }
            });

            function draw(options) {
                if (supportCss3('transform')) {
                    var target = 30 - 30 * options.position;

                    $(".wheel").css({
                        transition: "transform 5s cubic-bezier(0.45,-0.05, 0.3, 1.05)",
                        transform: "rotate(" + (target + 3600) + "deg)"
                    });
                    console.log('起始角度 ' + target + "  完成角度：" + (target+3600));
                    setTimeout(function () {
                        $(".wheel").css({
                            transition: "initial",
                            transform: "rotate(" + (target) + "deg)"
                        });

                        $(".search_account").trigger('click');
                    }, 5200);
                    setTimeout(function () {
                        alert("恭喜你中奖了，奖品是 " + options.prize);
                    }, 6000);
                }
            }


            /**
             * 数据格式
             * data:[
             *  {created_at: "2020-05-29", account: "cf0****", prize: "8元筹码"}
             * ]
             * */
            $.ajax({
                url: "wheel/scrollMessages",
                type: "GET",
                dataType: "json",
                cache: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var list = "";
                        var list2 = "";
                        for (var i = 0; i < (res.data.length/2); i++) {
                            list += "<li><span>" + res.data[i].account + "</span><em>" + res.data[i]
                                .prize + "</em><i>" + res.data[i].created_at + "</i></li>"
                        }
                        for (var i = (res.data.length/2); i < res.data.length; i++) {
                            list2 += "<li><span>" + res.data[i].account + "</span><em>" + res.data[i]
                                .prize + "</em><i>" + res.data[i].created_at + "</i></li>"
                        }
                        $(".drawList").html(list);
                        $(".drawList2").html(list2);
                        $(".list_lh").myScroll({
                            speed: 60, //数值越大，速度越慢
                            rowHeight: 25 //li的高度
                        });
                    }
                },
                error: function () {}
            });
        });
    </script>
</body>
</html>