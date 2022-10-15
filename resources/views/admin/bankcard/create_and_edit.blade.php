@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"银行卡修改":"银行卡新增"
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
                      action="{{ $isUpdated?route('admin.bankcards.update',['bankcard' => $model->id]):route('admin.bankcards.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">卡号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="card_no" placeholder="请输入卡号"
                                   value="{{ $isUpdated?$model->card_no:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">卡类型</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.card_type') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio"
                                                                                             value="{{ $k }}"
                                                                                             name="card_type"
                                                                                             @if($isUpdated && $model->card_type === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">银行类型</label>
                        <div class="col-sm-4">
                            <select name="bank_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.bank_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->bank_type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">办卡预留手机号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="phone" placeholder="请输入办卡预留手机号"
                                   value="{{ $isUpdated?$model->phone:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">持卡人姓名</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="owner_name" placeholder="请输入持卡人姓名"
                                   value="{{ $isUpdated?$model->owner_name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">开户行地址</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="bank_address" placeholder="请输入开户行地址"
                                   value="{{ $isUpdated?$model->bank_address:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">是否启用</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio"
                                                                                             value="{{ $k }}"
                                                                                             name="is_open"
                                                                                             @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
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
