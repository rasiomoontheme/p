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
                            'member_name' => ['name' => trans('res.common.member_name'),'type' => 'text'],
                            'member_lang' => ['name' => trans('res.member.field.lang'),'type' => 'select','data' => config('platform.lang_select')],
                            'api_name' => ['name' => trans('res.transfer.field.api_name'),'type' => 'select','data' => \App\Models\Api::getApiNameArray()],
                            'transfer_type' => ['name' => trans('res.transfer.field.transfer_type'),'type' => 'select','data' => trans('res.option.transfer_type')],
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime']
                        ]
                        ])
                        <input type="hidden" name="member_id" value="{{ $params['member_id'] ?? '' }}">
                        <div class="col-lg-3 col-sm-3">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">@lang('res.btn.search')</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">@lang('res.btn.reset')</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>
                <h4>Check Transaction Supported product code: WB, AG, CF, SU, PG. Example: 2406207338</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Referenceid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="referenceid" id="referenceid"></td>
                            <td>
                                <a href="javascript:;" class="btn btn-primary check-transaction"
                                    data-url="{{ route('admin.transfers.TransactionStatus') }}" data-toggle="tooltip" 
                                    <i class="mdi mdi-refresh"></i>
                                    <span>Check</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-toolbar clearfix">
                <div class="toolbar-btn-action">
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/transfers/ids">
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
                            @include('layouts._table_header',['data' => \App\Models\Transfer::$list_field,'model' => 'transfer'])
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
                                @include('layouts._table_body',['data' => \App\Models\Transfer::$list_field,'item' =>
                                $item])
                                <td style="min-width: 110px">{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.transfers.show', ['transfer' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.transfers.destroy', ['transfer' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <td>@lang('res.common.sum')</td>
                        <td colspan="5"></td>
                        <td>{{ $total_money }}</td>
                        <td>{{ $total_diff_money }}</td>
                        <td colspan="5"></td>
                        </tfoot>
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
        $('.check-transaction').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);
            if(!_this.data('url')) return;
            var referenceid = $('#referenceid').val();
            $.ajax({
                url: _this.data('url'),
                method:'post',
                data: {
                    referenceid : referenceid,
                },
                success:function(res){
                    console.log(res);
                    _this.attr("disabled", false);
                    if(res.code == 200 && res.data) _this.find('span').html(res.data)
                    else $.utils.layerError(res.message)
                },
                error:function(err){
                    _this.attr("disabled", false);
                }
            });
        });
    </script>
@endsection