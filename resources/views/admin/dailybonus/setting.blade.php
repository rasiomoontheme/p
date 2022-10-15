@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.dailybonus.post_setting') }}" method="post" id="searchForm" name="searchForm"
                      class="form-horizontal">
                    <div class="card-toolbar clearfix">
                        <div class="col-sm-3">
                            <div class="input-group form-group">
                                <span class="input-group-addon">@lang('res.daily_bonus.setting.currency')</span>
                                <select name="currency" id="currency" class="form-control">
                                    @foreach($lang_list as $k_lang => $v_lang_name)
                                        <option value="{{ $k_lang }}" @if($k_lang == $now_currency) selected @endif>{{ $v_lang_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="toolbar-btn-action">

                            <a id="add-btn" class="btn btn-label btn-primary m-r-5" href="javascript:;">
                                <label><i class="mdi mdi-plus"></i></label> @lang('res.btn.add')
                            </a>

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
                                    <td width="10%">@lang('res.daily_bonus.setting.deposit')</td>
                                    <td width="15%">@lang('res.daily_bonus.setting.valid_num')</td>
                                    <td width="10%">@lang('res.daily_bonus.setting.times')</td>
                                    <td width="10%">@lang('res.daily_bonus.setting.is_open')</td>
                                    <td width="10%">@lang('res.common.operate')</td>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>
                                            <input type="number" class="form-control" name="deposit[]"
                                                   value="{{ $item['deposit'] ?? '' }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="valid_num[]"
                                                   value="{{ $item['valid_num'] ?? '' }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="times[]"
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
                                                @lang('res.btn.delete')
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
    </div>

@endsection

@section("footer-js")
    <script>
        var index_route = "{{ url('/admin/dailybonus/setting') }}";
        $(function(){
            $(document).on('click', '.delete-btn', function () {
                $(this).parents('tr').remove();
            });

            $('#currency').change(function(){
                var v = $(this).val();
                window.location.href=index_route+'?currency='+v;
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
