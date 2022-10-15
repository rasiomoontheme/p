@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"余额宝方案修改":"余额宝方案新增"
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
                      action="{{ $isUpdated?route('admin.yuebaoplans.update',['yuebaoplan' => $model->id]):route('admin.yuebaoplans.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.SettingName')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="SettingName"
                                   value="{{ $isUpdated?$model->SettingName:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.MinAmount')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="MinAmount"
                                   value="{{ $isUpdated?$model->MinAmount:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.MaxAmount')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="MaxAmount"
                                   value="{{ $isUpdated?$model->MaxAmount:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.SettleTime')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="SettleTime"
                                   value="{{ $isUpdated?$model->SettleTime:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.IsCycleSettle')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.yuebao_settle_type') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="IsCycleSettle" @if($isUpdated && $model->IsCycleSettle === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.Rate')</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="Rate"
                                       value="{{ $isUpdated?$model->Rate:"" }}" @if(!$isUpdated) required @endif>
                                <span class="input-group-addon">%</span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.TotalCount')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="TotalCount"
                                   value="{{ $isUpdated?$model->TotalCount:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.yuebao_plan.field.LimitInterest')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="LimitInterest"
                                   value="{{ $isUpdated?$model->LimitInterest:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.yuebao_plan.field.LimitUserOrderCount')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="LimitUserOrderCount"
                                   value="{{ $isUpdated?$model->LimitUserOrderCount:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                @lang('res.yuebao_plan.edit.notice_no_limit')
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.yuebao_plan.field.LimitOrderIntervalTime')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="LimitOrderIntervalTime"
                                   value="{{ $isUpdated?$model->LimitOrderIntervalTime:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                @lang('res.yuebao_plan.edit.notice_no_limit')
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.yuebao_plan.field.InterestAuditMultiple')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="InterestAuditMultiple"
                                   value="{{ $isUpdated?$model->InterestAuditMultiple:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                @lang('res.yuebao_plan.edit.notice_default_ml')
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.yuebao_plan.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio"  value="{{ $k }}" name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.common.lang')</label>
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
                        <label class="col-sm-2 control-label ">@lang('res.yuebao_plan.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                @lang('res.yuebao_plan.edit.notice_weight')
                            </div>
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
