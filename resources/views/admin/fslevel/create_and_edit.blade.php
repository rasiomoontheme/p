@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"反水等级修改":"反水等级新增"
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
                      action="{{ $isUpdated?route('admin.fslevels.update',['fslevel' => $model->id]):route('admin.fslevels.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.common.game_type')</label>
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
                        <label class="col-sm-2 control-label required">@lang('res.fs_level.field.level')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="level"
                                   value="{{ $isUpdated?$model->level:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.fs_level.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $isUpdated?$model->name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.fs_level.field.type')</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.fs_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="member-id" style="display: none;">
                        <label class="col-sm-2 control-label">@lang('res.fs_level.field.member_id')</label>
                        <div class="col-sm-4">
                            <select name="member_id" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(\App\Models\Member::getMemberArray() as $key => $value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->member_id == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.fs_level.field.quota')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="quota"
                                   value="{{ $isUpdated?$model->quota:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.fs_level.field.rate')</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="number" class="form-control" name="rate"
                                       value="{{ $isUpdated?$model->rate:"" }}" @if(!$isUpdated) required @endif>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.fs_level.field.lang')</label>
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
        $(function(){
            initView();

            function initView(){
                var fsTypeSelect = $("[name=type]");
                var selectValue = fsTypeSelect.find("option:selected").attr("value");

                if(selectValue == {{ \App\Models\FsLevel::TYPE_SYSTEM }}){
                    $('#member-id').hide().find('select[name]').attr("disabled", true);
                }else if(selectValue == {{ \App\Models\FsLevel::TYPE_MEMBER }}){
                    $('#member-id').show().find('select[name]').attr("disabled", false);
                }
            }

            $('[name=type]').change(function(){
                initView();
            });
        })
    </script>
@endsection

