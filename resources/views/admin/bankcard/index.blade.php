@extends('layouts.baseframe')

@section('title', '银行卡列表')

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>银行卡列表</h4>
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
                            'created_at' => ['name' => '创建时间','type' => 'datetime']
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
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.bankcards.create") }}"><i
                                class="mdi mdi-plus"></i>
                        新增</a>
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a> --}}
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/bankcards/ids">
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
                            @include('layouts._table_header',['data' => \App\Models\BankCard::$list_field])
                            <th width=100>修改时间</th>
                            <th width=100>创建时间</th>
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
                                @include('layouts._table_body',['data' => \App\Models\BankCard::$list_field,'item' => $item])
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.bankcards.edit',['bankcard' => $item->id]) }}" title=""
                                           data-toggle="tooltip" data-original-title="编辑"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                            data-toggle="tooltip" data-original-title="详情"
                                            data-url="{{ route('admin.bankcards.show', ['bankcard' => $item->id]) }}">
                                        <i class="mdi mdi-file-document-box"></i>
                                        </a> --}}

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="删除"
                                           data-url="{{ route('admin.bankcards.destroy', ['bankcard' => $item->id]) }}">
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
