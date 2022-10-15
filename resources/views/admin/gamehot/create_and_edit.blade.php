@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"电子/棋牌游戏修改":"电子/棋牌游戏新增"

@endphp

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i> @lang('res.btn.back')
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ $isUpdated?route('admin.gamehots.update',['gamehot' => $model->id]):route('admin.gamehots.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <input type="hidden" id="iframe_id" value="">
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_list.field.api_name')</label>
                        <div class="col-sm-4">
                            <select name="api_name" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(\App\Models\Api::getApiNameArray() as $key => $value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->api_name == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.common.lang')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.language_type') as $key => $value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->lang == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.game_type')</label>
                        <div class="col-sm-4">
                            <select name="game_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.game_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->game_type == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_hot.field.type')</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.game_hot.hot_game_place_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->type == $key) selected  @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_hot.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $isUpdated?$model->name:"" }}" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.desc')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="desc"
                                   value="{{ $isUpdated?$model->desc:"" }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.jump_link')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="jump_link"
                                   value="{{ $isUpdated?$model->jump_link:"" }}" placeholder="@lang('res.game_hot.field.jump_link_p')" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.is_new_window')</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.boolean') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="is_new_window" @if($isUpdated && $model->is_new_window === $k) checked @endif >
                                    <span>{{ $v }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.game_code')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="game_code"
                                   value="{{ $isUpdated?$model->game_code:"" }}"  required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_hot.field.icon_path')</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="icon_path" placeholder=""
                                   value="{{ $isUpdated ? $model->icon_path :'' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="{{ $isUpdated ? 'icon_path'.$model->id : 'icon_path0' }}"
                                data-field-name="icon_path" data-component="imageUpload"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'gamehot']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                data-image-url="{{ $isUpdated ? $model->icon_path :'' }}">
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.icon_path2')</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="icon_path2" placeholder="@lang('res.game_hot.field.icon_path2_p')"
                                   value="{{ $isUpdated ? $model->icon_path2 :'' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="{{ $isUpdated ? 'icon_path2'.$model->id : 'icon_path20' }}"
                                data-field-name="icon_path2" data-component="imageUpload"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'gamehot']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                data-image-url="{{ $isUpdated ? $model->icon_path2 :'' }}">
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.img_url')</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="img_url" placeholder=""
                                   value="{{ $isUpdated ? $model->img_url :'' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="{{ $isUpdated ? 'img_url'.$model->id : 'img_url0' }}"
                                data-field-name="img_url" data-component="imageUpload"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'gamehot']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                data-image-url="{{ $isUpdated ? $model->img_url :'' }}">
                            </ul>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_hot.field.is_online')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_online" @if($isUpdated && $model->is_online === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_hot.field.sort')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="sort"
                                   value="{{ $isUpdated?$model->sort:"" }}" required >
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit"
                                    type="button" data-select2="tags">@lang('res.btn.save')</button>
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
