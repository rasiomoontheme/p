@extends('layouts.baseframe')
@php
    $isSuccess = $status == App\Models\Recharge::STATUS_SUCCESS;
    // $title = $isSuccess ? "审核通过":"审核不通过";
@endphp

@section('title', $_title)

@section('content')
    <div class="col-sm-12 p-t-15">

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>
            <div class="card-body text-center">
                <input type="hidden" id="iframe_id" value="">
                <form method="post" class="form-horizontal"
                      action="{{ $isSuccess ? route('admin.recharges.post_confirm',['recharge' => $model->id])
                    : route('admin.recharges.post_reject',['recharge' => $model->id]) }}" id="form">

                    @csrf
                    <input type="hidden" name="id" value="{{ $model->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.member_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $model->member->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.recharge.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $model->name }}" readonly>
                        </div>
                    </div>

                    {{--
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.recharge.field.origin_money')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" value="{{ $model->origin_money }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.recharge.field.forex')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" value="{{ $model->forex }}"
                                   readonly>
                        </div>
                    </div>
                    --}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.recharge.field.lang')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2" disabled>
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.lang_fields') as $k => $v)
                                    <option value="{{ $k }}" @if($model->member->lang == $k) selected
                                            @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.recharge.field.money')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" value="{{ $model->money }}"
                                   readonly>
                        </div>
                    </div>

                    @if($model->payment_type == \App\Models\Payment::TYPE_USDT)
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.payment.field.usdt_rate')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" value="{{ isset_and_not_empty($model->payment_detail,'usdt_rate') }}"
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.payment.field.usdt_num')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" value="{{ sprintf("%.4f", $model->money / $model->payment_detail['usdt_rate']) }}"
                                       readonly>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.recharge.field.hk_at')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="hk_at"
                                   value="{{ $model->hk_at }}" readonly>
                        </div>
                    </div>

                    @if($isSuccess)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.recharge.field.diff_money')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="diff_money" value="{{ $model->getPaymentRate() ? sprintf("%.2f",$model->getPaymentRate() * $model->money / 100) : '' }}"
                                       required>
                            </div>
                            @if($model->getPaymentRate())
                                <div class="col-sm-6 help-block">
                                    {{--支付通道【{{ $model->payment_type_text }}】的赠送比例是{{ $model->getPaymentRate() }}--}}
                                    {{ trans('res.recharge.edit.notice_diff',['text' => $model->payment_type_text,'rate' => $model->getPaymentRate()]) }}
                                </div>
                            @endif
                        </div>
                    @else

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.recharge.field.fail_reason')</label>
                            <div class="col-sm-8">
                                <textarea name="fail_reason" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                    @endif

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
