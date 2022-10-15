@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        {{--
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            @lang('res.payment.index.top_notice')
        </div>
        --}}

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#searchContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> @lang('res.btn.collapse')
                        </button>
                    </li>
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body collapse in" id="searchContent" aria-expanded="true">
                <form action="" method="get" id="searchForm" name="searchForm">
                    <div class="row">
                        @include('layouts._search_field',
                        [
                        'list' => [
                            'lang' => ['name' => trans('res.member.field.lang'),'type' => 'select','data' => config('platform.lang_select')],
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime'],
                            'desc'=> ['name' => trans('res.payment.field.desc'),'type' => 'text'],
                            'type' => ['name' => trans('res.payment.field.type'),'type' => 'select','data' => trans('res.option.payment_type')]
                            ]
                        ])

                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">@lang('res.btn.search')</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">@lang('res.btn.reset')</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-toolbar clearfix">
                <div class="toolbar-btn-action">
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.payments.create") }}"><i
                                class="mdi mdi-plus"></i>
                        @lang('res.btn.add')</a>

                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/payments/ids">
                        <i class="mdi mdi-window-close"></i> @lang('res.btn.delete')
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <label class="lyear-checkbox checkbox-primary">
                                    <input type="checkbox" id="check-all"><span></span>
                                </label>
                            </th>
                            @include('layouts._table_header',['data' => \App\Models\Payment::$list_field,'model' => 'payment'])
                            <th>@lang('res.payment.field.detail')</th>
                            <th style="min-width: 80px;">@lang('res.payment.field.range')</th>
                            <th width=100>@lang('res.common.updated_at')</th>
                            <th>@lang('res.common.operate')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    <label class="lyear-checkbox checkbox-primary">
                                        <input type="checkbox" name="ids[]" value="{{ $item->id }}"><span></span>
                                    </label>
                                </td>
                                @include('layouts._table_body',['data' => \App\Models\Payment::$list_field,'item' => $item])
                                <td>
                                    {{--
                                    @if($item->type == \App\Models\Payment::TYPE_BANKPAY)
                                        银行：【{{ config('platform.bank_type')[$item['params']['bank_type']] ?? '' }}】
                                    @elseif($item->type == \App\Models\Payment::TYPE_THIRDPAY)

                                    @else
                                        收款账号：【{{ $item->account }}】
                                    @endif
                                    --}}

                                    @if($item->isThirdPay())

                                    @elseif($item->type == \App\Models\Payment::TYPE_BANKPAY)
                                        @lang('res.payment.field.bank_type')：【{{ \Illuminate\Support\Arr::get(\App\Models\Bank::getAllBankArray(),$item['params']['bank_type'],'') }}】
                                    @else
                                        @lang('res.payment.field.account')：【{{ $item->account }}】
                                    @endif

                                    @if($item->type == \App\Models\Payment::TYPE_USDT)
                                        <br>@lang('res.payment.field.usdt_rate')：{{ $item->params['usdt_rate'] }}
                                        @if($item->usdt_type_text)
                                            <br>@lang('res.payment.field.usdt_type')：{{ $item->usdt_type_text }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($item->isMoneyNoLimited())
                                        @lang('res.common.no_limit')
                                    @else
                                        {{ $item->min }} ~ {{ $item->max }}
                                    @endif
                                </td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.payments.edit',['payment' => $item->id]) }}" title=""
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.payments.destroy', ['payment' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="clearfix">
                    <div class="pull-left">
                        <p>@lang('res.common.total') <strong style="color: red">{{ $data->total() }}</strong> @lang('res.common.count')</p>
                    </div>
                    <div class="pull-right">
                        {!! $data->appends($params)->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection