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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            @foreach($tabs as $item)
                                <th width="20%" class="text-center">{{ $item }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($tabs as $key => $item)
                                <td>{{ $sum[$key]->sum('count') }}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    @foreach($tabs as $key => $value)
                        <li @if($loop->first) class="active" @endif>
                            <a href="#{{ $key }}" id="{{ $key }}-tab" role="tab" data-toggle="tab">{{ $value }}</a>
                        </li>
                    @endforeach
                </ul>

                <div id="myTabContent" class="tab-content">
                    @foreach($tabs as $key => $value)
                        <div class="tab-pane fade @if($loop->first) active in @endif" id="{{ $key }}">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                <tr>
                                    <th class="text-center" width="20%">{{ $value }}</th>
                                    <th class="text-center" width="80%">重复账号</th>
                                </tr>
                                </thead>
                                @if($data[$key]->count())
                                    <tbody>
                                    @foreach($data[$key] as $k => $v)
                                        <tr>
                                            <td>
                                                {{ $k }}
                                            </td>
                                            <td>
                                                {{ $v->implode(' | ') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif

                                @if(!$data[$key]->count())
                                    <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            不存在重复数据
                                        </td>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection