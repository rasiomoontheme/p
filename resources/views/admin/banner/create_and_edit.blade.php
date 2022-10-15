@extends('layouts.baseframe')

@php
    $isUpdated = isset($model->id);
@endphp

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            @lang('res.banner.edit.top_notice')
        </div>

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
                      action="{{ $isUpdated?route('admin.banners.update',['banner' => $model->id]):route('admin.banners.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.banner.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title"
                                   value="{{ $isUpdated?$model->title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.banner.field.url')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="url"
                                   value="{{ $isUpdated?$model->url:"" }}" @if(!$isUpdated) required @endif readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            {{-- data-operate="upload-image" --}}
                            <ul class="list-inline clearfix lyear-uploads-pic"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'banner']) }}"
                                data-delete-url="{{ route('attachment.delete') }}" @if($isUpdated) data-image-url="{{ $model->url }}" @endif>
                            </ul>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.banner.field.groups')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="groups"
                                   value="{{ $isUpdated?$model->groups:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                @lang('res.banner.edit.group_notice')
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_hot.field.jump_link')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="jump_link"
                                   value="{{ $isUpdated?$model->jump_link:"" }}" >
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
                        <label class="col-sm-2 control-label required">@lang('res.banner.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.banner.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
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
                        <label class="col-sm-2 control-label">@lang('res.banner.field.description')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="description"
                                   value="{{ $isUpdated?$model->description:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

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


@section('footer-js')
    <script>

        $(function () {
            $('.lyear-uploads-pic').imageUpload({
                $callback_input: $('.form-control[name="url"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });
        });

    </script>
@endsection
