@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">

                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
            </div>


            <div class="card-body">
                <form action="" method="get" id="searchForm" name="searchForm">
                    <div class="row">
                        @include('layouts._search_field',
                        [
                        'list' => [
                            'member_id' => ['name' => trans('res.common.member_name'),'type' => 'select','data' => \App\Models\Member::getMemberArray()],
                            'start_at' => ['name' => trans('res.quick.transfer_check.start_at'),'type' => 'datetime-single'],
                            'end_at' => ['name' => trans('res.quick.transfer_check.end_at'),'type' => 'datetime-single'],
                            // datetime-single
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

        @if(count($params))
            <div class="card">
                <div class="card-header">
                    <h4>@lang('res.quick.member_arbitrage_query.result')</h4>
                </div>

                <div class="card-body">

                    @if($error_msg)
                        <div class="alert alert-warning" role="alert">{{ $error_msg }}</div>
                    @endif

                    @if($transfer_list && $local_transfer_list)

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                <tr>
                                    <th class="text-center">@lang('res.transfer.field.bill_no')</th>

                                    {{--
                                    <th class="text-center">@lang('res.quick.transfer_check.transfer_out_account')</th>
                                    <th class="text-center">@lang('res.quick.transfer_check.transfer_in_account')</th>
                                    --}}

                                    <th class="text-center">转换类型</th>
                                    <th class="text-center">@lang('res.quick.transfer_check.money')</th>
                                    <th class="text-center">@lang('res.quick.transfer_check.is_dd')</th>
                                    <th class="text-center">@lang('res.common.created_at')</th>
                                    <th class="text-center">@lang('res.common.operate')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transfer_list as $item)
                                    <tr>
                                        <td>{{ $item['merchant_bill_no'] }}</td>

                                        {{--
                                        <td>{{ $item['transfer_out_account'] }}</td>
                                        <td>{{ $item['transfer_in_account'] }}</td>
                                        --}}

                                        <td>{{ trans('res.option.transfer_type')[$item['transfer_type']] }}</td>

                                        <td>{{ $item['money'] }}</td>
                                        <td data-status>
                                            @if($local_transfer_list->contains($item['bill_no']))
                                                <span style="color:green">{{ trans('res.option.boolean')[intval($local_transfer_list->contains($item['bill_no']))] }}</span>
                                            @else
                                                <span style="color:red">{{ trans('res.option.boolean')[intval($local_transfer_list->contains($item['bill_no']))] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['created_at'] }}</td>
                                        <td>
                                            @if(!$local_transfer_list->contains($item['merchant_bill_no']))
                                                <button class="btn btn-primary btn-xs btn-operate" data-type="1" type="button" data-member="{{ $params['member_id'] }}" data-url="{{ route('admin.quick.add_transfer') }}">
                                                    @lang('res.quick.transfer_check.btn_supply')
                                                </button>

                                                <button class="btn btn-info btn-xs btn-operate" data-type="2" data-member="{{ $params['member_id'] }}" type="button" data-url="{{ route('admin.quick.add_transfer') }}">
                                                    @lang('res.quick.transfer_check.btn_supply_modify')
                                                </button>

                                                <input type="hidden" value="{{ json_encode($item) }}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif
                </div>

            </div>
        @endif
    </div>

@endsection

@section("footer-js")
    <script>
        //日期时间范围
        /**
         laydate.render({
            elem: '#end_at',
            type: 'datetime',
            theme: "#33cabb",
            //range: "~"
        });
         **/

        $('.btn-operate').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);

            var json = _this.parent().find('input').val()

            if(!_this.data('url') || !_this.data('type') || !_this.data('member') || !json) return;

            $.ajax({
                url: _this.data('url'),
                method:'post',
                data: {
                    json: json,
                    type: _this.data('type'),
                    member_id: _this.data('member')
                },
                success: function(res){
                    _this.attr("disabled", false);

                    if(res.code == 200) {
                        _this.parent().parent().find('td[data-status] span').html('<span style="color:green">否</span>')
                        _this.parent().html('')
                        $.utils.layerSuccess(res.message);
                    }
                    else $.utils.layerError(res.message)
                },
                error:function(err){
                    _this.attr("disabled", false);
                }
            });
        })

    </script>
@endsection