@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"签到修改":"签到新增"
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
                      action="{{ $isUpdated?route('admin.dailybonuses.update',['dailybonus' => $model->id]):route('admin.dailybonuses.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.daily_bonus.field.bonus_money')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="bonus_money"
                                   value="{{ $isUpdated?$model->bonus_money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.daily_bonus.field.days')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="days" value="{{ $isUpdated?$model->days:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.daily_bonus.field.type')</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.daily_bonus_type') as $key =>$value)
                                    @if($key < 0)
                                        <option value="{{ $key }}"
                                                @if($isUpdated && $model->type == $key) selected
                                                @endif>{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.daily_bonus.field.lang')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.lang_select') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->lang == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--
                    <div class="form-group" id="serial"
                        @if($isUpdated && $model->serial_days > 0) style="display:block;"
                        @else style="display:none" @endif
                        >
                        <label class="col-sm-2 control-label required">连续签到天数</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="serial_days" placeholder="请输入连续签到天数"
                                value="{{ $isUpdated?$model->serial_days:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group" id="total"
                        @if($isUpdated && $model->total_days > 0) style="display:block;"
                        @else style="display:none" @endif>
                        <label class="col-sm-2 control-label required">累计签到天数</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="total_days" placeholder="请输入累计签到天数"
                                value="{{ $isUpdated?$model->total_days:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-4">
                            <select name="state" class="form-control js_select2">
                                <option value="">--请选择--</option>
                                @foreach(config('platform.daily_bonus_state') as $key =>$value)
                                <option value="{{ $key }}" @if($isUpdated && $model->state == $key) selected
                                    @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.daily_bonus.field.remark')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark"
                                   value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
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
    {{-- <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script> --}}
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {

            // $("[name='type']").change(function(){
            //     var statusSelect = $(this);
            //     if(statusSelect.find("option:selected").attr("value") == {{ App\Models\DailyBonus::TYPE_TOTAL_SETTING }}){
            //         $('#total').show();
            //         $('#serial').hide();
            //     }else if(statusSelect.find("option:selected").attr("value") == {{ App\Models\DailyBonus::TYPE_SERIAL_SETTING }}){
            //         $('#total').hide();
            //         $('#serial').show();
            //     }else{
            //         $('#total').hide();
            //         $('#serial').hide();
            //     }
            // });

        });

    </script>
@endsection
