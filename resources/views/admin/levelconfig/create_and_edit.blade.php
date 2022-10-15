@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"晋升条件设置修改":"晋升条件设置新增"
@endphp

@section('title', $_title ?? '')

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
                      action="{{ $isUpdated?route('admin.levelconfigs.update',['levelconfig' => $model->id]):route('admin.levelconfigs.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.level')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="level"
                                   value="{{ $isUpdated?$model->level:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.level_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="level_name"
                                   value="{{ $isUpdated?$model->level_name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.deposit_money')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="deposit_money"
                                   value="{{ $isUpdated?$model->deposit_money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.bet_money')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="bet_money"
                                   value="{{ $isUpdated?$model->bet_money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.level_bonus')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="level_bonus"
                                   value="{{ $isUpdated?$model->level_bonus:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.day_bonus')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="day_bonus"
                                   value="{{ $isUpdated?$model->day_bonus:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.week_bonus')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="week_bonus"
                                   value="{{ $isUpdated?$model->week_bonus:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.month_bonus')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="month_bonus"
                                   value="{{ $isUpdated?$model->month_bonus:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.year_bonus')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="year_bonus"
                                   value="{{ $isUpdated?$model->year_bonus:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.credit_bonus')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="credit_bonus"
                                   value="{{ $isUpdated?$model->credit_bonus:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.levelup_type')</label>
                        <div class="col-sm-4">
                            <select name="levelup_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.levelup_types') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->levelup_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.level_config.field.lang')</label>
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


        });

    </script>
@endsection
