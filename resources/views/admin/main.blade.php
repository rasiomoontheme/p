<!DOCTYPE html>
<html lang="{{ $_user->lang ?? 'zh_cn'}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', systemconfig('site_title') ?? 'NOC88BET') - @lang('res.common.title')</title>
    <meta name="keywords" content="{{ systemconfig('site_title') ?? 'NOC88BET' }}">
    <meta name="description" content="{{ systemconfig('site_title') ?? 'NOC88BET' }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/bootstrap-multitabs/multitabs.min.css') }}">
</head>

<body>
<style>
    .topbar .topbar-left{
        list-style: none;
    }
    .topbar .topbar-left li.dropdown{
        padding: 0px 10px;
    }
    .notice-area{
        min-height: 120px;
        min-width: 200px;
        padding: 10px;
    }
    .notice-area p{
        width: 100%;
        cursor: pointer;
        height: 28px;
        line-height: 28px;
        background: none;
        color: #4d5259 !important;
    }
    .notice-area p:hover{
        background: #eee;
    }
    .notice-area span{
        color: green;
        font-weight: bold;
    }
</style>
<div class="lyear-layout-web">
    <div class="lyear-layout-container">
    @include('admin.layouts._menu')

    @include('admin.layouts._header')

    <!--页面主要内容-->
        <main class="lyear-layout-content">
            <div id="iframe-content"></div>
        </main>
        <!--End 页面主要内容-->
    </div>
</div>

<div class="notice-layer" style="display: none;"
     @if(\Str::contains(systemconfig('notice_type'),'alert')) data-alert-on="1" @endif
     @if(\Str::contains(systemconfig('notice_type'),'voice')) data-voice-on="1" @endif

     data-voice-list="{{ $voice_list->implode('name',',') }}"

     @if($voice_list->count())
     @foreach($voice_list as $item)
     data-{{ $item->name }}
     @endforeach
     @endif

     data-show=0
     data-url="{{ route('admin.notice') }}">
    <div class="notice-area">
        <a href="{{ route('admin.recharges.index') }}" data-title="@lang('res.notice.recharge_title')" class="js-create-tab multitabs">
            @lang('res.notice.recharge_notice')
        </a>
        <a href="{{ route('admin.drawings.index') }}" data-title="@lang('res.notice.drawing_title')" class="js-create-tab multitabs">
            @lang('res.notice.drawing_notice')
        </a>

        <a href="{{ route('admin.messages.index_member') }}" data-title="@lang('res.notice.message_title')" class="js-create-tab multitabs">
            @lang('res.notice.message_notice')
        </a>

        <a href="{{ route('admin.memberagentapplies.index') }}" data-title="@lang('res.notice.memberagentapplies_title')" class="js-create-tab multitabs">
            @lang('res.notice.memberagentapplies_notice')
        </a>

        <a href="{{ route('admin.members.index') }}" data-title="@lang('res.notice.members_title')" class="js-create-tab multitabs">
            @lang('res.notice.members_notice')
        </a>

        <a href="{{ route('admin.activityapplies.index') }}" data-title="@lang('res.notice.activityapplies_title')" class="js-create-tab multitabs">
            @lang('res.notice.activityapplies_notice')
        </a>

        <a href="{{ route('admin.memberyuebaoplans.index') }}" data-title="@lang('res.notice.memberyuebaoplans_title')" class="js-create-tab multitabs">
            @lang('res.notice.memberyuebaoplans_notice')
        </a>

        <a href="{{ route('admin.creditpayrecord.borrow') }}" data-title="@lang('res.notice.creditpayrecord_title')" class="js-create-tab multitabs">
            @lang('res.notice.creditpayrecord_notice')
        </a>

        <a href="{{ route('admin.creditpayrecord.borrow',['is_overdue' => 1,'is_read' => 0]) }}" data-title="@lang('res.notice.creditpayrecord_overdue_title')" class="js-create-tab multitabs">
            @lang('res.notice.creditpayrecord_overdue_notice')
        </a>
    </div>
</div>

@foreach($voice_list as $item)
    <audio src="{{ $item->value }}" id="{{ $item->name }}"></audio>
@endforeach

<script src="{{ mix('/js/app.js') }}"></script>

{{-- <script src="{{ mix('/js/main.js') }}"></script> --}}

{{-- <script src="{{ asset('/js/base-src/jquery.min.js') }}"></script>
<script src="{{ asset('/js/base-src/bootstrap.min.js') }}"></script>
--}}

<script src="{{ asset('/js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/layer/layer.js') }}"></script>
<script src="{{ asset('/js/ajax-submit-form.js') }}"></script>
<script src="{{ asset('/js/index.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-multitabs/multitabs.js') }}"></script>
<script>
    window.layer = layer;
</script>
</body>

</html>
