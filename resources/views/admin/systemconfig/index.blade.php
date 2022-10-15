@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>注意：</strong> 本页面配置请勿随意修改
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#searchContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> 折叠
                        </button>
                    </li>
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> 刷新
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
                        'name' => ['name' => '配置标识','type' => 'text'],
                        'title' => ['name' => '配置标题','type' => 'text'],
                        'config_group' => ['name' => '配置分组','type' => 'text'],
                        //'status' => ['name' => '用户状态','type' => 'select','data' => \App\Models\User::$statusMap],
                        'created_at' => ['name' => '创建时间','type' => 'datetime'],
                        'is_open' => ['name' => '是否开启','type' => 'select', 'data' => config('platform.is_open')]
                        ]
                        ])

                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">搜索</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">重置</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-toolbar clearfix">
                <div class="toolbar-btn-action">
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.systemconfigs.create") }}"><i
                                class="mdi mdi-plus"></i> 新增</a>
                    <a class="btn btn-info m-r-5" data-operate="iframe-page"
                       href="javascript:;" data-url="{{ route('admin.systemconfigs.export') }}">
                        <i class="mdi mdi-file-export"></i>配置数组导出
                    </a>
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a> --}}
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/systemconfigs/ids">
                        <i class="mdi mdi-window-close"></i> 删除
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
                            <th>配置英文标识</th>
                            <th>配置标题</th>
                            <th>配置分组</th>
                            <th>配置类型</th>
                            <th>配置值</th>
                            <th>是否开放</th>
                            {{-- <th>描述</th>                 --}}
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
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
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->config_group }}</td>

                                <td>{{ $item->type_text }}</td>

                                <td>
                                    @if ($item->type == \App\Models\SystemConfig::CONFIG_TYPE_PICTURE)
                                        @include("layouts._table_image",['url' => $item->value])
                                    @else
                                        {{ string_limit($item->value,20) }}
                                    @endif

                                </td>
                                {{-- <td>{{ \App\Models\Base::$isOpenMap[$item->is_open] }}</td> --}}

                                <td>
                                    @include('layouts._table_label',[
                                    'list' => '',
                                    'style' => 'platform.style_boolean',
                                    'key' => $item->is_open,
                                    'data' => 'platform.is_open'
                                    // 'field' => 'style_status'
                                    ])
                                </td>

                                {{-- <td>{{ $item->description }}</td> --}}
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.systemconfigs.edit',['systemconfig' => $item->id]) }}"
                                           title="" data-toggle="tooltip" data-original-title="编辑"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="详情"
                                           data-url="{{ route('admin.systemconfigs.show', ['systemconfig' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="删除"
                                           data-url="{{ route('admin.systemconfigs.destroy', ['systemconfig' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a>
                                        {{-- <a class="btn btn-xs btn-default" href="{{ route('admin.systemconfigs.assign',['systemconfig' => $item->id]) }}"
                                        data-toggle="tooltip" data-original-title="分配权限">
                                        <i class="mdi mdi-account-check"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="clearfix">
                    <div class="pull-left">
                        <p>总共 <strong style="color: red">{{ $data->total() }}</strong> 条</p>
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
        //日期时间范围
        laydate.render({
            elem: '#created_at',
            type: 'datetime',
            theme: "#33cabb",
            range: "~"
        });

    </script>
@endsection
