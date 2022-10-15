<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- 真人升级模式</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">

    <link href="{{ asset('/web/css/live/style.css') }}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('/web/js') }}/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="{{ asset('/web/js') }}/jquery.superslide2.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".newsBox").slide({
                mainCell:".bd ul",
                autoPage:true,
                effect:"leftMarquee",
                autoPlay:true,
                trigger:"click",
                interTime:50
            });

            $('.cover').click(function(){
                $('.cover,.popBox').fadeOut();
                return false;
            });
            $('.popBox .close a').click(function(){
                $('.cover,.popBox').fadeOut();
                return false;
            });

             // $('#main .searchBox .submit').click(function(){
             //   $('.cover,.popBox02').fadeIn();
             //   return false;
             // });

            $('.menu').click(function(){
                $(this).toggleClass('on');
                $('.menuBox').toggleClass('on');
            });
        })
    </script>
    <script>
        if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
            document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
        }
    </script>
</head>
<body>
    <div class="menuBox">
        <ul></ul>
    </div>

    <div id="container">
        <div id="header">
            <div class="hInner clearfix">
                <h1 style="top: 50%;transform: translateY(-50%);overflow: hidden;max-width: 200px;width: 200px;">
                    <a href="/"><img src="{{ systemconfig('site_logo') }}" alt="" style="margin: 0 auto;width:100%;"></a>
                </h1>
                <div class="rBox">
                    <div class="menu">
                        <span class="top"></span>
                        <span class="middle"></span>
                        <span class="bottom"></span>
                    </div>

                    <ul id="gNavi" class="clearfix">
                        <li class="navi01">
                            <a target="_blank" href="{{ route('web.levelup.slot') }}"><span>电子升级</span></a></li>
                        {{--
                        <li class="navi02">
                            <a target="_blank" href="{{ quicklink('activity_hall') }}"><span>活动申请</span></a>
                        </li>
                        --}}
                        <li class="navi02">
                            <a target="_blank" href="{{ quicklink('pc_register') }}"><span>立即注册</span></a></li>
                        <li class="navi03">
                            <a target="_blank" href="{{ route('web.credit_pay.index') }}"><span>免息借呗</span></a></li>
                        <li class="navi04">
                            <a target="_blank" href="{{ systemconfig('site_mobile') }}"><span>手机投注</span></a></li>
                        <li class="navi05">
                            <a target="_blank" href="{{ systemconfig('wap_app_link') }}"><span>APP下载</span></a></li>
                        <li class="navi06">
                            <a target="_blank"
                               href="{{ systemconfig('service_link') }}"><span>在线客服</span></a>
                        </li>
                        <li class="navi09">
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <div style="position: absolute;top: 45%;left: 25%;font-size: 24px;font-weight: bold;border: 1px solid #d52704;padding: 3px 28px;border-radius: 24px">
                <span style="color: #d52704">{{ systemconfig('site_name') }}:</span>
                <span style="color: #f800f7">{{ getUrl(systemconfig('site_domain')) }}</span>
            </div>
            <div class="newsBox">
                <dl class="clearfix">
                    <dt><img src="{{ asset('web/images/live') }}/img01.png" alt=""></dt>
                    <dd class="bd">
                        <ul class="infoList">
                            @foreach(App\Models\SystemNotice::groupName('真人升级大厅')->pluck('content') as $v)
                                <li>{{ $v }}</li>
                            @endforeach
                            {{--
                            <li>永久累积视讯打码升级，等级礼金+月俸禄【终生领取】尊享时时返水，等级越高账号交易价值越高~ 澳门巴黎人唯一官方网址：1797.com</li>
                            <li>账号交易网强势上线，电子/棋牌/捕鱼/视讯升级模式，等级越高价值越高，账号自由买卖，系统高价回收；澳门巴黎人账号交易网：17771.com</li>
                            <li>电子/棋牌/捕鱼【升级模式】永久累积游戏打码；等级礼金+周俸禄+月俸禄【终生领取】，参与账号交易等级越高价值越高~澳门巴黎人唯一官方网址：1797.com</li>
                            --}}
                        </ul>
                    </dd>
                </dl>
            </div>
            <div class="section">
                <form action="?sou=wei" method="post" id="ff">
                    @csrf
                    <div class="searchBox">
                        <p>段位查询：</p>
                        <input type="text" name="name" placeholder="请输入你的会员账号"
                               onfocus="if(this.placeholder=='请输入你的会员账号')this.placeholder=''"
                               onblur="if(this.placeholder =='') this.placeholder ='请输入您的会员账号'">
                        <a href="javascript:void(0);" class="submit" onclick="document.getElementById('ff').submit()"><img
                                    src="{{ asset('web/images/live') }}/btn.png" alt=""></a>
                    </div>
                </form>
                <h2>
                    <img src="{{ asset('web/images/live') }}/h2_img01.png" alt="">
                    <span>玩真人视讯永久累计打码，让您的会员账号变成永久收益金管家！</span>
                </h2>
                <p>在{{ systemconfig('site_name') }}的每一笔真人投注都会永久累积，累积到一定标准，即可升级。 <br>
                    每升一级即可获得相对应的等级礼金，等级礼金最高可获得<font color="#FF0000">748300</font>元，还有无门槛要求的月俸禄终身送不停，这就是您的会员账号金管家！</p>
                <div class="tabBox">
                    <table>
                        <thead>
                            <tr>
                                <th width="120px">晋升标准等级</th>
                                <th width="90px">累计打码</th>
                                <th width="90px">等级礼金</th>
                                <th width="90px">周俸禄</th>
                                <th width="90px">月俸禄</th>
                                <th width="90px">借呗额度</th>
                                <th width="90px">累积礼金</th>
                                <th width="130px">时时返水</th>
                                <th width="150px">存取款加速通道</th>
                                <th width="150px">一对一客服经理</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $total_level_money = 0; ?>
                            @foreach($levels as $item)
                                <tr>
                                    <td>{{ $item }}级</td>
                                    <?php
                                    $level_money = $data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_LEVEL)->first()->award_content['money'];
                                    $total_level_money = $total_level_money + $level_money;
                                    ?>
                                    <td>{{ float_number($data->where('level',$item)->where('condition_money','>',0)->first()->condition_money ?? '') }}</td>
                                    <td>{{ $level_money }}元</td>
                                    <td>{{ money_unit($data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_WEEK)->first()->award_content['money'] ?? '') }}</td>
                                    <td>{{ money_unit($data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_MONTH)->first()->award_content['money'] ?? '') }}</td>
                                    <td>{{ money_unit($data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_BORROW)->first()->award_content['money'] ?? '') }}</td>
                                    <td>{{ $total_level_money }}</td>
                                    <td>
                                        √
                                    </td>
                                    <td>
                                        √
                                    </td>
                                    <td>
                                        √
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text02">例: 会员每一笔真人投注累计达到100万打码量即可获得等级礼金
                    <span><font color="#FF0000">200</font></span>元，每周可获得<font color="#FF0000">1</font><span>0</span>元周俸禄，
                    每月可获得<font color="#FF0000">5</font><span>0</span>元月俸禄，
                    当累计到<font
                            color="#FF0000">5</font><span>00</span>万有效投注，即可再次获得升级礼金<font color="#FF0000">6</font><span><font
                                color="#FF0000">0</font>0</span>元，每周可获得<font color="#FF0000">5</font><span><font
                                color="#FF0000">0</font></span>元周俸禄，每月可获得<font color="#FF0000">20</font><span><font
                                color="#FF0000">0</font></span>元月俸禄！</p>
                <h2><img src="{{ asset('web/images/live') }}/h2_img02.png" alt=""></h2>
                <p><span>如何查询金管家等级？</span><br>
                    请登入“金管家升级版” {{ getUrl(route('web.credit_pay.index')) }} 输入会员账号，进行自助查询有效投注、等级等明细。
                <p><span>如何申请金管家等级礼金？</span><br>
                    无需申请, 距离上次登录7天后再次登录即可自动到账，彩金无需打码，可直接提款。如：会员直接从等级2升级到到等级5，跨越3个等级，即可获得升级礼金： 55（等级3）+100（等级4）+200（等级5）=355元</p>

                <p><span></span>如何申请每周俸禄？</p><br>
                    按您的等级计算，距离上次登录7天后再次登录即可自动到账，等级每周俸禄详情如下：</p>
                <div class="tabBox">

                    <table class="table02">
                        <tbody>
                        @foreach(range(0,floor(count($levels) / 16)) as $cell)
                            <tr>
                                <th style="width:60px;">等级</th>
                                @foreach(range(1 + $cell * 16, min(($cell + 1) * 16 , count($levels))) as $item)
                                    <th>{{ $item }}级</th>
                                @endforeach
                            </tr>

                            <tr>
                                <td>周俸禄</td>
                                @foreach(range(1 + $cell * 16, min(($cell + 1) * 16 , count($levels))) as $item)
                                    <td>
                                        {{ money_unit($data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_WEEK)->first()->award_content['money'] ?? '') }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <p><span>如何申请每月俸禄？</span><br>
                    按您的等级计算，距离上次登录30天后再次登录即可自动到账，等级每月俸禄详情如下：</p>
                <div class="tabBox">

                    <table class="table02">
                        <tbody>
                        @foreach(range(0,floor(count($levels) / 16)) as $cell)
                            <tr>
                                <th style="width:60px;">等级</th>
                                @foreach(range(1 + $cell * 16, min(($cell + 1) * 16 , count($levels))) as $item)
                                    <th>{{ $item }}级</th>
                                @endforeach
                            </tr>

                            <tr>
                                <td>月俸禄</td>
                                @foreach(range(1 + $cell * 16, min(($cell + 1) * 16 , count($levels))) as $item)
                                    <td>
                                        {{ money_unit($data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_MONTH)->first()->award_content['money'] ?? '') }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

        <div id="footer">
            <p class="copyright">COPYRIGHT © {{ systemconfig('site_name') }} RESERVED</p>
        </div>
    </div>

    <div class="cover" style="display:none;"></div>
    <div class="popBox popBox01">
        <div class="popup">
            <div class="close"><a href="#"><img src="{{ asset('web/images/live') }}/close.png" alt=""></a></div>
            <div class="ttl"><img src="{{ asset('web/images/live') }}/pop_img01.png" alt=""></div>
            <div class="img"><img src="{{ asset('web/images/live') }}/pop_img02.png" alt=""></div>
            <div class="btn"><a href="#"><img src="{{ asset('web/images/live') }}/pop_btn.png" alt=""></a></div>
        </div>
    </div>

    <div class="popBox popBox02" @if(!$info) style="display:none;" @else style="display: block;" @endif>
        <div class="popup">
            <div class="close"><a href="#"><img src="{{ asset('web/images/live') }}/close.png" alt=""></a></div>
            <p><span></span> 的账号信息</p>
            <div class="tabBox">
                <table>
                    <thead>
                        <tr>
                            <th>会员账号</th>
                            <th>当前等级</th>
                            <th>累积有效投注</th>
                            <th>等级彩金</th>
                            <th>周俸禄</th>
                            <th>月俸禄</th>
                            <th>距离晋级需有效投注</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($info)
                        <tr>
                            <td>{{ $name }}</td>
                            <td>{{ $info['level'] }}</td>
                            <td>{{ $info['total_bet'] }}</td>
                            <td>{{ $info['level_award'] }}</td>
                            <td>{{ $info['week_award'] }}</td>
                            <td>{{ $info['month_award'] }}</td>
                            <td>{{ $info['remain_bet'] ? '距离下一级还差'.$info['remain_bet'].'注' :'' }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="tabBox">
                <table class="table">
                    <thead>
                    <tr>
                        <th>会员帐号</th>
                        <th>奖励类型</th>
                        <th>奖励金额</th>
                        <th>发放时间</th>
                    </tr>
                    </thead>
                    <tbody id="table2">
                    @if($info && $info['list']->count())
                        @foreach($info['list'] as $item)
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $item->operate_type_text }}</td>
                                <td>{{ $item->money }}</td>
                                <td>{{ $item->created_at->toDateString() }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="yj pageNavi">
                <span id="spanFirst"></span>
                <span id="spanPre"></span>
                <span id="spanNext"></span>
                <span id="spanLast"></span>
                <span>第</span><span id="spanPageNum"></span><span>页/共</span><span id="spanTotalPage"></span><span>页</span>

            </div>


        </div>
    </div>
    <script type=text/javascript src="{{ asset('/web/js/slot/week.js') }}"></script>
</body>
</html>