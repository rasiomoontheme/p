@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    {{-- http://lyear.itshubao.com/iframe/lyear_main.html --}}

    {{--今日注册，今日营销，今日投注，今日游戏总营收，本月--}}

    @if(auth()->user()->hasPermissionTo('欢迎界面'))
        <div class="col-sm-12">
            <div class="row">

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-primary">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.today_register')</p>
                                <p class="h3 text-white m-b-0">{{ $today_register }}</p>
                            </div>
                            <div class="pull-left">
                        <span class="img-avatar img-avatar-48 bg-translucent">
                            <i class="mdi mdi-account fa-1-5x"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-danger">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.today_free')</p>
                                <p class="h3 text-white m-b-0">{{ $today_free }}</p>
                            </div>
                            <div class="pull-left">
                        <span class="img-avatar img-avatar-48 bg-translucent">
                            <i class="mdi mdi-currency-cny fa-1-5x"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-success">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.today_bet')</p>
                                <p class="h3 text-white m-b-0">{{ $today_bet }}</p>
                            </div>
                            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                                            class="mdi mdi-cards-playing-outline fa-1-5x"></i></span> </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-purple">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.today_game_profit')</p>
                                <p class="h3 text-white m-b-0">{{ $today_game_profit }}</p>
                            </div>
                            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                                            class="mdi mdi-cash-multiple fa-1-5x"></i></span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-primary">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.month_register')</p>
                                <p class="h3 text-white m-b-0">{{ $month_register }}</p>
                            </div>
                            <div class="pull-left">
                        <span class="img-avatar img-avatar-48 bg-translucent">
                            <i class="mdi mdi-account fa-1-5x"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-danger">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.month_free')</p>
                                <p class="h3 text-white m-b-0">{{ $month_free }}</p>
                            </div>
                            <div class="pull-left">
                        <span class="img-avatar img-avatar-48 bg-translucent">
                            <i class="mdi mdi-currency-cny fa-1-5x"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-success">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.month_bet')</p>
                                <p class="h3 text-white m-b-0">{{ $month_bet }}</p>
                            </div>
                            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                                            class="mdi mdi-cards-playing-outline fa-1-5x"></i></span> </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card bg-purple">
                        <div class="card-body clearfix">
                            <div class="pull-right">
                                <p class="h6 text-white m-t-0">@lang('res.index.month_game_profit')</p>
                                <p class="h3 text-white m-b-0">{{ $month_game_profit }}</p>
                            </div>
                            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                                            class="mdi mdi-cash-multiple fa-1-5x"></i></span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('res.index.10_days_recharge')</h4>
                        </div>
                        <div class="card-body">
                            <canvas class="js-chartjs-lines"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('res.index.10_days_drawing')</h4>
                        </div>
                        <div class="card-body">
                            <canvas class="js-chartjs-drawing-lines"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-sm-12">
            @lang('res.index.welcome'){{ auth()->user()->name }}
        </div>
    @endif
@endsection

@section('footer-js')
    <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
    <script>
        $(document).ready(function(e) {
            // $dashChartBarsCnt  = jQuery( '.js-chartjs-bars' )[0].getContext( '2d' )
            var $dashChartLinesCnt = jQuery( '.js-chartjs-lines' )[0].getContext( '2d' ),
                $dashChartDrawingLineCnt = jQuery('.js-chartjs-drawing-lines')[0].getContext( '2d' );


            var $dashChartLinesData = {
                // labels: ['2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'],
                labels: {!! json_encode(array_keys($last_10days)) !!},
                datasets: [
                    {
                        label: '@lang("res.index.recharge_title")',
                        // data: [20, 25, 40, 30, 45, 40, 55, 40, 48, 40, 42, 50],
                        data: {!! json_encode(array_values($last_10days)) !!},
                        borderColor: '#358ed7',
                        backgroundColor: 'rgba(53, 142, 215, 0.175)',
                        borderWidth: 1,
                        fill: false,
                        lineTension: 0.5
                    }
                ]
            };

            var $dashDrawingData = {
                labels: {!! json_encode(array_keys($last_10days_drawing)) !!},
                datasets: [
                    {
                        label: '@lang('res.index.drawing_title')',
                        // data: [20, 25, 40, 30, 45, 40, 55, 40, 48, 40, 42, 50],
                        data: {!! json_encode(array_values($last_10days_drawing)) !!},
                        borderColor: '#358ed7',
                        backgroundColor: 'rgba(53, 142, 215, 0.175)',
                        borderWidth: 1,
                        fill: false,
                        lineTension: 0.5
                    }
                ]
            };

            /**
             *
             new Chart($dashChartBarsCnt, {
                type: 'bar',
                data: $dashChartBarsData
            });
             **/

            new Chart($dashChartLinesCnt, {
                type: 'line',
                data: $dashChartLinesData,
            });

            new Chart($dashChartDrawingLineCnt, {
                type: 'line',
                data: $dashDrawingData,
            });

        });
    </script>
@endsection