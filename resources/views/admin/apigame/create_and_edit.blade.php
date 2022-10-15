@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"API游戏修改":"API游戏新增";
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
                      action="{{ $isUpdated?route('admin.apigames.update',['apigame' => $model->id]):route('admin.apigames.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.api_game.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title"
                                   value="{{ $isUpdated?$model->title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    @foreach(config('platform.language_type') as $k => $v)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.api_game.field.title')[{{$v}}]</label>
                            <div class="col-sm-4">
                                <input type="text" required class="form-control" name="lang_json[{{ $k }}]" placeholder="Vui lòng nhập tên trò chơi[{{$v}}]"
                                       value="{{ $isUpdated ? $model->getLangTitle($k):"" }}">
                            </div>
                        </div>
                    @endforeach

                    <input type="hidden" name="redirect_url" value="{{ url()->previous() }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.subtitle')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="subtitle"
                                   value="{{ $isUpdated?$model->subtitle:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.web_pic')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="web_pic"
                                   value="{{ $isUpdated?$model->web_pic:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <span class="help-block">@lang('res.api_game.index.web_pic_notice')</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="web_pic"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'api_game']) }}"
                                data-delete-url="{{ route('attachment.delete') }}" @if($isUpdated)
                                data-image-url="{{ $model->web_pic }}" @endif>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.mobile_pic')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="mobile_pic"
                                   value="{{ $isUpdated?$model->mobile_pic:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="mobile_pic"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'api_game']) }}"
                                data-delete-url="{{ route('attachment.delete') }}" @if($isUpdated)
                                data-image-url="{{ $model->mobile_pic }}" @endif>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.apis.field.logo_url')</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="logo_url" placeholder=""
                                   value="{{ $isUpdated ? $model->logo_url :'' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="logo_url"
                                data-field-name="logo_url" data-component="imageUpload"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'logo']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                data-image-url="{{ $isUpdated ? $model->logo_url :'' }}">
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.api_game.field.api_name')</label>
                        <div class="col-sm-4">
                            <select name="api_name" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(App\Models\Api::query()->getApiNameArray() as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->api_name == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.class_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="class_name"
                                   value="{{ $isUpdated?$model->class_name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.api_game.field.game_type')</label>
                        <div class="col-sm-4">
                            <select name="game_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.game_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->game_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.params')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="params"
                                   value="{{ $isUpdated?$model->params:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.client_type')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.client_type') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="client_type" @if($isUpdated && $model->client_type === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.api_game.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.api_game.field.tags')</label>
                        <div class="col-sm-4">
                            <select id="tags" name="tags[]" class="form-control js_select2" multiple="multiple">
                                {{-- <option value="">--请选择--</option> --}}
                                {{-- @if($isUpdated && $model->tags == $key) selected @endif --}}
                                @foreach(trans('res.option.tag_type') as $key =>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.common.lang')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.lang_fields') as $k => $v)
                                    <option value="{{ $k }}" @if($isUpdated && $model->lang == $k) selected
                                            @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.api_game.field.remark')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark"
                                   value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit"
                                    type="button" data-select2="tags" >@lang('res.btn.save')</button>
                            <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer-js')
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {

            // 单图上传
            $('#web_pic').imageUpload({
                $callback_input: $('.form-control[name="web_pic"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });
            // 单图上传
            $('#mobile_pic').imageUpload({
                $callback_input: $('.form-control[name="mobile_pic"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            $('#logo_url').imageUpload({
                $callback_input: $('.form-control[name="logo_url"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });


            if($("[name=id]")){
                $("#tags").val({!! json_encode($model->tags_array ?? []) !!}).trigger('change');
            }

        });

    </script>
@endsection
