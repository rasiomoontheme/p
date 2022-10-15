<!DOCTYPE html>
<html lang="{{ $_member->lang ?? 'zh_cn'}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', systemconfig('site_title') ?? '麟游') - @lang('res.common.title')</title>
    <meta name="keywords" content="{{ systemconfig('site_title') ?? '麟游' }}">
    <meta name="description" content="{{ systemconfig('site_title') ?? '麟游' }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/bootstrap-multitabs/multitabs.min.css') }}">
</head>

<body data-logobg="color_8" data-headerbg="color_8" data-sidebarbg="color_8">
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
        padding-bottom: 30px;
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
    @include('agent.layouts._menu')

    @include('agent.layouts._header')

    <!--页面主要内容-->
        <main class="lyear-layout-content">
            <div id="iframe-content"></div>
        </main>
        <!--End 页面主要内容-->
    </div>
</div>

{{-- <div class="notice-layer" style="display: none;"
    data-show=0
    data-url="{{ route('admin.notice') }}">
    <div class="notice-area">
        <a href="{{ route('admin.recharges.index') }}" data-title="充值列表" class="js-create-tab multitabs">
            <p>您有 <span id="rechargeNum">0</span> 条汇款请求未处理</p>
        </a>
        <a href="{{ route('admin.drawings.index') }}" data-title="提款列表" class="js-create-tab multitabs">
            <p>您有 <span id="drawingNum">0</span> 条提款请求未处理</p>
        </a>

        <a href="{{ route('admin.messages.index_member') }}" data-title="站内信列表" class="js-create-tab multitabs">
            <p>您有 <span id="messageNum">0</span> 条站内信未处理</p>
        </a>

        <a href="{{ route('admin.memberagentapplies.index') }}" data-title="会员代理申请列表" class="js-create-tab multitabs">
            <p>您有 <span id="agentAppliesNum">0</span> 条代理申请未处理</p>
        </a>
    </div>
</div> --}}

<script src="{{ mix('/js/app.js') }}"></script>

{{-- <script src="{{ mix('/js/main.js') }}"></script> --}}

{{-- <script src="{{ asset('/js/base-src/jquery.min.js') }}"></script>
<script src="{{ asset('/js/base-src/bootstrap.min.js') }}"></script>
--}}

<script src="{{ asset('/js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/index.min.js') }}"></script>
<script src="{{ asset('/js/layer/layer.js') }}"></script>
<script src="{{ asset('/js/ajax-submit-form.js') }}"></script>
<script src="{{ asset('/js/bootstrap-multitabs/multitabs.js') }}"></script>
<script>
    window.layer = layer;
</script>
</body>

</html>
