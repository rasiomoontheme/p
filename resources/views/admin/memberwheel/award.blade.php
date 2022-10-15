@extends('layouts.baseframe')

@section('title', '转盘奖品设置')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>转盘奖品设置</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.memberwheel.post_award') }}" method="post" id="searchForm" name="searchForm"
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
                                <td width="10%">当日存款金额</td>
                                <td width="15%">有效流水（倍数）</td>
                                <td width="10%">转盘次数</td>
                                <td width="10%">是否启用</td>
                                <td width="10%">操作</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <input type="number" class="form-control" name="deposit[]" placeholder="请输入当日存款金额"
                                               value="{{ $item['deposit'] ?? '' }}" />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="valid_num[]" placeholder="请输入有效流水是存款金额的多少倍"
                                               value="{{ $item['valid_num'] ?? '' }}" />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" placeholder="转盘次数" readonly
                                               value="{{ $item['times'] ?? '' }}" />
                                    </td>
                                    <td class="switch-col">
                                        <label class="lyear-switch switch-solid switch-primary">
                                            <input type="checkbox" name="is_open[]" value="{{ $item['is_open'] }}" @if($item['is_open']) checked
                                                    @endif>
                                            @if(!$item['is_open'])
                                                <input type="hidden" name="is_open[]" value="{{ $item['is_open'] }}">
                                            @endif
                                            <span></span>
                                        </label>
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
                    '<tr><td><input type="number" class="form-control" name="deposit[]" placeholder="请输入当日存款金额" value="" /></td>' +
                    '<td><input type="number" class="form-control" name="valid_num[]" placeholder="请输入有效流水是存款金额的多少倍" value="" /></td>' +
                    '<td><input type="number" class="form-control" placeholder="转盘次数" readonly value="1" /></td>' +
                    '<td><label class="lyear-switch switch-solid switch-primary"><input type="checkbox" name="is_open[]" value="1" checked><span></span></label></td>' +
                    '<td><a href="javascript:;" class="delete-btn btn btn-danger btn-xs">删除</a></td></tr>');
            });

        })
    </script>
@endsection