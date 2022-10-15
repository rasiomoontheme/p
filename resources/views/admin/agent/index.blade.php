@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            @lang('res.agent.index.top_notice')
        </div>

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
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime'],
                            'agent_id' => ['name' => trans('res.common.agent_id'),'type' => 'select','data' => \App\Models\Member::getAgentArray()]
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
                {{-- <div class="toolbar-btn-action">
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.agents.create") }}"><i class="mdi mdi-plus"></i>
                        新增</a>
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/agents/ids">
                        <i class="mdi mdi-window-close"></i> 删除
                    </a>
                </div> --}}
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
                            @include('layouts._table_header',['data' => \App\Models\Agent::$list_field,'model' => 'agent'])
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
                                @include('layouts._table_body',['data' => \App\Models\Agent::$list_field,'item' => $item])
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.agents.edit',['agent' => $item->id]) }}" title=""
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.agents.show', ['agent' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        @if(!app(\App\Services\AgentService::class)->isTraditionalMode() && $item->member)
                                            <a class="btn btn-xs btn-default" href="javascript:;" data-operate="iframe-page"
                                               data-toggle="tooltip" data-original-title="@lang('res.agent.index.btn_fd_rate')"
                                               data-title="@lang('res.agent.index.title_fd_rate',['name' => $item->member->name])"
                                               data-url="{{ route('admin.agentfdrate.agent', ['agent' => $item->id]) }}">
                                                <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                                            </a>
                                        @endif

                                        @if(!app(\App\Services\AgentService::class)->isTraditionalMode() && $item->member)
                                            <a class="btn btn-xs btn-default" href="javascript:;" data-operate="iframe-page"
                                               data-toggle="tooltip" data-original-title="反点记录"
                                               data-title="@lang('res.agent.index.title_fd_record',['name' => $item->member->name])"
                                               data-url="{{ route('admin.agentfdmoneylogs.index', ['agent_member_id' => $item->member_id]) }}">
                                                <i class="mdi mdi-file-document"></i>
                                            </a>
                                        @endif

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.agents.destroy', ['agent' => $item->id]) }}">
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