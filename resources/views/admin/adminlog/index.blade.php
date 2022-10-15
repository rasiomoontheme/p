@extends('layouts.baseframe')

@section('title', $title ?? $_title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title ?? $_title }}</h4>
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
                        //'name' => ['name' => '用户名','type' => 'text'],
                        // 'type' => ['name' => '日志类型','type' => 'select','data' => \App\Models\AdminLog::$logTypeMap],
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
                    {{-- <a class="btn btn-primary m-r-5" href="{{ route("admin.adminlogs.create") }}"><i
                        class="mdi mdi-plus"></i> 新增</a> --}}
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a> --}}
                    {{--<a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/adminlogs/ids">--}}
                    {{--<i class="mdi mdi-window-close"></i> 删除--}}
                    {{--</a>--}}
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="15">
                                <label class="lyear-checkbox checkbox-primary">
                                    <input type="checkbox" id="check-all"><span></span>
                                </label>
                            </th>
                            <th width="100">@lang('res.admin_log.field.user_name')</th>
                            {{-- <th>操作URL</th> --}}
                            {{-- <th>操作数据</th> --}}
                            {{-- <th width="50">备注说明</th> --}}
                            <th width="50">@lang('res.admin_log.field.ip')</th>
                            <th width="80">@lang('res.admin_log.field.address')</th>
                            {{-- <th>操作环境</th> --}}
                            <th width="90">@lang('res.admin_log.field.type')</th>
                            <th width="300">@lang('res.admin_log.field.description')</th>
                            <th>@lang('res.common.created_at')</th>
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
                                <td>{{ $item->user->name ?? '-' }}</td>
                                {{-- <td title="{{ $item->url }}">{{ string_limit($item->url,20) }}</td> --}}
                                {{-- <td title="{{ $item->data }}">
                                    {{ string_limit($item->data,20) }}
                                </td> --}}
                                {{-- <td>{{ $item->remark }}</td> --}}
                                <td>{{ $item->ip }}</td>
                                <td>{{ $item->address }}</td>
                                {{-- <td title="{{ $item->ua }}">{{ string_limit($item->ua,20) }}</td> --}}
                                <td>{{ \Illuminate\Support\Arr::get(trans('res.admin_log.type'),$item->type) }}</td>
                                <td title="{{ $item->description }}">{{ string_limit($item->description,90) }}</td>
                                <td width="100">{{ $item->created_at }}</td>
                                <td width="100">
                                    <div class="btn-group">
                                        {{-- <a class="btn btn-xs btn-default" href="{{ route('admin.adminlogs.edit',['adminlog' => $item->id]) }}"
                                        title="" data-toggle="tooltip"
                                        data-original-title="编辑"><i class="mdi mdi-pencil"></i></a> --}}

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.adminlogs.show', ['adminlog' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.adminlogs.destroy', ['adminlog' => $item->id]) }}">
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