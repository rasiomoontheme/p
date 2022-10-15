@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"会员金额日志修改":"会员金额日志新增"
@endphp

@section('title', $title ?? '')

@section('content')
    <div class="col-sm-12">

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
                      action="{{ $isUpdated?route('admin.membermoneylogs.update',['memberMoneyLog' => $model->id]):route('admin.membermoneylogs.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">会员id</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="member_id" placeholder="请输入会员id"
                                   value="{{ $isUpdated?$model->member_id:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">管理员ID</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="user_id" placeholder="请输入管理员ID"
                                   value="{{ $isUpdated?$model->user_id:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">操作金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money" placeholder="请输入操作金额"
                                   value="{{ $isUpdated?$model->money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">操作前金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money_before" placeholder="请输入操作前金额"
                                   value="{{ $isUpdated?$model->money_before:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">操作后金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money_after" placeholder="请输入操作后金额"
                                   value="{{ $isUpdated?$model->money_after:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">金额字段类型</label>
                        <div class="col-sm-4">
                            <select name="money_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.member_money_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->money_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">数量类型</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.money_number_type') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="number_type" @if($isUpdated && $model->number_type === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">金额变动类型</label>
                        <div class="col-sm-4">
                            <select name="operate_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.member_money_operate_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->operate_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">操作描述</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="description" placeholder="请输入操作描述"
                                   value="{{ $isUpdated?$model->description:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">操作备注</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark" placeholder="请输入操作备注"
                                   value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
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
    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {



        });

    </script>
@endsection
