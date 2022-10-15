<!DOCTYPE html>
<html lang="{{ request()->is('admin/*') ? ($_user->lang ?? 'zh_cn') : ($_member->lang ?? 'zh_cn') }}">
{{-- @php
    $permission = \App\Models\Permission::query()->getByRouteName(app('request')->route()->getName())->first();
    $title = $permission ? $permission->name : "";   
@endphp --}}
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
    <link rel="stylesheet" href="{{ asset('/js/select2/select2.min.css') }}">

    <style>
        .control-label.required::before {
            content: '*';
            position: absolute;
            font-size: 20px;
            color: red;
            right: 0px;
            top: 6px;
        }
        .select2-container {
            width: 100%!important;
        }
        tfoot{
            color: red;font-weight:700;
        }
        img{
            background: #aaa;
        }
        .switch-col > .lyear-switch{
            height: 38px;
            padding: 5px 12px;
            line-height: inherit;
            display: block;
        }
        #table tbody span.label-danger{font-weight: bold;}
        div.card div.card-body div.table-responsive {width:100%; overflow-x: scroll;}

        div.table-responsive:after{display:block;content:'';min-height: 240px;}
        div.card-body > div.clearfix  {margin-top: -160px;}
        div.table-responsive table thead tr th:last-child {min-width: 120px}
        div.table-responsive table thead tr th:nth-last-child(2) {min-width: 100px}

        div.btn-group.dropup {position: absolute !important;}
        ul.dropdown-menu.progress-bar-info>li>a{color:white;opacity: 0.8;padding-top: 5px;padding-bottom: 5px;}
        ul.dropdown-menu.progress-bar-info>li>a:hover{color:#262626;}

        div.card-header > ul.card-actions >li >button{
            font-size: 16px;
            color: #333;
        }
    </style>

    @yield('css')
</head>

<body>
    <div class="container-fluid p-t-15">
        <div class="row">
            @yield('content')
        </div>
    </div>


    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/js/select2/i18n/zh-CN.js') }}"></script>
    <script src="{{ asset('/js/main.min.js') }}"></script>
    <script src="{{ asset('/js/layer/layer.js') }}"></script>
    <script src="{{ asset('/js/laydate/laydate.js') }}"></script>
{{--    <script src="{{ asset('/js/ajax-submit-form.js').'?'.time() }}"></script>--}}
    <script src="{{ asset('/js/ajax-submit-form.js') }}"></script>
    <script>
        if(!window.layer) window.layer = layer;
    </script>
    {{-- <script type="text/javascript" src="http://libs.itshubao.com/magnific-popup/jquery.magnific-popup.min.js"></script> --}}

    @yield('footer-js')

    <script>
        $(function(){
            $('.card').each(function(i,v){
                if($('.mdi-refresh').length > 0){
                    if($(this).parent().attr('class') == 'col-sm-12' && i == 0){
                        var html = '<div class="alert alert-danger alert-dismissible" role="alert">\n' +
                            '        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>\n' +
                            '        '+ '{!! trans('res.common.page_notice') !!}' +'\n' +
                            '      </div>';
                        $(this).before(html);
                    }
                }
            });
        });
    </script>
</body>

</html>
