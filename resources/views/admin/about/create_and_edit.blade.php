@extends('layouts.baseframe')

@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"关于我们修改":"关于我们新增"
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
                      action="{{ $isUpdated?route('admin.abouts.update',['about' => $model->id]):route('admin.abouts.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.about.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title"
                                   value="{{ $isUpdated?$model->title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.about.field.subtitle')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="subtitle"
                                   value="{{ $isUpdated?$model->subtitle:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.about.field.cover_img')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="cover_image"
                                   value="{{ $isUpdated?$model->cover_image:"" }}" @if(!$isUpdated) required @endif readonly>
                        </div>
                    </div>

                    <div class="form-group" id="upload-area">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            {{-- data-operate="upload-image" --}}
                            <ul class="list-inline clearfix lyear-uploads-pic"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'about']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                @if($isUpdated) data-image-url="{{ $model->cover_image }}" @endif>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.about.field.type')</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.about_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.about.field.content')</label>
                        <div class="col-sm-10">
                        <textarea id="content" class="tinymce-content">
                            @if($isUpdated) {!! $model->content !!} @endif
                        </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.about.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.about.field.is_hot')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_hot" @if($isUpdated && $model->is_hot === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.about.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.about.field.lang')</label>
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
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit"  type="button"
                                    data-tinymce="content">@lang('res.btn.save')</button>
                            <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer-js')
    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {
            var upload_url = "{{ route('attachment.upload',['file_type' => 'pic','category' => 'editor']) }}";
            tinymce.init($.utils.getTinymceConfig('.tinymce-content', upload_url));


            // 单图上传
            $('.lyear-uploads-pic').imageUpload({
                $callback_input: $('.form-control[name="cover_image"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });
        });

    </script>
@endsection
