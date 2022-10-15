@extends('layouts.baseframe')

@section('title', '下线会员列表')

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('res.agent_page.title.offline_list')</h4>
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
                                'name' => ['name' => trans('res.common.member_name'),'type' => 'text'],
                                'status' => ['name' => trans('res.member.field.status'),'type' => 'select','data' => trans('res.option.member_status')],
                                'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime']
                            ]
                        ])

                        @if(!app(\App\Services\AgentService::class)->isTraditionalMode())
                            @include('layouts._search_field',
                        [
                        'list' => [
                                'agent_id' => ['name' => trans('res.agent_page.field.is_agent'),'type' => 'select','data' => trans('res.option.boolean')],
                            ]
                        ])
                        @endif

                        <div class="col-lg-6 col-sm-6">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-magnify"></i>
                                    @lang('res.btn.search')
                                </button>&nbsp;
                                <button type="reset" class="btn btn-warning" onclick="document.searchForm.reset()">
                                    <i class="mdi mdi-loop"></i>
                                    @lang('res.btn.reset')
                                </button>&nbsp;

                                @if(!app(\App\Services\AgentService::class)->isTraditionalMode())
                                    <a href="javascript:;" class="btn btn-success" data-operate="iframe-page"
                                       data-title="@lang('res.agent_page.btn.set_offline_default')" data-url="{{ route('agent.memberoffline.fd') }}">
                                        <i class="mdi mdi-checkbox-marked-outline"></i> @lang('res.agent_page.btn.set_offline_default')
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <div class="card">
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
                            <th>@lang('res.member.field.name')</th>
                            <th style="width: 12%">@lang('res.member.field.money')/@lang('res.member.field.fs_money')</th>
                            <th style="width: 10%">@lang('res.member.field.realname')</th>
                            <th style="width: 10%">@lang('res.member.money_report.is_agent_and_top_agent')</th>
                            <th style="width: 10%">@lang('res.member.field.phone')/@lang('res.member.field.email')</th>
                            <th style="width: 15%">@lang('res.agent_page.field.register_at')</th>
                            <th style="width: 10%">@lang('res.member.field.status')</th>
                            <th style="width: 10%">@lang('res.common.operate')</th>
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
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->money }} / {{ $item->fs_money }}
                                </td>
                                <td>
                                    {{ $item->realname }}
                                </td>
                                <td>
                                    @if ($item->agent_id > 0)
                                        <span style="color: red">{{ trans('res.option.boolean')[1] }}</span>
                                    @else
                                        <span style="color: green">{{ trans('res.option.boolean')[0] }}</span>
                                    @endif
                                    /{{ $item->top->member->name ?? '' }}
                                </td>
                                <td>
                                    {{ $item->phone }}/{{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    @include('layouts._table_label',[
                                        'list' => App\Models\Member::$list_field,
                                        'key' => $item->status,
                                        'field' => 'status'
                                    ])
                                </td>
                                <td>
                                    {{--&& app(\App\Services\AgentService::class)->isDirectChild(auth()->user(),$item->id)--}}
                                    @if($item->agent_id && !app(\App\Services\AgentService::class)->isTraditionalMode() )
                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="iframe-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.agent.index.btn_fd_rate')"
                                           data-title="{{ trans('res.agent.index.title_fd_rate',['name' => $item->name]) }}"
                                           data-url="{{ route('agent.memberoffline.agent_fd_rate', ['agent' => $item->agent_id]) }}">
                                            <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
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
