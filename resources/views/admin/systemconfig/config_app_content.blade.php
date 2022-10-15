@extends('layouts.baseframe')

@php
    // $title = 'APP内容设置'
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

                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#app_content" id="register-tab" role="tab" data-toggle="tab">@lang('res.system_config.app_content.app_content')</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="register">
                        @include('layouts._system_config_field',['group_name' => 'app_content'])
                    </div>

                </div>

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
