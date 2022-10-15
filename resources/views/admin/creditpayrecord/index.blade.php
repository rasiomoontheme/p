@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">
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
                                'member_name' => ['name' => trans('res.common.member_name'),'type' => 'text'],
                                'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime'],
                                ]
                        ])

                        @if(\Arr::get($params,'type',\App\Models\CreditPayRecord::TYPE_BORROW) == \App\Models\CreditPayRecord::TYPE_BORROW)
                            @include('layouts._search_field',
                            [
                                'list' => [
                                    'status' => ['name' => trans('res.credit_pay_record.field.status'),'type' => 'select', 'data' => trans('res.option.credit_status')],
                                ]
                            ])
                        @endif

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
                    {{--
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.creditpayrecords.create") }}"><i
                            class="mdi mdi-plus"></i>
                        新增</a>
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/creditpayrecords/ids">
                        <i class="mdi mdi-window-close"></i> 删除
                    </a>
                    --}}
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
                            @include('layouts._table_header',['data' => \App\Models\CreditPayRecord::$list_field,'model' => 'credit_pay_record'])
                            @if(\Arr::get($params,'type',\App\Models\CreditPayRecord::TYPE_BORROW) == \App\Models\CreditPayRecord::TYPE_BORROW)
                                <th style="width: 120px;min-width: 120px;">@lang('res.credit_pay_record.field.dead_at')</th>
                                <th style="min-width: 70px;">@lang('res.credit_pay_record.field.is_overdue')</th>
                            @endif
                            {{--<th width=100>修改时间</th>--}}
                            <th width=100>@lang('res.common.created_at')</th>
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
                                @include('layouts._table_body',['data' => \App\Models\CreditPayRecord::$list_field,'item' => $item])
                                @if(\Arr::get($params,'type',\App\Models\CreditPayRecord::TYPE_BORROW) == \App\Models\CreditPayRecord::TYPE_BORROW)
                                    <td>{{ $item->dead_at }}</td>
                                    <td>
                                        @if($item->is_overdue)
                                            <span style="color: red">{{ \Illuminate\Support\Arr::get(trans('res.option.boolean'),$item->is_overdue) }}</span>
                                        @else
                                            <span style="color: green">\Illuminate\Support\Arr::get(trans('res.option.boolean'),$item->is_overdue)</span>
                                        @endif
                                    </td>
                                @endif
                                {{--                            <td>{{ $item->updated_at }}</td>--}}
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">

                                        @if($item->type == \App\Models\CreditPayRecord::TYPE_BORROW)
                                            @if($item->status == \App\Models\CreditPayRecord::STATUS_UNDEAL)
                                                <a class="btn btn-xs btn-round btn-success" href="javascript:;"
                                                   data-operate="alert-deal" data-message="@lang('res.credit_pay_record.index.notice_confirm')" data-method="post"
                                                   data-url="{{ route('admin.creditpayrecord.confirm',['record' => $item->id]) }}"
                                                   data-toggle="tooltip" data-original-title="@lang('res.credit_pay_record.index.btn_confirm')" data-title="@lang('res.credit_pay_record.index.btn_confirm')">
                                                    <i class="mdi mdi-check"></i>
                                                </a>

                                                <a class="btn btn-xs btn-round btn-danger" href="javascript:;"
                                                   data-operate="alert-deal" data-message="@lang('res.credit_pay_record.index.notice_reject')" data-method="post"
                                                   data-url="{{ route('admin.creditpayrecord.reject',['record' => $item->id]) }}"
                                                   data-toggle="tooltip" data-original-title="@lang('res.credit_pay_record.index.btn_reject')" data-title="@lang('res.credit_pay_record.index.btn_reject')">
                                                    <i class="mdi mdi-close"></i>
                                                </a>
                                            @else

                                            @endif
                                        @endif
                                        {{--
                                        <a class="btn btn-xs btn-default"
                                            href="{{ route('admin.creditpayrecords.edit',['creditpayrecord' => $item->id]) }}" title=""
                                            data-toggle="tooltip" data-original-title="编辑"><i
                                                class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                            data-toggle="tooltip" data-original-title="详情"
                                            data-url="{{ route('admin.creditpayrecords.show', ['creditpayrecord' => $item->id]) }}">
                                        <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                            data-toggle="tooltip" data-original-title="删除"
                                            data-url="{{ route('admin.creditpayrecords.destroy', ['creditpayrecord' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a>
                                        --}}
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
