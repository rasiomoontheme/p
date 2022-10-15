@extends('layouts.baseframe')

@section('title', trans('res.agent_page.title.agent_report'))

@section('content')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('res.agent_page.title.agent_report')</h4>
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
                            'created_at' => ['name' => trans('res.agent_page.field.time_range'),'type' => 'datetime']
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
                    <table class="table table-bordered text-center">
                        <tr>
                            <th class="text-center" width="50%">@lang('res.agent_page.field.total_deposit')</th>
                            <th class="text-center" width="50%">@lang('res.agent_page.field.recharge_count')</th>
                        </tr>
                        <tr>
                            <td>{{ $total_recharge }}</td>
                            <td>{{ $recharge_count }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered text-center">
                        <tr>
                            <th class="text-center" width="50%">@lang('res.agent_page.field.total_drawing')</th>
                            <th class="text-center" width="50%">@lang('res.agent_page.field.drawing_count')</th>
                        </tr>
                        <tr>
                            <td>{{ $total_drawing }}</td>
                            <td>{{ $drawing_count }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered text-center">
                        <tr>
                            <th class="text-center" colspan="3">@lang('res.agent_page.field.dividend_hongli')</th>
                        </tr>
                        <tr>
                            <th class="text-center" width="33.3%">@lang('res.agent_page.field.dividend_activity')</th>
                            <th class="text-center" width="33.%">@lang('res.agent_page.field.dividend_fs')</th>
                            <th class="text-center" width="33.3%">@lang('res.agent_page.field.dividend_other')</th>
                        </tr>
                        <tr>
                            <th class="text-center">{{ $dividend_money_1 }}</th>
                            <th class="text-center">{{ $dividend_money_2 }}</th>
                            <th class="text-center">{{ $dividend_money_3 }}</th>
                        </tr>
                    </table>

                    <table class="table table-bordered text-center">
                        <tr>
                            <th class="text-center" width="50%">@lang('res.agent_page.field.total_profit')</th>
                            <th class="text-center" width="50%">@lang('res.agent_page.field.member_win_and_loss')</th>
                        </tr>
                        <tr>
                            <td>{{ $total_sy_money }}</td>
                            <td>{{ sprintf("%.2f",$total_drawing -  $total_recharge) }}</td>
                        </tr>
                    </table>

                </div>


            </div>
        </div>
    </div>

@endsection