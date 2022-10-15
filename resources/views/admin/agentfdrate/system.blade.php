@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-4">

        <div class="card">
            <div class="card-header">
                <h4>@lang('res.agent_fd_rate.system.highest_title')</h4>
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
                <form action="{{ route('admin.agentfdrate.post_system') }}" method="post" id="searchForm" name="searchForm">
                    <input type="hidden" name="type" value="{{ \App\Models\AgentFdRate::TYPE_SYSTEM_HIGHEST }}">

                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th class="text-center" style="width: 20%">@lang('res.common.game_type')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.field.rate')</th>
                        </tr>
                        @foreach($systemhigh as $item)
                            <tr>
                                <td>
                                    {{ \Illuminate\Support\Arr::get(trans('res.option.game_type'),$item->game_type,'-') }}
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="rate[{{$item->game_type}}]" value="{{ $item->rate }}" required>
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <button class="btn btn-warning pull-right" type="reset">@lang('res.btn.reset')</button>
                                <button class="btn btn-primary pull-right m-r-5" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>

            </div>
        </div>

    </div>

    <div class="col-sm-4">

        <div class="card">
            <div class="card-header">
                <h4>@lang('res.agent_fd_rate.system.lowest_title')</h4>
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
                <form action="{{ route('admin.agentfdrate.post_system') }}" method="post" id="searchForm" name="searchForm">
                    <input type="hidden" name="type" value="{{ \App\Models\AgentFdRate::TYPE_SYSTEM_LOWEST }}">

                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th class="text-center" style="width: 20%">@lang('res.common.game_type')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.field.rate')</th>
                        </tr>
                        @foreach($systemlow as $item)
                            <tr>
                                <td>
                                    {{ \Illuminate\Support\Arr::get(trans('res.option.game_type'),$item->game_type,'-') }}
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="rate[{{$item->game_type}}]" value="{{ $item->rate }}" required>
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <button class="btn btn-warning pull-right" type="reset">@lang('res.btn.reset')</button>
                                <button class="btn btn-primary pull-right m-r-5" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>

            </div>
        </div>

    </div>

    <div class="col-sm-4">

        <div class="card">
            <div class="card-header">
                <h4>@lang('res.agent_fd_rate.system.default_title')</h4>
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
                <form action="{{ route('admin.agentfdrate.post_system') }}" method="post" id="searchForm" name="searchForm">
                    <input type="hidden" name="type" value="{{ \App\Models\AgentFdRate::TYPE_SYSTEN_AGENT }}">

                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th class="text-center" style="width: 20%">@lang('res.common.game_type')</th>
                            <th class="text-center" style="width: 20%">@lang('res.agent_fd_rate.field.rate')</th>
                        </tr>
                        @foreach($sys as $item)
                            <tr>
                                <td>
                                    {{ \Illuminate\Support\Arr::get(trans('res.option.game_type'),$item->game_type,'-') }}
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="rate[{{$item->game_type}}]" value="{{ $item->rate }}" required>
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <button class="btn btn-warning pull-right" type="reset">@lang('res.btn.reset')</button>
                                <button class="btn btn-primary pull-right m-r-5" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>

            </div>
        </div>

    </div>
@endsection

