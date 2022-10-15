@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
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
                      action="{{ $isUpdated?route('admin.activities.update',['activity' => $model->id]):route('admin.activities.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title"
                                   value="{{ $isUpdated?$model->title:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.subtitle')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="subtitle"
                                   value="{{ $isUpdated?$model->subtitle:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    {{--列表封面图 开始--}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.cover_image')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="cover_image"
                                   value="{{ $isUpdated?$model->cover_image:"" }}" @if(!$isUpdated) required @endif readonly>
                        </div>
                        <div class="col-sm-4">
                            <span class="help-block">Chỉ những sự kiện tải lên ảnh bìa danh sách mới xuất hiện trong danh sách sự kiện</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            {{-- data-operate="upload-image" --}}
                            <ul class="list-inline clearfix lyear-uploads-pic" id="upload-area"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'activity']) }}"
                                data-delete-url="{{ route('attachment.delete') }}" @if($isUpdated)
                                data-image-url="{{ $model->cover_image }}" @endif>
                            </ul>
                        </div>
                    </div>
                    {{--列表封面图 结束--}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.type')</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.activity_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.apply_type')</label>
                        <div class="col-sm-4">
                            {{--
                            @foreach(config('platform.activity_is_apply') as $k => $v)
                            <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                    name="is_apply" @if($isUpdated && $model->is_apply === $k) checked @endif >
                                <span>{{ $v }}</span></label>
                            @endforeach
                            --}}
                            <select name="apply_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.activity_apply_type') as $key => $value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->apply_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--如果申请类型是活动大厅申请，则需要填写 活动大厅申请信息 apply-field --}}
                    <div class="form-group" id="hall-field" @if($isUpdated && $model->apply_type == App\Models\Activity::APPLY_TYPE_HALL) style="display:block" @else style="display:none" @endif>
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.hall_field')</label>
                        <div class="col-sm-4">
                            {{--apply_field--}}
                            <select name="hall_field[]" class="form-control js_select2" multiple="multiple">
                                @foreach(trans('res.option.activity_apply_field') as $key =>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span class="help-block">默认会员名称是必须的</span>
                        </div>
                    </div>

                    {{--活动大厅封面图 开始--}}
                    <div class="form-group" id="hall-image">
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.hall_image')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="hall_image"
                                   value="{{ $isUpdated?$model->hall_image:"" }}" @if(!$isUpdated) required @endif readonly>
                        </div>
                    </div>

                    <div class="form-group" id="hall-image-upload">
                        <label class="col-sm-2 control-label required">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            {{-- data-operate="upload-image" --}}
                            <ul class="list-inline clearfix lyear-uploads-pic" id="upload-area2"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'activity']) }}"
                                data-delete-url="{{ route('attachment.delete') }}" @if($isUpdated)
                                data-image-url="{{ $model->hall_image }}" @endif>
                            </ul>
                        </div>
                    </div>
                    {{--活动大厅封面图 结束--}}

                    {{--如果申请类型是跳转查看详情，则需要填写 跳转地址--}}
                    <div class="form-group" id="apply-url">
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.apply_url')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="apply_url"
                                   value="{{ $isUpdated?$model->apply_url:"" }}" @if(!$isUpdated) required @endif>
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
                        <label class="col-sm-2 control-label">@lang('res.activity.field.apply_desc')</label>
                        <div class="col-sm-10">
                        <textarea class="tinymce-content" id="apply_desc">
                            @if($isUpdated) {!! $model->apply_desc !!} @endif
                        </textarea>
                        </div>
                    </div>



                    {{-- content --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.activity.field.content')</label>
                        <div class="col-sm-10">
                        <textarea class="tinymce-content" id="content">
                            @if($isUpdated) {!! $model->content !!} @endif
                        </textarea>
                        </div>
                    </div>

                    {{--
                    <div class="form-group">
                        <label class="col-sm-2 control-label">活动所需达到的金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money" placeholder="请输入活动所需达到的金额"
                                value="{{ $isUpdated?$model->money:"" }}" @if(!$isUpdated) required @endif>
                        </div>

                        <label class="col-sm-2 control-label">赠送比例</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="rate" placeholder="请输入赠送比例"
                                value="{{ $isUpdated?$model->rate:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    --}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.start_at')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="start_at" autocomplete="off"
                                   value="{{ $isUpdated?$model->start_at:"" }}" @if(!$isUpdated) required @endif>
                        </div>

                        <label class="col-sm-2 control-label">@lang('res.activity.field.end_at')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="end_at" autocomplete="off"
                                   value="{{ $isUpdated?$model->end_at:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.date_desc')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="date_desc"
                                   value="{{ $isUpdated?$model->date_desc:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    {{--
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题内容</label>
                        <div class="col-sm-10">
                            <textarea class="tinymce-content">
                                @if($isUpdated) {!! $model->title_content !!} @endif
                            </textarea>
                        </div>
                    </div>
                    --}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.rule_content')</label>
                        <div class="col-sm-10">
                        <textarea class="tinymce-content" id="rule_content">
                            @if($isUpdated) {!! $model->rule_content !!} @endif
                        </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.is_open')</label>
                        {{--
                        <div class="col-sm-4">
                            @foreach(\App\Models\Base::$isOpenMap as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                        --}}
                        <div class="col-sm-4 switch-col">
                            <label class="lyear-switch switch-solid switch-primary">
                                <input type="checkbox" name="is_open" value="{{ $model->is_open ?? ''}}" @if($isUpdated && $model->is_open == 1) checked @endif>
                                {{--
                                @if(!$model->is_open)
                                <input type="hidden" name="is_open" value="{{ $model->is_open ?? '' }}">
                                @endif
                                --}}
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.is_hot')</label>
                        {{--
                        <div class="col-sm-4">
                            @foreach(\App\Models\Base::$boolTypeMap as $k => $v)
                            <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                    name="is_hot" @if($isUpdated && $model->is_hot === $k) checked @endif >
                                <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                        --}}
                        <div class="col-sm-4 switch-col">
                            <label class="lyear-switch switch-solid switch-primary">
                                <input type="checkbox" name="is_hot" value="{{ $model->is_hot ?? '' }}" @if($isUpdated && $model->is_hot === 1) checked @endif>
                                {{--
                                @if(!$model->is_hot)
                                <input type="hidden" name="is_hot" value="{{ $model->is_hot ?? '' }}">
                                @endif
                                --}}
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.activity.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    @if(isApp())
                        <input type="hidden" name="is_app" value="{{ isApp() }}">
                    @endif

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button"
                                    data-tinymce="apply_desc,content,rule_content"
                                    {{--data-tinymce="content,title_content,rule_content"--}}
                            >@lang('res.btn.save')</button>
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
            $('#upload-area').imageUpload({
                $callback_input: $('.form-control[name="cover_image"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            $('#upload-area2').imageUpload({
                $callback_input: $('.form-control[name="hall_image"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            //日期时间范围

            laydate.render({
                elem: '[name="start_at"]',
                type: 'datetime',
                theme: "#33cabb",
                // range: "~"
            });

            laydate.render({
                elem: '[name="end_at"]',
                type: 'datetime',
                theme: "#33cabb",
                // range: "~"
            });


            // radio 选中事件
            /**
             $('[name=is_apply]').change(function(){
            console.log($(this).val())
            if($(this).val() == 1){
                $('#apply-field').show();
            }else{
                $('#apply-field').hide();
            }
        });

             if($("[name=id]")){
            $("#apply-field select").val({!! json_encode($model->apply_field_array ?? []) !!}).trigger('change');
        }
             **/

            if($("[name=id]")){
                $("#hall-field select").val({!! json_encode($model->hall_field_array ?? []) !!}).trigger('change');
            }

            initView();

            function initView(){
                $('#hall-image').hide().find('input[name]').attr("disabled", true);
                $('#hall-field').hide().find('select[name]').attr("disabled", true);
                $('#hall-image-upload').hide().find('input[name]').attr("disabled", true);

                $('#apply-url').hide().find('input[name]').attr("disabled", true);

                var applyTypeSelect = $("[name='apply_type']");
                var selectValue = applyTypeSelect.find("option:selected").attr("value");
                if(selectValue == {{ App\Models\Activity::APPLY_TYPE_HALL }}){
                    $('#hall-image').show().find('input[name]').attr("disabled", false);
                    $('#hall-field').show().find('select[name]').attr("disabled", false);
                    $('#hall-image-upload').show().find('input[name]').attr("disabled", false);
                }else if(selectValue == {{ App\Models\Activity::APPLY_TYPE_URL }}){
                    $('#apply-url').show().find('input[name]').attr("disabled", false);
                }
            }

            $('[name=apply_type]').change(function(){
                initView();
            });
        });

    </script>
@endsection
