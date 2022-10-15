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
                                'title' => ['name' => trans('res.activity.field.title'),'type' => 'text'],
                                //'status' => ['name' => '用户状态','type' => 'select','data' => \App\Models\User::$statusMap],
                                'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime']
                            ]
                        ])

                        <input type="hidden" name="is_app" value="{{ isApp() }}">

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
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.activities.create",['is_app' => isApp()]) }}"><i
                                class="mdi mdi-plus"></i>
                        @lang('res.btn.add')</a>
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a> --}}
                    <a class="btn btn-danger m-r-5" id="batchDelete" data-operate="delete" data-url="/admin/activities/ids">
                        <i class="mdi mdi-window-close"></i> @lang('res.btn.delete')
                    </a>

                    {{--
                    <a class="btn btn-success" data-operate="iframe-page" data-url="{{ route('admin.activity.type') }}">
                        编辑活动类型
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
                            @include('layouts._table_header',['data' => \App\Models\Activity::$list_field,'model' => 'activity'])
                            <th>@lang('res.activity.field.hall_field')</th>
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

                                @include('layouts._table_body',['data' => \App\Models\Activity::$list_field,'item' => $item])
                                <td>
                                    {{--
                                    @if($item->is_apply)
                                        @foreach ($item->apply_field_array as $k => $v)
                                        <span class="label {{ config('platform.style_label')[$k+1] }}">{{ config('platform.activity_apply_field')[$v] }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                    --}}

                                    @if($item->apply_type == \App\Models\Activity::APPLY_TYPE_HALL)
                                        @foreach ($item->hall_field_array as $k => $v)
                                            <span class="label {{ config('platform.style_label')[$k+1] }}">{{ \Illuminate\Support\Arr::get(trans('res.option.activity_apply_field'),$v) }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.activities.edit',['activity' => $item->id,'is_app' => isApp()]) }}" title=""
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.activities.show', ['activity' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        @if($item->apply_type != \App\Models\Activity::APPLY_TYPE_HALL)
                                            <a class="btn btn-xs btn-default" href="javascript:;"
                                               data-operate="iframe-page"
                                               data-toggle="tooltip" data-original-title="@lang('res.activity.index.btn_preview')" data-title="@lang('res.activity.index.btn_preview')"
                                               data-url="/api/activity/{{ $item->id }}">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        @endif

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.activities.destroy', ['activity' => $item->id]) }}">
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