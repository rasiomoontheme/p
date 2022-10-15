@extends('web.layouts.activity_base')

@section('content')
<div class="mobile_bar">
    <a href="{{ route('web.index') }}">返回首页</a>
    <a href="{{ systemconfig('service_link') }}" target="_blank">在线客服</a>
{{--    <a href="{{ route('web.index') }}">快速充值</a>--}}
    <a href="{{ systemconfig('wap_app_link') }}" target="_blank">APP下载</a>
</div>


<div class="big-section">
    <div class="bgBox">
        <div class="wrap">
            <ul class="activity-ul">

				@foreach($data as $item)
                <li>
                    <a href="{{ route('web.activity.detail',['activity' => $item->id]) }}" target="_blank" class="yh1">
                        <img src="{{ $item->hall_image }}">
                        <div class="hover-img"><img src="{{ asset('web/images/activity/logo.png') }}"></div>
                    </a>
                    <p>{{ $item->title }}</p>
                    <div class="bt-href">
                        <a href="{{ route('web.activity.detail',['activity' => $item->id]) }}" target="_blank" class="yh2">点击申请</a>
                    </div>
				</li>
				@endforeach
            </ul>

        </div>

    </div>
    <cent></cent>
    <p class="prompt-p"></p>
</div>

<div class="reveal-bg">
    <div class="reveal">
        <div class="nav-links">
            <ul>
                <li>
                    <a href="{{ quicklink('pc_register') }}" target="_blank">
                        <div class="inner">
                            <i class="i-1"></i>免费开户
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ systemconfig('wap_app_link') }}" target="_blank">
                        <div class="inner">
                            <i class="i-2"></i>APP下载
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ systemconfig('site_mobile') }}" target="_blank">
                        <div class="inner">
                            <i class="i-3"></i>手机投注
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ quicklink('pc_slot') }}" target="_blank">
                        <div class="inner">
                            <i class="i-4"></i>电子游艺
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/" target="_blank">
                        <div class="inner">
                            <i class="i-5"></i>线路检测
                        </div>
                    </a>
                </li>
                <li>
                    <a href="https://www.firefox.com.cn/" target="_blank">
                        <div class="inner">
                            <i class="i-6"></i>火狐浏览器
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/" target="_blank">
                        <div class="inner">
                            <i class="i-7"></i>上网导航
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ systemconfig('service_link') }}" target="_blank">
                        <div class="inner">
                            <i class="i-8"></i>在线客服
                        </div>
                    </a>
                </li>
            </ul>
		</div>
		
		{{-- 中奖信息滚动 --}}
        <div class="reveal-fr fr">
            <div class="scrollbox">
                <div class="titles1"></div>
                <div id="scrollDiv">
                    <ul style="margin-top: 0px;">
                        <li>恭喜：<span class="red">s*****34 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">S*****64 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">s****30 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">t*****88 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">T*****17 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">m******90 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">z****22 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        <li>恭喜：<span class="red">q*****44 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">q*******9 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">q*******51 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">q*****1 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                        <li>恭喜：<span class="red">q******33 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">q*******7 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">q*******33 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">q*********88 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">R*****75 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">r****8 </span>成功办理<span class="yellow">
                                {{ count($data) ? $data->random()->title : ' - ' }}</span></li>
                        <li>恭喜：<span class="red">s****19 </span>成功办理<span class="yellow"> {{ count($data) ? $data->random()->title : ' - ' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
