@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    <style>
        div.switch-col{
            height:36px;
            line-height:48px;
        }
    </style>

    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            @lang('res.system_config.config_groups.top_notice')
        </div>

        <div class="card">

            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body">

                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#system" id="system-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.system')</a>
                    </li>
                    <li>
                        <a href="#activity" id="activity-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.activity')</a>
                    </li>
                    <li>
                        <a href="#service" id="service-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.service')</a>
                    </li>
                    <li>
                        <a href="#line" id="line-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.line')</a>
                    </li>
                    <li>
                        <a href="#site" id="site-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.site')</a>
                    </li>
                    {{--
                    <li>
                        <a href="#recharge" id="recharge-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.recharge')</a>
                    </li>
                    --}}
                    <li>
                        <a href="#drawing" id="drawing-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.drawing')</a>
                    </li>

                    <li>
                        <a href="#register" id="register-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.register')</a>
                    </li>

                    <li>
                        <a href="#agent" id="agent-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.agent')</a>
                    </li>

                    <li>
                        <a href="#notice" id="notice-tab" role="tab" data-toggle="tab">@lang('res.system_config.config_groups.notice')</a>
                    </li>

                    {{--
                    <li>
                        <a href="#navigate" id="navigate-tab" role="tab" data-toggle="tab">导航相关</a>
                    </li>
                    --}}

                    {{-- <li class="dropdown">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"
                            aria-controls="myTabDrop1-contents" aria-expanded="false">其他 <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="myTabDrop1-contents">
                            <li><a href="#dropdown1" id="dropdown1-tab" data-toggle="tab">梁羽生</a></li>
                            <li><a href="#dropdown2" id="dropdown2-tab" data-toggle="tab">陈青云</a></li>
                        </ul>
                    </li> --}}
                </ul>

                <div id="myTabContent" class="tab-content">

                    <div class="tab-pane fade active in" id="system">
                        @include('layouts._system_config_field',['group_name' => 'system'])
                    </div>

                    <div class="tab-pane fade" id="activity">
                        @include('layouts._system_config_field',['group_name' => 'activity'])
                    </div>

                    <div class="tab-pane fade" id="service">
                        @include('layouts._system_config_field',['group_name' => 'service'])
                    </div>

                    <div class="tab-pane fade" id="line">
                        @include('layouts._system_config_field',['group_name' => 'line'])
                    </div>

                    <div class="tab-pane fade" id="site">
                        @include('layouts._system_config_field',['group_name' => 'site'])
                    </div>

                    {{--
                    <div class="tab-pane fade" id="recharge">
                        @include('layouts._system_config_field',['group_name' => 'recharge'])
                    </div>
                    --}}

                    <div class="tab-pane fade" id="drawing">
                        @include('layouts._system_config_field',['group_name' => 'drawing'])
                    </div>


                    <div class="tab-pane fade" id="register">
                        @include('layouts._system_config_field',['group_name' => 'register'])

                        {{--
                        <div class="col-sm-4 col-sm-offset-2" style="padding-bottom: 20px">

                            <a class="btn btn-warning" href="javascript:;"
                               data-operate="iframe-page"
                               data-title="@lang('res.member.index.register_setting')"
                               data-url="{{ route("admin.member.register_setting") }}">
                                @lang('res.member.index.register_setting')
                            </a>

                        </div>
                        --}}
                    </div>


                    <div class="tab-pane fade" id="agent">
                        @include('layouts._system_config_field',['group_name' => 'agent'])
                    </div>

                    {{--
                    <div class="tab-pane fade" id="navigate">
                        @include('layouts._system_config_field',['group_name' => 'navigate'])
                    </div>
                    --}}

                    <div class="tab-pane fade" id="notice">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            @lang('res.system_config.config_groups.group_notice')
                        </div>

                        @include('layouts._system_config_field',['group_name' => 'notice'])
                        {{--
                        <form class="form-horizontal" action="{{ route('admin.systemconfigs.post_config_groups') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label class="col-sm-2 control-label">上分提醒</label>
                                <div class="col-sm-4 mp3-area">
                                    <input type="text" class="form-control mp3-path" placeholder="请选择上传文件"
                                           value="" readonly name="recharge_notice">
                                    <input type="file" class="mp3-uploader" accept="mp3" style="display: none">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-info mp3-btn" type="button">选择文件</button>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" data-operate="ajax-submit"
                                            type="button">保存内容</button>
                                    <button class="btn btn-default" type="reset">重置</button>
                                </div>
                            </div>
                        </form>
                        --}}
                    </div>

                </div>

            </div>

        </div>

        <div class="card" id="register-setting">
            <div class="card-header">
                @lang('res.member.index.register_setting')
            </div>

            <div class="card-body">
                <form action="{{ route('admin.member.post_register_setting') }}" method="post" id="searchForm" name="searchForm"
                      class="form-horizontal">

                    @foreach(config('platform.register_setting_field') as $key => $val)
                        @php
                            $data = \App\Models\SystemConfig::query()->getConfigValue('register_setting_json',\App\Models\Base::LANG_COMMON);
                            if($data) $data = json_decode($data,1);
                            else $data = [];
                            $isopen = \Illuminate\Support\Arr::get($data,$key,1)
                        @endphp

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ trans('res.option.register_setting_field')[$key] }}</label>
                            <div class="col-sm-4 switch-col">
                                <label class="lyear-switch switch-solid switch-primary">
                                    <input type="checkbox" name="{{ $key }}" value="{{ $isopen }}" @if($isopen) checked @endif>

                                    @if(!$isopen)
                                        <input type="hidden" name="{{ $key }}" value="{{ $isopen }}">
                                    @endif
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
                            <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

@section("footer-js")
    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        $.utils.configLayDate();
        $.utils.configImageUpload();


        $(function(){
            var upload_url = "{{ route('attachment.upload',['file_type' => 'pic','category' => 'editor']) }}";
            tinymce.init($.utils.getTinymceConfig('.tinymce-content', upload_url));

            var file_upload_url = "{{ route('attachment.upload',['file_type' => \App\Models\Attachment::FILE_TYPE_FILE,'category' => 'editor']) }}";

            // 选择文件之后，调用上传事件
            $('.mp3-uploader').change(function(e){
                // $(this).siblings('.mp3-path').val($(this).val());
                var inputObj = $(this);

                var fileInputObj = inputObj.siblings('.mp3-path');

                var btnWrapper = inputObj.parents('.form-group').find('div.btn-operates');

                // 判断文件个数 // 如果没有检测到文件，则返回
                if (inputObj[0].files.length < 1) {
                    e.target.value = "";
                    return;
                }

                var fileObj = inputObj[0].files[0];

                // 执行文件上传操作
                var formData = new FormData();
                formData.append("file", fileObj);

                $.ajax({
                    type: "post",
                    url: file_upload_url,
                    data: formData,
                    async: false, //异步
                    cache: false,
                    processData: false, //很重要，告诉jquery不要对form进行处理
                    contentType: false, //很重要，指定为false才能形成正确的Content-Type
                    success:function(res){
                        if(res.status == 'success'){
                            var url = res.file_url;
                            $.utils.layerSuccess(res.message);

                            // 输入框赋值
                            fileInputObj.val(url);
                            // 显示预览按钮
                            if(btnWrapper.find('a.btn-default').length > 0) btnWrapper.find('a.btn-default').attr('href',url)
                            else btnWrapper.append("<a class='btn btn-default btn-sm' href='"+url+"' target='_blank'>预览</a>");
                        }
                        e.target.value = "";
                    },
                    error:function(){
                        e.target.value = "";
                    }
                })
            });

            $('.mp3-btn').click(function(){
                $(this).parent().siblings('.mp3-area').find('.mp3-uploader').click();
            });

            initView();

            function initView(){
                $('#register-setting').hide();

                if($('#register-tab').parent().hasClass('active')){
                    $('#register-setting').show();
                }else{
                    $('#register-setting').hide();
                }
            }

            $('a[data-toggle="tab"]').on('shown.bs.tab',function(){
                initView();
            });
        })
    </script>
@endsection
