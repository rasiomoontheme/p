@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"系统配置修改":"系统配置新增"
@endphp

@section('title', $title ?? '')

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>注意：</strong> 配置分组值为“system”时表示系统变量，不允许修改
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i>返回
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ $isUpdated?route('admin.systemconfigs.update',['systemconfig' => $model->id]):route('admin.systemconfigs.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">系统配置英文标识</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="name" placeholder="请输入系统配置英文标识"
                                   value="{{ $isUpdated?$model->name:"" }}" @if($isUpdated) readonly @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置标题</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title" placeholder="请输入配置标题"
                                   value="{{ $isUpdated?$model->title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">配置类型</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(\App\Models\SystemConfig::$configTypeMap as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">配置值</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="value" placeholder="请输入配置值"
                                   value="{{ $isUpdated?$model->value:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">配置数据源</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="data_config" placeholder="请输入配置值"
                                   value="{{ $isUpdated?$model->data_config:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-6 help-block">
                            只有在类型是 【下拉框】时才需要填写该值
                        </div>
                    </div>

                    <div class="form-group" id="upload-area" style="display: none;">
                        <label class="col-sm-2 control-label">上传图片</label>
                        <div class="col-sm-8">
                            {{-- data-operate="upload-image" --}}
                            <ul class="list-inline clearfix lyear-uploads-pic"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'config']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                @if($isUpdated && $model->type == \App\Models\SystemConfig::CONFIG_TYPE_PICTURE) data-image-url="{{ $model->value }}" @endif>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">配置分组</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="config_group" placeholder="请输入配置分组" autocomplete="on"
                                   value="{{ $isUpdated?$model->config_group:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">快捷跳转HTML</label>
                        <div class="col-sm-4">
                            <textarea type="text" class="form-control" name="link_html" cols="30" rows="3" placeholder="请输入快捷跳转地址（相对地址）">{{  $isUpdated ? $model->link_html : "" }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">是否启用</label>
                        <div class="col-sm-4">
                            @foreach(\App\Models\Base::$isOpenMap as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">权重</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight" placeholder="请输入权重" value="{{ $isUpdated?$model->weight:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <span class="help-block">越大越靠前，最大值为255</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="description" placeholder="请输入描述" cols="30" rows="3">{{ $isUpdated?$model->description:"" }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button">保存内容</button>
                            <button class="btn btn-default" type="reset">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer-js')
    <script>
        $(function () {
            $('.lyear-uploads-pic').imageUpload({
                $callback_input: $('.form-control[name="value"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            var typeSelect = $("[name='type']");

            generateHtmlByType();

            function generateHtmlByType() {
                var typeText = typeSelect.find("option:selected").attr("value");
                if (typeText == "picture") {
                    $('input[name="value"]').attr('readonly',true);
                    $("#upload-area").show();
                }
            }

            $("[name='type']").change(function () {
                // alert("选中项是："+$(this).find("option:selected").attr("value"));
                // var type = $(this).find("option:selected").attr("value");
                // var formgroup = $(this).parents(".form-group");

                $("#upload-area").hide();
                $('input[name="value"]').attr('readonly',false);

                generateHtmlByType();

            });

        });

    </script>
@endsection
