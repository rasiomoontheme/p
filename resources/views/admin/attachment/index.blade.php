@extends('layouts.baseframe')

@section('title', 'Danh sách tệp đính kèm')

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Danh sách tệp đính kèm</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#searchContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> Thu gọn
                        </button>
                    </li>
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> Tải lại
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
                        //'type' => ['name' => '日志类型','type' => 'select','data' => \App\Models\AdminLog::$logTypeMap],
                        'created_at' => ['name' => 'Tạo mới','type' => 'datetime']
                        ]
                        ])

                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">Đặt lại</button>&nbsp;
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
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/attachments/ids">
                        <i class="mdi mdi-window-close"></i> Xóa hàng loạt
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
                            <th style="min-width: 90px">Tài khoản người tải lên</th>
                            <th>IP của người tải lên</th>
                            <th>Tên khai sinh</th>
                            <th>Loại MIME</th>
                            <th>Phân loại tệp</th>
                            <th>Kích thước tập tin</th>
                            <th>Địa chỉ tập tin</th>
                            <th>Thời gian sáng tạo</th>
                            <th>Vận hành</th>
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
                                <td>{{ $item->owner->name ?? '' }}</td>
                                <td>{{ $item->ip }}</td>
                                <td>{{ $item->original_name }}</td>
                                <td>{{ $item->mime_type }}</td>
                                <td>{{ $item->file_type_text }}</td>
                                <td>{{ $item->size }} kb</td>
                                <td><a href="{{ $item->file_url }}" target="_blank">点击预览</a></td>
                                <td width="100">{{ $item->created_at }}</td>
                                <td width="100">
                                    <div class="btn-group">
                                        {{-- <a class="btn btn-xs btn-default" href="{{ route('admin.adminlogs.edit',['adminlog' => $item->id]) }}"
                                        title="" data-toggle="tooltip"
                                        data-original-title="编辑"><i class="mdi mdi-pencil"></i></a> --}}

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="详情"
                                           data-url="{{ route('admin.attachments.show', ['attachment' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="删除"
                                           data-url="{{ route('admin.attachments.destroy', ['attachment' => $item->id]) }}">
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
                        <p>Tổng số <strong style="color: red">{{ $data->total() }}</strong> bản ghi</p>
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
