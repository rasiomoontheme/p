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
                        'name' => ['name' => trans('res.user.field.name'),'type' => 'text'],
                        'status' => ['name' => trans('res.user.field.status'),'type' => 'select','data' => trans('res.user.status')],
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
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.users.create") }}"><i class="mdi mdi-plus"></i>
                        @lang('res.btn.add')</a>
                    {{-- {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a> --}}
                    <a class="btn btn-warning m-r-5" href="{{ route('admin.users.export') }}"><i
                                class="mdi mdi-file-export"></i> @lang('res.btn.export')</a>
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/users/ids">
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
                            <th>@lang('res.user.field.name')</th>
                            {{-- <th>EMail</th> --}}
                            <th>@lang('res.user.field.create_ip')</th>
                            <th>@lang('res.user.field.status')</th>
                            @if(systemconfig('is_backend_google_auth'))
                                <th>@lang('res.user.field.is_google_secret')</th>
                            @endif
                            <th>@lang('res.common.created_at')</th>
                            <th>@lang('res.common.updated_at')</th>
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
                                <td>{{ $item->name }}</td>
                                {{-- <td>{{ $item->email }}</td> --}}
                                <td>{{ $item->create_ip }}</td>
                                <td>
                                    @if($item->status == \App\Models\User::STATUS_NORMAL)
                                        <span class="label label-success">{{ \Illuminate\Support\Arr::get(trans('res.user.status'),$item->status) }}</span>
                                    @else
                                        <span class="label label-danger">{{ \Illuminate\Support\Arr::get(trans('res.user.status'),$item->status) }}</span>
                                    @endif
                                </td>
                                @if(systemconfig('is_backend_google_auth'))
                                    <td>
                                        @if($item->google_secret)
                                            <span class="label label-success">{{ \Illuminate\Support\Arr::get(trans('res.option.boolean'),1) }}</span>
                                        @else
                                            <span class="label label-danger">{{ \Illuminate\Support\Arr::get(trans('res.option.boolean'),0) }}</span>
                                        @endif
                                    </td>
                                @endif
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.users.edit',['user' => $item->id]) }}" title=""
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>
                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.users.destroy', ['user' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a>
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.users.assign',['user' => $item->id]) }}"
                                           data-toggle="tooltip" data-original-title="@lang('res.user.index.btn_assgin')">
                                            <i class="mdi mdi-account-check"></i>
                                        </a>

                                        @if(systemconfig('is_backend_google_auth'))
                                            <a class="btn btn-xs btn-default" href="javascript:;" data-operate="alert-deal"
                                               data-toggle="tooltip" data-method="POST"
                                               data-original-title="@lang('res.user.google.reset_btn')"
                                               data-message="@lang('res.user.google.reset_message')"
                                               data-url="{{ route('admin.user.post_reset_google', ['user' => $item->id]) }}">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        @endif
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