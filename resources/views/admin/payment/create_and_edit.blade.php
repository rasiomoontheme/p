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
                      action="{{ $isUpdated?route('admin.payments.update',['payment' => $model->id]):route('admin.payments.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.payment.field.type')</label>
                        <div class="col-sm-4">
                            <select name="type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.payment_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->type == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.payment.field.desc')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="desc"
                                   value="{{ $isUpdated?$model->desc:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    {{--@php dd($model->params); @endphp--}}
                    <div id="thirdpay">
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.account_id')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[account_id]"
                                       value="{{ $isUpdated && is_array($model->params) && array_key_exists('account_id',$model->params) ? $model->params['account_id'] : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.key')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[key]"
                                       value="{{ $isUpdated && is_array($model->params)  && array_key_exists('key',$model->params) ? $model->params['key'] : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.url')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[url]"
                                       value="{{ $isUpdated && is_array($model->params)  && array_key_exists('url',$model->params) ? $model->params['url'] : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.api')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[api]"
                                       value="{{ $isUpdated && is_array($model->params)  && array_key_exists('api',$model->params) ? $model->params['api'] : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.paytype')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[paytype]"
                                       value="{{ $isUpdated && is_array($model->params)  && array_key_exists('paytype',$model->params) ? $model->params['paytype'] : '' }}">
                            </div>
                        </div>
                    </div>



                    <div class="form-group" id="account">
                        <label class="col-sm-2 control-label required">@lang('res.payment.field.account')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="account"
                                   value="{{ $isUpdated?$model->account:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group" id="name">
                        <label class="col-sm-2 control-label required">@lang('res.payment.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $isUpdated?$model->name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div id="usdtpay">
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.usdt_type')</label>
                            <div class="col-sm-4">
                                <select name="params[usdt_type]" class="form-control js_select2">
                                    <option value="">@lang('res.common.select_default')</option>
                                    @foreach(config('platform.usdt_type') as $key =>$value)
                                        <option value="{{ $key }}" @if($isUpdated && is_array($model->params)  && array_key_exists('usdt_type',$model->params) && $model->params['usdt_type'] == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.usdt_rate')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="params[usdt_rate]"
                                       value="{{ $isUpdated && is_array($model->params) && array_key_exists('usdt_rate',$model->params) ? $model->params['usdt_rate'] : '' }}">
                            </div>
                        </div>
                    </div>

                    <div id="bankpay">

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.bank_type')</label>
                            <div class="col-sm-4">
                                <select name="params[bank_type]" class="form-control js_select2">
                                    <option value="">@lang('res.common.select_default')</option>
                                    @foreach(\App\Models\Bank::getAllBankArray() as $key =>$value)
                                        <option value="{{ $key }}" @if($isUpdated && is_array($model->params)  && array_key_exists('bank_type',$model->params) && $model->params['bank_type'] == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.payment.field.bank_type')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[bank_type]"
                                       value="{{ $isUpdated && is_array($model->params)  && array_key_exists('bank_type',$model->params) ? $model->params['bank_type'] : '' }}">
                            </div>
                        </div>
                        --}}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.payment.field.bank_address')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="params[bank_address]"
                                       value="{{ $isUpdated && is_array($model->params)  && array_key_exists('bank_address',$model->params) ? $model->params['bank_address'] : '' }}">
                            </div>
                        </div>
                    </div>

                    {{--不是第三方支付和银行卡转账--}}
                    <div class="form-group" id="qrcode">
                        <label class="col-sm-2 control-label ">@lang('res.payment.field.qrcode')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="qrcode"
                                   value="{{ $isUpdated?$model->qrcode:"" }}" @if(!$isUpdated) required @endif readonly>
                        </div>
                    </div>

                    <div class="form-group" id="upload-area">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'payment']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                @if($isUpdated) data-image-url="{{ $model->qrcode }}" @endif>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.payment.field.memo')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="memo"
                                   value="{{ $isUpdated?$model->memo:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                        <div class="col-sm-4 help-block">
                            @lang('res.payment.edit.notice_memo')
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.payment.field.rate')</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="rate"
                                       value="{{ $isUpdated?$model->rate:"" }}" @if(!$isUpdated) required @endif>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.payment.field.min')</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="min" value="{{ $isUpdated?$model->min:"" }}" @if(!$isUpdated) required @endif>
                            </div>
                        </div>
                        <div class="col-sm-4 help-block">
                            @lang('res.payment.edit.notice_min_max')
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.payment.field.max')</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="max" value="{{ $isUpdated?$model->max:"" }}" @if(!$isUpdated) required @endif>
                            </div>
                        </div>
                        <div class="col-sm-4 help-block">
                            @lang('res.payment.edit.notice_range')
                        </div>
                    </div>

                    {{--交易比例
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.payment.field.forex')</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="forex"
                                       value="{{ $isUpdated?$model->forex:"" }}" @if(!$isUpdated) required @endif>
                            </div>
                        </div>
                        <div class="col-sm-4 help-block">
                            @lang('res.payment.edit.notice_forex')
                        </div>
                    </div>
                    --}}
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
                        <label class="col-sm-2 control-label ">@lang('res.payment.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
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

            initView();

            // 单图上传
            $('.lyear-uploads-pic').imageUpload({
                $callback_input: $('.form-control[name="qrcode"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            function initView(){
                var typeSelect = $('[name=type]');
                var typeSelectValue = typeSelect.find("option:selected").attr("value");

                // 隐藏
                $('#account').hide().find('input[name]').attr("disabled", true);
                $('#name').hide().find('input[name]').attr("disabled", true);
                $('#qrcode').hide().find('input[name]').attr("disabled", true);
                $('#upload-area').hide().find('input[name]').attr("disabled", true);
                $('#thirdpay').hide().find('input[name]').attr("disabled", true);
                $('#bankpay').hide().find('input[name],select[name]').attr("disabled", true);
                $('#usdtpay').hide().find('input[name],select[name]').attr("disabled", true);

                // 第三方支付
                //if(typeSelectValue == '{{-- \App\Models\Payment::TYPE_THIRDPAY --}}'){
                if(typeSelectValue.indexOf('{{ \App\Models\Payment::PREFIX_THIRDPAY }}') == 0){
                    $('#thirdpay').show().find('input[name]').attr("disabled", false);
                }else if(typeSelectValue == '{{ \App\Models\Payment::TYPE_BANKPAY }}'){
                    $('#bankpay').show().find('input[name],select[name]').attr("disabled", false);
                    $('#account').show().find('input[name]').attr("disabled", false);
                    $('#name').show().find('input[name]').attr("disabled", false);
                    // }else if(typeSelectValue){
                }else if(typeSelectValue == '{{ \App\Models\Payment::TYPE_USDT }}'){
                    $('#account').show().find('input[name]').attr("disabled", false);
                    $('#name').hide().find('input[name]').attr("disabled", true);
                    $('#usdtpay').show().find('input[name]').attr("disabled", false);
                    $('#qrcode').show().find('input[name]').attr("disabled", false);
                    $('#upload-area').show().find('input[name]').attr("disabled", false);
                    $('#usdtpay').show().find('input[name],select[name]').attr("disabled", false);
                }else if(typeSelectValue.indexOf('{{ \App\Models\Payment::PREFIX_COMPANY }}') == 0){
                    $('#account').show().find('input[name]').attr("disabled", false);
                    $('#name').show().find('input[name]').attr("disabled", false);
                    $('#qrcode').show().find('input[name]').attr("disabled", false);
                    $('#upload-area').show().find('input[name]').attr("disabled", false);
                }
            }

            $('[name=type]').change(function(){
                initView();
            });

        });

    </script>
@endsection
