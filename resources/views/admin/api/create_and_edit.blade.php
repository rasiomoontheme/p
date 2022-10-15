@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"Cập nhật giao diện API":"Tạo mới giao diện API"
@endphp

@section('title', $title ?? '')

@section('content')
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i>Quay lại
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ $isUpdated?route('admin.apis.update',['api' => $model->id]):route('admin.apis.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">ID giao diện</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="api_id" placeholder="Vui lòng nhập ID giao diện"
                                   value="{{ $isUpdated?$model->api_id:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">ID nền tảng</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="api_name" placeholder="Vui lòng nhập ID nền tảng"
                                   value="{{ $isUpdated?$model->api_name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">Tên mô tả nền tảng</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="api_title" placeholder="Vui lòng nhập tên mô tả nền tảng"
                                   value="{{ $isUpdated?$model->api_title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Số dư giao diện</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="api_money" placeholder="Vui lòng nhập số dư giao diện"
                                   value="{{ $isUpdated?$model->api_money:"" }}" @if(!$isUpdated) required @else readonly @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Tiền tố tài khoản</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="prefix" placeholder="Vui lòng nhập tiền tố tài khoản"
                                   value="{{ $isUpdated?$model->prefix:"" }}" @if(!$isUpdated) required @else readonly @endif>
                        </div>
                    </div>

                    @if(request('is_super'))
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Tiền tệ</label>
                            <div class="col-sm-4">
                                <select name="lang" class="form-control js_select2">
                                    <option value="">@lang('res.common.select_default')</option>
                                    @foreach(config('platform.lang_select') as $k => $v)
                                        <option value="{{ $k }}" @if($isUpdated && $model->lang == $k) selected
                                                @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Các ngôn ngữ được hỗ trợ</label>
                            <div class="col-sm-4">
                                <select id="lang_list" name="lang_list[]" class="form-control js_select2" multiple="multiple">
                                    {{-- <option value="">--请选择--</option> --}}
                                    {{-- @if($isUpdated && $model->tags == $key) selected @endif --}}
                                    @foreach(config('platform.lang_select') as $key =>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">Trạng thái</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Trọng lượng</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight" placeholder="Vui lòng nhập trọng lượng"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Nhận xét</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark" placeholder="Vui lòng nhập nhận xét"
                                   value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.apis.field.icon_url')</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="icon_url" placeholder=""
                                   value="{{ $isUpdated ? $model->icon_url :'' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="{{ $isUpdated ? 'icon_url'.$model->id : 'icon_url0' }}"
                                data-field-name="icon_url" data-component="imageUpload"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'icon']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                data-image-url="{{ $isUpdated ? $model->icon_url :'' }}">
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button">Lưu nội dung</button>
                            <button class="btn btn-default" type="reset">Đặt lại</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer-js')
    {{--<script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>--}}
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {

            if($("[name=id]").length){
                $("#lang_list").val({!! $model->lang_list ?? "" !!}).trigger('change');
            }

        });

    </script>
    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        $.utils.configLayDate();
        $.utils.configImageUpload();


        $(function(){
            var upload_url = "{{ route('attachment.upload',['file_type' => 'pic','category' => 'game_hot']) }}";
            tinymce.init($.utils.getTinymceConfig('.tinymce-content', upload_url));

            var file_upload_url = "{{ route('attachment.upload',['file_type' => 'pic','category' => 'game_hot']) }}";

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
        })
    </script>
@endsection
