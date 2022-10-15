@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{ trans('res.common.lang_notice') }}
        </div>

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
                            'member_name' => ['name' => trans('res.member.field.player_name'),'type' => 'text'],
                            'bet_product' => ['name' => trans('res.member.field.game_type'),'type' => 'select','data' => config('platform.game_type_code')],
                            'api_name' => ['name' => trans('res.game_record.field.game_name'),'type' => 'select','data' => App\Models\Api::query()->getApiNameArray()],
                            'result_bet_status' => ['name' => trans('res.member.field.bet_status'),'type' => 'select','data' => config('platform.bet_histories_status')],
                            ]
                        ])

                        <div class="col-lg-3 col-sm-3">
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

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('res.member.field.player_name') }}</th>
                                <th>{{ trans('res.member.field.game_type') }}</th>
                                <th>{{ trans('res.member.field.api_name') }}</th>
                                <th>{{ trans('res.member.field.bet') }}</th>
                                <th>{{ trans('res.member.field.payout') }}</th>
                                <th>{{ trans('res.member.field.bet_start_time') }}</th>
                                <th>{{ trans('res.member.field.bet_end_time') }}</th>
                                <th>{{ trans('res.member.field.result_bet_status') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as$key =>  $item)
                            <tr>
                                <td>{{ $item->member_name }}</td>
                                <td>{{ data_get(configPlatform('game_type_code'), $item->bet_product) }}</td>
                                <td>{{ !empty($item->api) ? $item->api->api_title : '' }}</td>
                                <td>{{ getPriceVN(number_format($item->bet, 2)) }}</td>
                                <td>{{ getPriceVN(number_format($item->payout, 2)) }}</td>
                                <td>{!! $item->getBetStartTime() !!}</td>
                                <td>{!! $item->getBetEndTime() !!}</td>
                                <td>{!! $item->getBetStatus() !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if($data)
                    <div class="clearfix">
                        <div class="pull-left">
                            <p>@lang('res.common.total') <strong style="color: red">{{ $data->total() }}</strong> @lang('res.common.count')</p>
                        </div>
                        <div class="pull-right">
                            {!! $data->appends($params)->render() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
