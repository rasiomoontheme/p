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
                            'type' => ['name' => trans('res.quick.member_arbitrage_query.arbitrage_type'),'type' => 'select','data' => trans('res.option.arbitrage_conditions')],
                            ]
                        ])

                        <div class="col-lg-3 col-sm-3">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i>@lang('res.btn.search')</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()"><i class="mdi mdi-loop"></i>@lang('res.btn.reset')</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        @if($data && $member)
            <div class="card">

                <div class="card-header">
                    <h4>@lang('res.quick.member_arbitrage_query.result')</h4>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th width="20%" class="text-center">@lang('res.quick.member_arbitrage_query.total_number')</th>
                                <th width="20%" class="text-center">{{ \Illuminate\Support\Arr::get(trans('res.option.arbitrage_conditions'),$params['type']) }}</th>
                                <th class="text-center">@lang('res.common.member_name')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data->count())
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td>
                                            {{ $item->count() }}
                                        </td>
                                        <td>
                                            {{ $key }}
                                        </td>
                                        <td>
                                            {{ $item->implode(' | ') }}
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="3">
                                        @lang('res.quick.member_arbitrage_query.no_result')
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        @endif
    </div>

@endsection