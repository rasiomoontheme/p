@extends('layouts.baseframe')

@section('title', '活动类型设置')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>活动类型设置</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.activity.post_type') }}" method="post" id="searchForm" name="searchForm"
                  class="form-horizontal">
                <div class="card-toolbar clearfix">
                    <div class="toolbar-btn-action">
                        <a id="add-btn" class="btn btn-label btn-primary m-r-5" href="javascript:;">
                            <label><i class="mdi mdi-plus"></i></label>新增
                        </a>

                        <a class="btn btn-label btn-info" data-operate="ajax-submit">
                            <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> 保存
                        </a>

                    </div>
                </div>

                <div class="card-body">
                    <div class="row p-15">
                        <table id="table" class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <td width="40%">类型标识</td>
                                <td width="40%">活动类型文字</td>
                                <td width="20%">操作</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $k => $v)
                                <tr>
                                    <td>
                                        <input type="number" class="form-control" name="number[]" placeholder="请输入类型标识"
                                               value="{{ $k ?? '' }}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="text[]" placeholder="请输入活动类型文字"
                                               value="{{ $v ?? '' }}" />
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="delete-btn btn btn-danger btn-xs">
                                            删除
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section("footer-js")
    <script>
        $(function(){
            $(document).on('click', '.delete-btn', function () {
                $(this).parents('tr').remove();
            });

            $('#add-btn').click(function () {
                // 获取 table 中最后一个td
                var tbody = $('#table').find('tbody');
                tbody.append(
                    '<tr><td><input type="number" class="form-control" name="number[]" placeholder="请输入类型标识" value="" /></td>'
                    + '<td><input type="text" class="form-control" name="text[]" placeholder="请输入活动类型文字" value="" /></td>'
                    + '<td><a href="javascript:;" class="delete-btn btn btn-danger btn-xs">删除</a></td></tr>');
            });

        })
    </script>
@endsection