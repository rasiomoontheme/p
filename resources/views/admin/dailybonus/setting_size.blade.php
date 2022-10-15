@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.dailybonus.post_setting_size') }}" method="post" id="searchForm" name="searchForm"
                      class="form-horizontal">
                    <div class="card-toolbar clearfix">
                        <div class="toolbar-btn-action">
                            {{--                            <a id="add-btn" class="btn btn-label btn-primary m-r-5" href="javascript:;">--}}
                            {{--                                <label><i class="mdi mdi-plus"></i></label> @lang('res.btn.add')--}}
                            {{--                            </a>--}}

                            <a class="btn btn-label btn-info" data-operate="ajax-submit">
                                <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> @lang('res.btn.save')
                            </a>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row p-15">
                            <table id="table" class="table table-bordered table-hover text-center">
                                <thead>
                                <tr>
                                    <td width="10%">@lang('res.daily_bonus.setting.currency')</td>
                                    <td width="15%">@lang('res.daily_bonus.setting.min')</td>
                                    <td width="10%">@lang('res.daily_bonus.setting.max')</td>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $k => $item)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control"
                                                   value="{{ $item['a'] ?: '' }}" readonly />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="{{$k}}[]"
                                                   value="{{ $item['b'][0] ?? 1 }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="{{$k}}[]"
                                                   value="{{ $item['b'][1] ?? 1 }}" />
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
                    '<tr><td><input type="number" class="form-control" name="deposit[]" value="" /></td>' +
                    '<td><input type="number" class="form-control" name="valid_num[]" value="" /></td>' +
                    '<td><input type="number" class="form-control" name="times[]" value="1" /></td>' +
                    '<td><label class="lyear-switch switch-solid switch-primary"><input type="checkbox" name="is_open[]" value="1" checked><span></span></label></td>' +
                    '<td><a href="javascript:;" class="delete-btn btn btn-danger btn-xs">{{ trans('res.btn.delete') }}</a></td></tr>');
            });
        });
    </script>
@endsection
