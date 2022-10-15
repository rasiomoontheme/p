@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"银行卡修改":"银行卡新增"
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
                      action="{{ $isUpdated?route('admin.banks.update',['bank' => $model->id]):route('admin.banks.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.bank.field.key')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="key"
                                   value="{{ $isUpdated?$model->key:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                Nếu là ví USDT, bốn ký tự đầu tiên phải được viết hoa "USDT"
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.bank.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $isUpdated?$model->name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.bank.field.url')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="url"
                                   value="{{ $isUpdated?$model->url:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.bank.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="is_open"
                                           @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.bank.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.bank.field.lang')</label>
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
                            <button class="btn btn-primary" data-operate="ajax-submit"  type="button">@lang('res.btn.save')</button>
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
