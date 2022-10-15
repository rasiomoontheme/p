@extends('layouts.baseframe')
@section('content')

    <style>
        td {
            word-break: break-all;
        }
    </style>
    <div class="row m-15">

        <table class="table table-striped">
            <thead>
            <tr>
                <th width="20%">@lang('res.btn.title')</th>
                <th>@lang('res.btn.content')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>@lang('res.recharge.field.payment_type')</td>
                <td>{{ $model->payment_type_text }}</td>
            </tr>
            <tr>
                <td>@lang('res.recharge.field.account')</td>
                <td>{{ $model->payment_detail['payment_account'] ?? ''}}</td>
            </tr>
            <tr>
                <td>@lang('res.recharge.field.payment_name')</td>
                <td>{{ $model->payment_detail['payment_name'] ?? '' }}</td>
            </tr>

            @if(isset_and_not_empty($model->payment_detail,'payment_bank_type'))
                <tr>
                    <td>@lang('res.recharge.field.bank_type')</td>
                    <td>{{ \Illuminate\Support\Arr::get(\App\Models\Bank::getAllBankArray(),$model->payment_detail['payment_bank_type'],$model->payment_detail['payment_bank_type']) }}</td>
                </tr>
            @endif

            @if($model->payment_pic)
                <tr>
                    <td>@lang('res.recharge.field.payment_pic')</td>
                    <td>
                        <a href="{{ $model->payment_pic }}" target="_blank">@lang('res.system_config.config_groups.btn_preview')</a>
                    </td>
                </tr>
            @endif

            @if(isset_and_not_empty($model->payment_detail,'usdt_rate'))
                <tr>
                    <td>@lang('res.payment.field.usdt_rate')</td>
                    <td>{{ isset_and_not_empty($model->payment_detail,'usdt_rate') }}</td>
                </tr>
            @endif

            @if(isset_and_not_empty($model->payment_detail,'usdt_type'))
                <tr>
                    <td>@lang('res.payment.field.usdt_type')</td>
                    <td>{{ $model->usdt_type_text }}</td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>

@endsection