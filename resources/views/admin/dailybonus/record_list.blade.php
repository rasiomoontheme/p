@extends('layouts.baseframe')

@section('title', $_title)

@php
    $record_list = [
        'member_id' => ['name' => '会员id', 'type' => 'number', 'is_show' => true],
        'bonus_money' => ['name' => '签到奖励金额','type' => 'text','is_show' => true],
        'serial_days' => ['name' => '连续签到天数','type' => 'text','is_show' => true],
        'total_days' => ['name' => '累计签到天数','type' => 'text','is_show' => true],
        'type' => ['name' => '类型','type' => 'select' ,'is_show' => true,'data' => 'platform.daily_bonus_type'],
        'state' => ['name' => '状态','type' => 'select', 'is_show' => true,'data' => 'platform.daily_bonus_state'],
    ]
@endphp

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
                            'type' => ['name' => trans('res.daily_bonus.field.type'),'type' => 'select', 'data' => trans('res.option.daily_bonus_set')],
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime']
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
                    {{-- <a class="btn btn-primary m-r-5" href="{{ route("admin.dailybonuses.create") }}"><i
                            class="mdi mdi-plus"></i>
                        新增</a> --}}
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a> --}}
                    {{-- <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/dailybonuses/ids">
                        <i class="mdi mdi-window-close"></i> 删除
                    </a> --}}
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
                            @include('layouts._table_header',['data' => $record_list,'model' => 'daily_bonus'])
                            <th width=100>@lang('res.common.updated_at')</th>
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
                                @include('layouts._table_body',['data' => $record_list,'item' => $item])
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>

                                    @if($item->state == App\Models\Dailybonus::STATE_NOT_DEAL && $item->bonus_money > 0)
                                        <a class="btn btn-xs btn-round btn-success" href="javascript:;"
                                           data-operate="alert-deal" data-method="post"
                                           data-message="@lang('res.daily_bonus.record.notice_confirm')"
                                           data-url="{{ route('admin.dailybonuses.modify_state',['dailybonus' => $item->id,'state' => App\Models\Dailybonus::STATE_ENSURE]) }}"
                                           data-toggle="tooltip" data-original-title="@lang('res.daily_bonus.record.btn_confirm')" data-title="@lang('res.daily_bonus.record.btn_confirm')">
                                            <i class="mdi mdi-check"></i>
                                        </a>

                                        <a class="btn btn-xs btn-round btn-danger" href="javascript:;"
                                           data-operate="alert-deal" data-method="post"
                                           data-message="@lang('res.daily_bonus.record.notice_reject')"
                                           data-url="{{ route('admin.dailybonuses.modify_state',['dailybonus' => $item->id,'state' => App\Models\Dailybonus::STATE_REJECT]) }}"
                                           data-toggle="tooltip" data-original-title="@lang('res.daily_bonus.record.btn_reject')" data-title="@lang('res.daily_bonus.record.btn_reject')">
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-xs btn-round btn-warning" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.dailybonuses.show', ['dailybonus' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>
                                    @endif
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