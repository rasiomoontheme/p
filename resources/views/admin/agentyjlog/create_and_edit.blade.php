@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"代理佣金记录修改":"代理佣金记录新增"
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
                      action="{{ $isUpdated?route('admin.agentyjlogs.update',['agentyjlog' => $model->id]):route('admin.agentyjlogs.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">代理id</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="agent_id" placeholder="请输入代理id" value="{{ $isUpdated?$model->agent_id:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">盈利金额</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="yl_money" placeholder="请输入盈利金额" value="{{ $isUpdated?$model->yl_money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">佣金</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money" placeholder="请输入佣金" value="{{ $isUpdated?$model->money:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">最后发放佣金月份</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="last_month" placeholder="请输入最后发放佣金月份" value="{{ $isUpdated?$model->last_month:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">操作备注</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark" placeholder="请输入操作备注" value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
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
