@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"代理返点金额日志修改":"代理返点金额日志新增"
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
                      action="{{ $isUpdated?route('admin.agentfdmoneylogs.update',['agentfdmoneylog' => $model->id]):route('admin.agentfdmoneylogs.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">当前会员ID</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="member_id" placeholder="请输入当前会员ID" value="{{ $isUpdated?$model->member_id:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">返点比例(%)</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="member_rate" placeholder="请输入返点比例(%)" value="{{ $isUpdated?$model->member_rate:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">当前会员ID</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="agent_id" placeholder="请输入当前会员ID" value="{{ $isUpdated?$model->agent_id:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">返点比例(%)</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="agent_rate" placeholder="请输入返点比例(%)" value="{{ $isUpdated?$model->agent_rate:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">游戏类型</label>
                        <div class="col-sm-4">
                            <select name="game_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.game_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->game_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">下注金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="bet_amount" placeholder="请输入下注金额" value="{{ $isUpdated?$model->bet_amount:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">返点金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="fd_money" placeholder="请输入返点金额" value="{{ $isUpdated?$model->fd_money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">日志前余额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money_before" placeholder="请输入日志前余额" value="{{ $isUpdated?$model->money_before:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">日志后余额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money_after" placeholder="请输入日志后余额" value="{{ $isUpdated?$model->money_after:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">备注</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark" placeholder="请输入备注" value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button"  >保存内容</button>
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
