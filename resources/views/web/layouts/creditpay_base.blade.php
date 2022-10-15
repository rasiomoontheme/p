<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- {{ systemconfig('site_name') }}借呗</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">

    <link href="{{ asset('/web/css/credit') }}/reset.css" rel="stylesheet">
    <link href="{{ asset('/web/css/credit') }}/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="top" >
    <div class="content fix" >
        <div class="top-fl fl"><p>{{ systemconfig('site_name') }}免息借呗</p></div>
        <div class="top-fr fix">
            <a href="{{ route('web.levelup.slot') }}" target="_blank" style="color:#FFFF37;">电子升级模式</a><span>|</span>
            <a href="{{ route('web.levelup.live') }}" target="_blank" style="color:#FFFF37;">真人升级模式</a><span>|</span>
            <a href="{{ quicklink('activity_hall') }}" target="_blank" style="color:#FFFFFF;">优惠大厅</a><span>|</span>
            <a href="{{ quicklink('pc_register') }}" target="_blank" style="color:#FF00FF;">立即注册</a><span>|</span>
            <a href="{{ systemconfig('service_link') }}" target="_blank" style="color:#FF00FF;">在线客服</a><span>|</span>
        </div>
    </div>
</div>

<div class="logo" >
    <div class="content fix"  >
        <h1 style="max-width:230px;height:70px;overflow: hidden">
            <a href=""><img src="{{ systemconfig('site_logo') }}" style="width: 100%" /></a>
        </h1>
        <div class="sousuo">
            <form class="fix">
                <div class="input-box">
                    <input name=" " type="text" value="" id="username" placeholder="请输入会员账号" />
                    <i class="icon-sou"></i>
                </div>
                <a href = "javascript:void(0)" class="butt" onclick = "find()">信用额度查询</a>
            </form>
        </div>
    </div>
</div>

<!---搜索弹窗---->
<div id="light" class="white_content">
    <a class="gb" href="javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img src="{{ asset("web/images/credit") }}/gb.png" /></a>
    <div class="white-div">
        <table class="white-table" width="100%" border="0" cellspacing="0" cellpadding="0" id="table0" style="word-wrap:break-word;word-break:break-all;" >


        </table>
        <div id="page" class="paging">


        </div>
    </div>
</div>
<div id="fade" class="black_overlay"></div>
<!---搜索弹窗---->

<div class="nav">
    <ul class="fix">
        <li @if(request()->url() == route('web.credit_pay.index')) class="on" @endif><a href="{{ route('web.credit_pay.index') }}">信用规则</a></li>
        <li @if(request()->url() == route('web.credit_pay.record')) class="on" @endif><a href="{{ route('web.credit_pay.record') }}">借还款记录</a></li>
        <li @if(request()->url() == route('web.credit_pay.borrow')) class="on" @endif><a href="{{ route('web.credit_pay.borrow') }}"><img src="{{ asset("web/images/credit") }}/wyjk.gif" /></a></li>
        <li @if(request()->url() == route('web.credit_pay.lend')) class="on" @endif><a href="{{ route('web.credit_pay.lend') }}"><img src="{{ asset("web/images/credit") }}/wyhk.gif" /></a></li>
        <li ><a href="{{ systemconfig('service_link') }}"  target="_blank">在线客服</a></li>
    </ul>
</div>

<div class="content">

    {{--
    <div class="box1 fix">
        <div class="box1-fl fl">
            @php
                $banners = \App\Models\Banner::where('groups','credit')->where('is_open',1)->orderBy('weight','desc')->get();
            @endphp

            @if($banners->count())
                <div id="slideBox" class="slideBox ">
                    <div class="hd">
                        <ul>
                            @foreach($banners as $item)
                                <li></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bd">
                        <ul>
                            @foreach($banners as $item)
                                <li><a href="javascript:;" target="_blank"><img src="{{ $item->url }}" alt=""></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
                    <a class="prev pive" href="javascript:void(0)"></a>
                    <a class="next" href="javascript:void(0)"></a>
                </div>
            @endif
        </div>

        <div class="box1-fr fr" style="height:218px;">
            <h4><img src="{{ asset("web/images/credit") }}/zx.png" /></h4>

            <div class="txtMarquee-top">
                <ul class="zdowebok" style="height:130px;overflow:hidden;">
                    @foreach(App\Models\SystemNotice::groupName('信用借呗')->pluck('content') as $v)
                        <li><a href="javascript:;" style="text-align: left;">{{ $v }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="box1-fr-kuan fix" style="margin-top:15px;">
                <a class="fl" href="{{ route('web.credit_pay.borrow') }}"  ><img src="{{ asset("web/images/credit") }}/jk.png" /></a>
                <a class="fr" href="{{ route('web.credit_pay.lend') }}"><img src="{{ asset("web/images/credit") }}/hk.png" /></a>
            </div>
        </div>
    </div>
    --}}
</div>

<!---jquery1.8.3库--->
<script type="text/javascript" src="{{ asset('/web/js') }}/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="{{ asset('/web/js') }}/jquery.superslide2.js"></script>
<script type="text/javascript">
    jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
</script>
<script src="{{ asset('/web/js') }}/layer.js"></script>
<script src="{{ asset('/web/js/credit') }}/page.js"></script>
<script src="{{ asset('/web/js/credit') }}/page2.js"></script>

<link rel="stylesheet" href="{{ asset('/web/css/credit') }}/limarquee.css">
<script src="{{ asset('/web/js') }}/jquery.limarquee.js"></script>
<script>
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

    $(function(){
        $('.zdowebok').liMarquee({
            direction: 'up',
            scrollamount:20
        });
    });
</script>

<script>
    function find(){
        var username = $('#username').val();
        if(username==""){
            alert('请输入会员账号');
            return;
        }
        findSub();
    }

    function findSub(){
        var index = layer.load(1, {
            shade: [0.5,'#fff'] //0.1透明度的白色背景
        });
        var username = $('#username').val();
        if(username==""){
            alert('请输入会员账号');
            return;
        }
        $.ajax( {
            url:"{{ route('web.credit_pay.search') }}",
            type:'post',
            data:{name:username},
            dataType:'json',
            success:function(result) {
                //alert(result);return;
                console.log(result);
                layer.close(index);
                if(result.code!=200){
                    alert('没有相关数据');
                    return;
                }
                $('#table0').html('');
                //var title0 = "<tr class='tr-top' ><td width='8%'>会员账号</td><td width='8%'>电子棋牌等级</td><td width='10%'>电子棋牌可借款</td><td width='8%'>真人等级</td><td width='8%'>真人可借款</td><td width='8%'>最高借款</td><td width='8%' style='color:red;font-weight:bold;'>信用借支</td><td width='8%'>已借款</td><td width='8%'>总借款</td><td width='8%'>总还款</td></tr>";
                //var row0 = "<tr><td>"+result.row.username+"</td><td>"+result.row.shengjimoshi_level+"</td><td>"+result.row.dianzi.money+"</td><td>"+result.row.shengjimoshi_level_zr+"</td><td>"+result.row.zhenren.money+"</td><td>"+result.row.max_money+"</td><td>"+result.row.xy_money+"</td><td>"+result.row.jie_left+"</td><td>"+result.row.jie_use+"</td><td><div style='width:15%；'>"+result.row.jie_back+"</div></td></tr>";

                var title0 = "<tr class='tr-top' ><td width='8%'>会员账号</td><td width='8%' colspan=2>VIP等级</td><td width='8%'>最高借款</td><td width='8%'>已借款</td><td width='8%'>总借款</td><td width='8%'>总还款</td></tr>";
                var row0 = "<tr><td>"+result.row.name+"</td><td colspan=2>"+result.row.level+"</td><td>"+result.row.total_credit+"</td><td>"+result.row.used_credit+"</td><td>"+result.row.total_borrow+"</td><td>"+result.row.total_lend+"</td></tr>";

                // var title = "<tr  class='tr-top'><td>会员账号</td><td>借款金额</td><td>未还款</td><td>还款金额</td><td>借款天数</td>                 <td>还款倒计时</td><td colspan=2>审核进度</td><td colspan=2>日期</td></tr>";
                var title = "<tr  class='tr-top'><td>会员账号</td><td>借款金额</td><td>还款金额</td><td>借款天数</td>                 <td>还款倒计时</td><td>审核进度</td><td>日期</td></tr>";
                var log = "";
                if(result.rowCount==0){
                    log += "<tr><td colspan=10>暂无数据</td></tr>";
                }

                $(result.list).each(function(k,v){
                    var colorv = '#000;';

                    if(v.status_text=='借款成功'){
                        colorv = 'red;';
                    }else if(v.status_text=='还款成功'){
                        colorv = 'green;';
                    }else{
                        colorv = '#000;';
                    }
                    log += "<tr><td>"+v.name+"</td><td>"+v.borrow_money+"</td><td>"+v.lend_money+"</td><td>"+v.borrow_day+"</td><td>"+v.remain_day+"</td><td style='color:"+colorv+"'>"+v.status_text+"</td><td>"+v.created_date+"</td></tr>";

                    /**
                     if(v.money==-1){
                            log += "<tr><td>"+v.username+"</td><td>"+v.jie_money+"</td><td>"+v.jie_left+"</td><td>"+v.jie_back+"</td><td>"+v.jie_days+"</td><td>"+v.djs+"</td><td colspan=2 style='color:"+colorv+"'>"+v.result+"</td><td colspan=2>"+v.date+"</td></tr>";
                        }else{
                            log += "<tr><td>"+v.username+"</td><td>"+v.jie_money+"</td><td>"+v.jie_left+"</td><td>"+v.jie_back+"</td><td>"+v.jie_days+"</td><td>"+v.djs+"</td><td colspan=2 style='color:"+colorv+"'>"+v.result+"</td><td colspan=2>"+v.date+"</td></tr>";
                        }
                     **/
                });

                $('#table0').append(title0);
                $('#table0').append(row0);
                $('#table0').append(title);
                $('#table0').append(log);
                /* 初始化页面 */

                var initTotalPageNum = result.pageNum;
                var rowNum = result.rowCount;
                var pageSizeAjax = 5;
                $("#page").paging_H({pageSize:5,totalPage:initTotalPageNum,totalRowNum:rowNum,pageSizeAjax:pageSizeAjax,cp:null});

                document.getElementById('light').style.display='block';
                document.getElementById('fade').style.display='block';


            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
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
    function sendAjax_H(page,size){
        //var url = '';
        //view(data.data[page-1].con);
        var index = layer.load(1, {
            shade: [0.5,'#fff'] //0.1透明度的白色背景
        });

        var username = $('#username').val();
        $.ajax( {
            url:"{{ route('web.credit_pay.search') }}",
            type:'post',
            data:{name:username,page:page},
            dataType:'json',
            success:function(result) {
                layer.close(index);
                console.log(result);
                if(result.code==1){
                    alert('没有相关数据');
                    return;
                }
                $('#table0').html('');
                // var title0 = "<tr class='tr-top' ><td width='11%'>会员账号</td><td width='11%'>电子棋牌等级</td><td width='18%'>电子棋牌可借款</td><td width='11%'>真人等级</td><td width='11%'>真人可借款</td><td width='11%'>最高借款</td><td width='11%'>已借款</td><td width='11%'>总借款</td><td width='11%'>总还款</td></tr>";
                // var row0 = "<tr><td>"+result.row.username+"</td><td>"+result.row.shengjimoshi_level+"</td><td>"+result.row.dianzi.money+"</td><td>"+result.row.shengjimoshi_level_zr+"</td><td>"+result.row.zhenren.money+"</td><td>"+result.row.max_money+"</td><td>"+result.row.jie_left+"</td><td>"+result.row.jie_use+"</td><td>"+result.row.jie_back+"</td></tr>";

                var title0 = "<tr class='tr-top' ><td width='8%'>会员账号</td><td width='8%' colspan=2>VIP等级</td><td width='8%'>最高借款</td><td width='8%'>已借款</td><td width='8%'>总借款</td><td width='8%'>总还款</td></tr>";
                var row0 = "<tr><td>"+result.row.name+"</td><td colspan=2>"+result.row.level+"</td><td>"+result.row.total_credit+"</td><td>"+result.row.used_credit+"</td><td>"+result.row.total_borrow+"</td><td>"+result.row.total_lend+"</td></tr>";

                // var title = "<tr  class='tr-top'><td>会员账号</td><td>借款金额</td><td>未还款</td><td>还款金额</td><td>借款天数</td>                 <td>还款倒计时</td><td colspan=2>审核进度</td><td >日期</td></tr>";
                var title = "<tr  class='tr-top'><td>会员账号</td><td>借款金额</td><td>还款金额</td><td>借款天数</td>                 <td>还款倒计时</td><td>审核进度</td><td>日期</td></tr>";

                var log = "";
                if(result.rowCount==0){

                    log += "<tr><td colspan=9>暂无数据</td></tr>";
                }
                $(result.list).each(function(k,v){
                    if(v.status_text=='借款成功'){
                        colorv = 'red;';
                    }else if(v.status_text=='还款成功'){
                        colorv = 'green;';
                    }else{
                        colorv = '#000;';
                    }
                    log += "<tr><td>"+v.name+"</td><td>"+v.borrow_money+"</td><td>"+v.lend_money+"</td><td>"+v.borrow_day+"</td><td>"+v.remain_day+"</td><td style='color:"+colorv+"'>"+v.status_text+"</td><td>"+v.created_date+"</td></tr>";


                });

                $('#table0').append(title0);
                $('#table0').append(row0);
                $('#table0').append(title);
                $('#table0').append(log);

            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
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

{{--
<div class="footer" style="display:none;">
    <div class="content">
        <div class="footer-kefu fix">
            <div class="footer-kefu-list">
                <h5>澳门客服电话</h5>
                <p></p>
            </div>
            <div class="footer-kefu-list mf-45">
                <h5>菲律宾客服电话</h5>
                <p>0063-9491666666</p>
            </div>
            <div class="footer-kefu-list footer-kefu-list-qq mf-45">
                <h5>客服QQ</h5>
                <p>3008435881</p>
            </div>
            <div class="footer-kefu-list footer-kefu-list-wx mf-45">
                <h5>客服微信</h5>
                <p>（借呗客服）</p>
            </div>
            <div class="footer-kefu-list footer-kefu-list-pz mf-45">
                <h5>持有政府牌照</h5>
                <p>Government licenses</p>
            </div>
        </div>
        <div class="footer-he"><img src="static/picture/hezx.png" /></div>
        <div class="Copyright">Copyright © {{ systemconfig('site_name') }} Reserved</div>
    </div>
</div>
--}}

<div class="footer">
    <div class="foot">
        <dl>
            <dt class="fo_1">关于我们</dt>
            {{--
            <dd><a href="/index.php/index/bs.html?k=b_yhjb"  >澳门巴黎人借呗</a></dd>
            <dd><a href="/index.php/index/bs.html?k=b_lxwm"  >联系我们</a></dd>
            --}}
            <dd><a href="{{ quicklink('pc_about_us') }}">关于我们</a></dd>
            <dd><a href="{{ quicklink('pc_contact') }}">联系我们</a></dd>

        </dl>
        <dl>
            <dt class="fo_2">帮助中心</dt>
            <dd><a href="{{ quicklink('pc_how_to_deposit') }}">如何存款</a></dd>
            <dd><a href="{{ quicklink('pc_how_to_withdrawal') }}">如何取款</a></dd>

            {{--
            <dd><a href="/index.php/index/bs.html?k=b_rhjk"  >如何借款</a></dd>
            <dd><a href="/index.php/index/bs.html?k=b_rhhk"  >如何还款</a></dd>
            <dd><a href="/index.php/index/bs.html?k=b_rhtsed"  >如何提升额度</a></dd>
            --}}
        </dl>
        <dl>
            <dt class="fo_3">关注我们</dt>
            <dd><span><img src="{{ systemconfig('wap_qrcode') }}"  style="width:100px;height:100px;" /></span></dd>
            <dd><span style="color:red;margin-left:-3px;">下载手机客户端</span></dd>
        </dl>

        {{--
        <dl>
            <dt class="fo_4">支付方式</dt>
            <dd><a href="https://www.jy1779.com/" target="_blank">在线支付</a></dd>
            <dd><a href="https://www.jy1779.com/" target="_blank">银行汇款</a></dd>
            <dd><a href="https://www.jy1779.com/" target="_blank">微信支付</a></dd>
            <dd><a href="https://www.jy1779.com/" target="_blank">支付宝支付</a></dd>
        </dl>
        --}}

        <dl>
            <dt class="fo_5">服务与支持</dt>
            {{--<dd><a >客服电话 0063-9491666666</a></dd>--}}

            <dd><a >客服QQ {{ systemconfig('kefu_qq') }}</a></dd>

            <dd><a >网站邮箱 {{ systemconfig('site_email') }}</a></dd>

        </dl>
    </div>
    <div class="foot_text">Copyright © {{ systemconfig('site_name') }} Reserved</div>
</div>

</body>
</html>