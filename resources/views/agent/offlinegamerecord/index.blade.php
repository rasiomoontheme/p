@extends('layouts.baseframe')

@section('title', trans('res.agent_page.title.game_records'))

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ trans('res.agent_page.title.game_records') }}</h4>
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
                            'member_id' => ['name' => trans('res.common.member_name'),'type' => 'select','data' => $member_list ?? []],
                            'api_name' => ['name' => trans('res.agent_page.field.api_name'),'type' => 'select','data' => App\Models\Api::query()->getApiNameArray()],
                            'game_type' => ['name' => trans('res.common.game_type'),'type' => 'select','data' => trans('res.option.game_type')],
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime']
                            ]
                        ])

                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-magnify"></i>@lang('res.btn.search')</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()"><i class="mdi mdi-loop"></i>@lang('res.btn.reset')</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            @include('layouts._table_header',['data' => \App\Models\GameRecord::$list_field,'model' => 'game_record'])
                            <th>@lang('res.game_record.field.shuyinAmount')</th>
                            <th width=100>@lang('res.common.created_at')</th>
                            <th>@lang('res.common.operate')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                @include('layouts._table_body',['data' => \App\Models\GameRecord::$list_field,'item' => $item])
                                {{-- <td>{{ $item->updated_at }}</td> --}}
                                <td>{{ $item->netAmount - $item->betAmount }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <td><strong style="color: red">@lang('res.common.sum')</strong></td>
                        <td colspan="5"></td>
                        <td><strong style="color: red">{{ $total_betAmount }}</strong></td>
                        <td><strong style="color: red">{{ $total_validBetAmount }}</strong></td>
                        <td><strong style="color: red">{{ $total_netAmount }}</strong></td>
                        <td colspan="2"></td>
                        </tfoot>
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