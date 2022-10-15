@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        @if(!$data->count())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                @lang('res.agent_fd_rate.agent.top_notice')
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>@lang('res.common.quick_operate')</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group form-group">
                            <span class="input-group-addon">@lang('res.agent_fd_rate.agent.operate_total')</span>
                            <input type="number" class="form-control" id="set-all-rate">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-2">
                        <div class="input-group">
                            <button type="button" class="btn btn-primary" id="set-all">
                                <i class="mdi mdi-pencil"></i>
                                @lang('res.agent_fd_rate.agent.btn_apply')
                            </button>&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                {{--<h4>设置代理【{{ $agent->member->name }}】反点点位</h4>--}}
                <h4>{{ trans('res.agent_fd_rate.agent.title',['name' => $agent->member->name]) }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.agentfdrate.post_agent',['agent' => $agent->id]) }}" method="post"
                      id="searchForm" name="searchForm">
                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th class="text-center" style="width: 20%">@lang('res.common.game_type')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.field.rate')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.agent.system_highest')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.agent.system_lowest')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.agent.system_default')</th>
                        </tr>
                        @foreach(config('platform.game_type') as $key => $value)
                            <tr>
                                <td>
                                    {{ $value }}
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="rate[{{$key}}]"
                                               value="{{ $data[$key] ?? $sys[$key] }}"
                                               required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </td>
                                <td>
                                    {{ $systemhigh[$key] }}
                                </td>
                                <td>
                                    {{ $systemlow[$key] }}
                                </td>
                                <td>
                                    {{ $sys[$key]  }}
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <button class="btn btn-warning pull-right" type="reset">@lang('res.btn.reset')</button>
                                <button class="btn btn-primary pull-right m-r-5" data-operate="ajax-submit"
                                        type="button">@lang('res.btn.save')
                                </button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('footer-js')
    <script>
        $('#set-all').click(function () {
            var rate = $('#set-all-rate').val();
            if (!rate) $.utils.layerError('{{ trans('res.agent_fd_rate.agent.quick_notice') }}');

            $('#searchForm input[type=number]').val(rate);
        })
    </script>
@endsection