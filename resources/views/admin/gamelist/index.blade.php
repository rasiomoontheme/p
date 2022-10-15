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
                            'name' => ['name' => trans('res.game_list.field.name'),'type' => 'text'],
                            'api_name' => ['name' => trans('res.game_list.field.api_name'),'type' => 'select','data' => \App\Models\Api::getApiNameArray()],
                            'client_type' => ['name' => trans('res.api_game.field.client_type'),'type' => 'select','data' => trans('res.option.client_type')],
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime']
                        ]
                        ])

                        <div class="col-sm-3">
                            <div class="input-group form-group">
                                <span class="input-group-addon">@lang('res.game_list.field.tags')</span>
                                <select name="tags[]" id="tags" class="form-control js_select2" multiple="multiple">
                                    {{-- <option value="">--请选择--</option> --}}
                                    @foreach(trans('res.option.tag_type') as $key =>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

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
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.gamelists.create") }}"><i
                                class="mdi mdi-plus"></i>
                        @lang('res.btn.add')</a>
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a> --}}
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/gamelists/ids">
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
                            @include('layouts._table_header',['data' => \App\Models\GameList::$list_field,'model' => 'game_list'])
                            {{-- <th width=100>修改时间</th> --}}
                            <th>@lang('res.game_list.field.img_url')</th>
                            <th>@lang('res.game_list.field.tags')</th>
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
                                @include('layouts._table_body',['data' => \App\Models\GameList::$list_field,'item' => $item])
                                {{-- <td>{{ $item->updated_at }}</td> --}}
                                <td>@include("layouts._table_image",['url' => $item->full_image_url])</td>
                                <td>
                                    @if($item->tags)
                                        @foreach ($item->tags_array as $k => $v)
                                            <span class="label {{ config('platform.style_label')[$k+1] }}">{{ trans('res.option.tag_type')[$v] }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default" href="javascript:;"
                                           data-url="{{ route('admin.gamelists.edit',['gamelist' => $item->id]) }}" title=""
                                           data-operate="iframe-page" data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.gamelists.show', ['gamelist' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.gamelists.destroy', ['gamelist' => $item->id]) }}">
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

@section("footer-js")
    <script>
        $("#tags").val({!! json_encode(isset_and_not_empty($params,'tags',[])) !!}).trigger('change');

    </script>
@endsection
