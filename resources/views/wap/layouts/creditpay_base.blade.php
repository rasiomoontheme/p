<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- {{ systemconfig('site_name') }}借呗</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">

    <link href="{{ asset('/web/css/credit') }}/wapreset.css" rel="stylesheet">
    <link href="{{ asset('/web/css/credit') }}/wapstyle.css" rel="stylesheet">
    <script src="{{ asset('/web/js') }}/new_file.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="top">
    <a href="/"><img src="{{ systemconfig('site_logo') }}"/></a>
</div>

    {{--
    @php
        $banners = \App\Models\Banner::where('groups','credit')->where('is_open',1)->orderBy('weight','desc')->get();
    @endphp

    @if($banners->count())
    <div class="banner">
        <div id="slideBox" class="slideBox ">
            <div class="hd">

            </div>
            <div class="bd">
                <ul>

                    @foreach($banners as $item)
                        <li><a href="javascript:;" target="_blank"><img src="{{ $item->url }}" alt=""></a></li>
                    @endforeach

                </ul>
            </div>

            <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
            <a class="prev" href="javascript:void(0)"></a>
            <a class="next" href="javascript:void(0)"></a>

        </div>
    </div>
    @endif
    --}}
    <div class="gao-gao">
        <p>最新公告：</p>
        <div class="txtMarquee-left" style="display:none;">
            <div class="bd">
                <ul class="infoList">
                    @foreach(App\Models\SystemNotice::groupName('信用借呗')->pluck('content') as $v)
                        <li><a href="javascript:;" style="white-space:nowrap;color:#fff !important;">{{ $v }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <i>
            <marquee style="height:40px;line-height:40px;" scrollamount="5" direction="left">

                @foreach(App\Models\SystemNotice::groupName('信用借呗')->pluck('content') as $v)
                    <span><a href="javascript:;" style="white-space:nowrap;color:#f00 !important;">{{ $v }}</a></span>
                @endforeach

            </marquee>
        </i>
    </div>

    <style>
        .tempWrap {
            width: 100% !important;
        }
    </style>

    <div class="app-list" style="background:#222222;">
        <ul class="fix">

            <li><a href="{{ route('web.levelup.slot') }}" style="color:#FFFF37;" target="_blank">电子升级模式</a></li>

            <li><a href="{{ route('web.levelup.live') }}" style="color:#FFFF37;" target="_blank">真人升级模式</a></li>

            <li><a href="{{ quicklink('activity_hall') }}" style="color:#FFFFFF;" target="_blank">优惠大厅</a></li>

            {{--<li><a href="https://1779kf.com/" style="color:#FF00FF;" target="_blank">自助客服</a></li>--}}

            <li><a href="{{ quicklink('pc_register') }}" style="color:#FF00FF;" target="_blank">立即注册</a></li>

            <li><a href="{{ systemconfig('service_link') }}" style="color:#FF00FF;"
                   target="_blank">在线客服</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="sousuo">
            <form class="fix">
                <div class="input-box">
                    <input name=" " type="text" id="username" placeholder="请输入会员账号"/>
                    <i class="icon-sou"></i>
                </div>
                <a href="javascript:void(0)" class="butt" onclick="find()">信用额度查询</a>
            </form>
        </div>
    </div>

    <div class="nav">
        <ul class="fix">
            <li @if(request()->url() == route('web.credit_pay.index')) class="on-l" @endif><a href="{{ route('web.credit_pay.index') }}">信用规则</a></li>
            {{--<li class=""><a href="/mobile.php/index/dianzi.html">电子信用额度</a></li>--}}
            {{--<li class=""><a href="/mobile.php/index/zrjz.html">真人信用额度</a></li>--}}
            <li @if(request()->url() == route('web.credit_pay.record')) class="on-l" @endif><a href="{{ route('web.credit_pay.record') }}">借还款记录</a></li>
            {{--<li><a href="https://xs806.com/blrjb008.png" target="_blank">申请加大额度</a></li>--}}
            {{--<li><a href="https://www.17771.com/" target="_blank">账号交易</a></li>--}}
            <li class="on-h "><a href="{{ route('web.credit_pay.borrow') }}">我要借款</a></li>
            <li class="on-l "><a href="{{ route('web.credit_pay.lend') }}">我要还款</a></li>
        </ul>
    </div>

    <!---搜索弹窗---->
    <div id="light" class="white_content">
        <a class="gb" href="javascript:void(0)"
           onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img
                    src="{{ asset("web/images/credit") }}/gb.png"/></a>
        <div class="white-div">
            <table class="white-table" width="100%" border="0" cellspacing="0" cellpadding="0" id="table0">

            </table>
            <div id="page" class="paging">


            </div>
        </div>
    </div>
    <div id="fade" class="black_overlay"></div>
    <!---搜索弹窗---->

    <script type="text/javascript" src="{{ asset('/web/js') }}/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="{{ asset('/web/js') }}/jquery.superslide2.js"></script>

    <script type="text/javascript">
        jQuery(".txtMarquee-left").slide({
            mainCell: ".bd ul",
            autoPlay: true,
            effect: "leftMarquee",
            vis: 1,
            interTime: 50
        });
        jQuery(".slideBox").slide({mainCell: ".bd ul", autoPlay: true});

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                // console.log(XMLHttpRequest,textStatus,errorThrown)
                var returnMsg = "错误：";
                console.log(JSON.parse(XMLHttpRequest.responseText))
                if (XMLHttpRequest.responseText){
                    returnMsg += JSON.parse(XMLHttpRequest.responseText).message;
                    layer.msg(returnMsg);
                }
            }
        });

    </script>
    <script src="{{ asset('/web/js') }}/layer.js"></script>
    <script src="{{ asset('/web/js/credit') }}/page.js"></script>
    <script src="{{ asset('/web/js/credit') }}/page2.js"></script>

    <script>


        function find() {

            var username = $('#username').val();
            if (username == "") {
                alert('请输入会员账号');
                return;


            }
            findSub();
            console.log(1111);


        }

        function findSub() {
            var index = layer.load(1, {
                shade: [0.5, '#fff'] //0.1透明度的白色背景
            });
            var username = $('#username').val();
            if (username == "") {
                alert('请输入会员账号');
                return;


            }
            $.ajax({
                url:"{{ route('web.credit_pay.search') }}",
                type: 'post',
                data: {name: username},
                dataType: 'json',
                success: function (result) {
                    //alert(result);return;
                    console.log(result);
                    layer.close(index);
                    if (result.code !== 200) {
                        alert('没有相关数据');
                        return;
                    }
                    $('#table0').html('');

                    /*
                   var row1 = "<tr class='nicheng'><td colspan='4'>会员账号：<span>"+result.row.username+"</span></td></tr>";
                   var row2 = "<tr class='tr-top'><td>电子等级</td><td>电子可借款</td><td>真人等级</td>     <td>真人可借款</td></tr>";
                   var row3 = "<tr><td>"+result.row.shengjimoshi_level+"级</td><td>￥"+result.row.dianzi.money+"</td><td>"+result.row.shengjimoshi_level_zr+"级</td><td>￥"+result.row.zhenren.money+"</td></tr>";
                   var row4 = "<tr><td>"+result.row.shengjimoshi_level+"级</td><td>￥"+result.row.dianzi.money+"</td><td>"+result.row.shengjimoshi_level_zr+"级</td><td>￥"+result.row.zhenren.money+"</td></tr>";



                   var title0 = "<tr class='tr-top' ><td width='11%'>会员账号</td><td width='11%'>电子等级</td><td width='11%'>电子可借款</td><td width='11%'>真人等级</td><td width='11%'>真人可借款</td><td width='11%'>总共可借款</td><td width='11%'>已借款</td><td width='11%'>总借款</td><td width='11%'>总还款</td></tr>";
                  var row0 = "<tr><td>"+result.row.username+"</td><td>"+result.row.shengjimoshi_level+"</td><td>"+result.row.dianzi.money+"</td><td>"+result.row.shengjimoshi_level_zr+"</td><td>"+result.row.zhenren.money+"</td><td>"+result.row.max_money+"</td><td>"+result.row.jie_left+"</td><td>"+result.row.jie_use+"</td><td>"+result.row.jie_back+"</td></tr>";

                  var title = "<tr  class='tr-top'><td>会员账号</td><td>借款金额</td><td>未还款</td><td>还款金额</td><td>借款天数</td>                 <td>还款倒计时</td><td colspan=2>审核进度</td><td >日期</td></tr>";
                  var log = "";
                  if(result.rowCount==0){

                      log += "<tr><td colspan=8>暂无数据</td></tr>";
                  }
                  $(result.list).each(function(k,v){
                     var colorv = '#000;';
                      if(v.result=='借款成功'){

                          colorv = 'red;';
                      }else if(v.result=='还款成功'){

                          colorv = 'green;';
                      }else{

                          colorv = '#000;';
                      }
                      if(v.money==-1){

                          log += "<tr><td>"+v.username+"</td><td>"+v.jie_money+"</td><td>"+v.jie_left+"</td><td>"+v.jie_back+"</td><td>"+v.jie_days+"</td><td>"+v.djs+"</td><td colspan=2 style='color:"+colorv+"'>"+v.result+"</td><td >"+v.date+"</td></tr>";

                      }else{
                          log += "<tr><td>"+v.username+"</td><td>"+v.jie_money+"</td><td>"+v.jie_left+"</td><td>"+v.jie_back+"</td><td>"+v.jie_days+"</td><td>"+v.djs+"</td><td colspan=2 style='color:"+colorv+"'>"+v.result+"</td><td >"+v.date+"</td></tr>";

                      }

                    });
                  */
                    //$('#table0').append(title0);
                    //$('#table0').append(row0);
                    //$('#table0').append(title);



                    $('#table0').append(result.table);
                    /* 初始化页面 */

                    var initTotalPageNum = result.pageNum;
                    var rowNum = result.rowCount;
                    var pageSizeAjax = 1;
                    $("#page").paging_H({
                        pageSize: 5,
                        totalPage: initTotalPageNum,
                        totalRowNum: rowNum,
                        pageSizeAjax: pageSizeAjax,
                        cp: null
                    });

                    document.getElementById('light').style.display = 'block';
                    document.getElementById('fade').style.display = 'block';


                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    // view("异常！");
                    //  alert("异常！"+XMLHttpRequest.status);
                    console.log(XMLHttpRequest);
                    layer.close(index);

                    var returnMsg = "错误：";
                    console.log(JSON.parse(XMLHttpRequest.responseText))
                    if (XMLHttpRequest.responseText){
                        returnMsg += JSON.parse(XMLHttpRequest.responseText).message;
                        layer.msg(returnMsg);
                    }
                }
            });


        }

        /* ajax 请求更新数据 */
        function sendAjax_H(page, size) {
            //var url = '';
            //view(data.data[page-1].con);
            var index = layer.load(1, {
                shade: [0.5, '#fff'] //0.1透明度的白色背景
            });
            var username = $('#username').val();
            $.ajax({
                url:"{{ route('web.credit_pay.search') }}",
                type: 'post',
                data: {name: username, page: page},
                dataType: 'json',
                success: function (result) {
                    layer.close(index);
                    console.log(result);
                    if (result.code == 1) {

                        alert('没有相关数据');
                        return;

                    }
                    $('#table0').html('');


                    $('#table0').append(result.table);

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    // view("异常！");
                    //  alert("异常！"+XMLHttpRequest.status);
                    console.log(XMLHttpRequest);
                    layer.close(index);

                    var returnMsg = "错误：";
                    console.log(JSON.parse(XMLHttpRequest.responseText))
                    if (XMLHttpRequest.responseText){
                        returnMsg += JSON.parse(XMLHttpRequest.responseText).message;
                        layer.msg(returnMsg);
                    }
                }
            });
        }


    </script>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">Copyright © {{ systemconfig('site_name') }} Reserved</div>
</body>
</html>