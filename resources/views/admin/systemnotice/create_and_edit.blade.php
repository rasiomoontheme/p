@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"系统公告修改":"系统公告新增";
    $group_array = App\Models\SystemNotice::where('group_name','!=','')->isApp()->get()->pluck('group_name')->toArray();
    $isApp = isApp();
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
                      action="{{ $isUpdated?route('admin.systemnotices.update',['systemnotice' => $model->id]):route('admin.systemnotices.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.system_notice.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title"
                                   value="{{ $isUpdated?$model->title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    @if($isApp)
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.system_notice.field.text_content')</label>
                            <div class="col-sm-10">
                            <textarea class="tinymce-content" id="text_content">
                                @if($isUpdated) {!! $model->text_content !!} @endif
                            </textarea>
                            </div>
                        </div>
                    @endif

                    @if(!$isApp)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.system_notice.field.group_name')</label>
                            <div class="col-sm-4">
                                <select name="group_name" class="form-control js_select2" @if($isUpdated) disabled @endif>
                                    <option value="">@lang('res.common.select_default')</option>
                                    @foreach(trans('res.option.notice_group') as $k => $v)
                                        <option value="{{ $k }}" @if($isUpdated && $model->group_name == $k) selected
                                                @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.system_notice.field.content')</label>
                            <div class="col-sm-6">
                                <textarea name="content" class="form-control" cols="30" rows="4">{{ $isUpdated?$model->content:"" }}</textarea>
                            </div>
                        </div>

                        <div class="form-group" id="pic-area">
                            <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                            <div class="col-sm-8">
                                {{-- data-operate="upload-image" --}}
                                <ul class="list-inline clearfix lyear-uploads-pic"
                                    data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'notice']) }}"
                                    data-delete-url="{{ route('attachment.delete') }}"
                                    @if($isUpdated && in_array($model->group_name,[\App\Models\SystemNotice::GROUP_PC,\App\Models\SystemNotice::GROUP_MOBILE]) )
                                    data-image-url="{{ $model->content }}"@endif>
                                </ul>
                            </div>
                        </div>

                        {{--
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.system_notice.field.group_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="group_name" value="{{ $isUpdated?$model->group_name:"" }}"
                                @if(!$isUpdated) required @endif>
                        </div>
                        @if(count($group_array))
                        <div class="col-sm-4">
                            <span class="help-block"> @lang('res.system_notice.edit.notice_group')
                                @foreach(get_unique_array($group_array) as $item)
                                    <a href="#" class="quick-text" data-target="group_name">
                                        {{ $item }}
                                    </a>，
                                @endforeach
                            </span>
                        </div>
                        @endif
                         </div>
                        --}}

                    @else
                        <input type="hidden" name="group_name" value="app">
                        <input type="hidden" name="is_app" value="1">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.system_notice.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.system_notice.field.url')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="url"
                                   value="{{ $isUpdated?$model->url:"" }}" @if(!$isUpdated) required @endif>
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
                        <label class="col-sm-2 control-label ">@lang('res.system_notice.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button" @if($isApp) data-tinymce="text_content" @endif>@lang('res.btn.save')</button>
                            <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
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
    @if($isApp)
        <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    @endif
    <script>
        $(function () {
            @if($isApp)
            var upload_url = "{{ route('attachment.upload',['file_type' => 'pic','category' => 'editor']) }}";
            tinymce.init($.utils.getTinymceConfig('.tinymce-content', upload_url));
            @endif

            $('.lyear-uploads-pic').imageUpload({
                $callback_input: $('.form-control[name="content"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            initView();

            $('[name=group_name]').change(function(){
                initView();
            });

            function initView(){
                $('#pic-area').hide();
                $('[name="content"]').removeAttr('readonly');

                var select = $("[name='group_name']");
                var selectValue = select.find("option:selected").attr("value");
                if(selectValue == '{{ \App\Models\SystemNotice::GROUP_MOBILE }}'
                    || selectValue == '{{ \App\Models\SystemNotice::GROUP_PC }}'){
                    $('#pic-area').show();
                    $('[name="content"]').attr('readonly','readpnly')
                }else{
                    $('#pic-area').hide();
                    $('[name="content"]').removeAttr('readonly');
                }
            }
        });

    </script>
@endsection
