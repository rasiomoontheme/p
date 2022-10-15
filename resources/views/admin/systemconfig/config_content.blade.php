@extends('layouts.baseframe')

@php
    // $title = '文本内容设置'
@endphp

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
            @lang('res.system_config.app_content.top_notice')
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

                <ul class="nav nav-tabs">
                    @foreach($configs as $k => $item)
                        <li @if($k == $group) class="active" @endif>
                            <a href="{{ route('admin.systemconfigs.config_content',['group' => $k]) }}">{{ $item }}</a>
                        </li>
                    @endforeach
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in">
                        @include('layouts._system_config_field',['group_name' => $group])
                    </div>
                </div>

                {{--
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#register" id="register-tab" role="tab" data-toggle="tab">注册相关</a>
                    </li>

                    <li>
                        <a href="#navigate" id="navigate-tab" role="tab" data-toggle="tab">导航相关</a>
                    </li>

                    <li>
                        <a href="#activity_about" id="activity_about-tab" role="tab" data-toggle="tab">活动相关</a>
                    </li>

                    <li>
                        <a href="#credit" id="credit-tab" role="tab" data-toggle="tab">借呗相关</a>
                    </li>

                    <li>
                        <a href="#levelup_slot" id="levelup_slot-tab" role="tab" data-toggle="tab">电子升级</a>
                    </li>

                    <li>
                        <a href="#levelup_live" id="levelup_live-tab" role="tab" data-toggle="tab">真人升级</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="register">
                        @include('layouts._system_config_field',['group_name' => 'register'])
                    </div>

                    <div class="tab-pane fade" id="navigate">
                        @include('layouts._system_config_field',['group_name' => 'navigate'])
                    </div>

                    <div class="tab-pane fade" id="activity_about">
                        @include('layouts._system_config_field',['group_name' => 'activity_about'])
                    </div>

                    <div class="tab-pane fade" id="credit">
                        @include('layouts._system_config_field',['group_name' => 'credit'])
                    </div>

                    <div class="tab-pane fade" id="levelup_slot">
                        @include('layouts._system_config_field',['group_name' => 'levelup_slot'])
                    </div>

                    <div class="tab-pane fade" id="levelup_live">
                        @include('layouts._system_config_field',['group_name' => 'levelup_live'])
                    </div>

                </div>
                --}}
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
        })
    </script>
@endsection
