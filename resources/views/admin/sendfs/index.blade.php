@extends('layouts.baseframe')

@section('title', '一键反水列表')

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>注意：</strong> 一键反水的能选择的最大日期是【昨天】，游戏类型默认是【真人】，发放过反水的游戏记录不会出现在下列统计中
        </div>

        <div class="card">
            <div class="card-header">
                <h4>一键反水列表</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#searchContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> 折叠
                        </button>
                    </li>
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> 刷新
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
                            'created_at' => ['name' => '创建时间','type' => 'datetime'],
                            'name' => ['name' => '会员账号','type' => 'text'],
                            'gameType' => ['name' => '游戏类型','type' => 'select','data' => config('platform.game_type')],
                            'api_name' => ['name' => 'API接口','type' => 'select','data' => App\Models\Api::query()->getApiNameArray()]
                            ]
                        ])

                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">搜索</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">重置
                                </button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        @if($gamerecords)
            <div class="card">

                <form method="post" action="{{ route('admin.sendfs.store')  }}">

                    <input type="hidden" name="created_at" value="{{ $params['created_at'] }}">
                    <input type="hidden" name="api_name" value="{{ $params['api_name'] }}">
                    <input type="hidden" name="gameType" value="{{ $params['gameType'] }}">

                    <div class="card-toolbar clearfix">
                        <div class="toolbar-btn-action">

                            {{--<a class="btn btn-primary m-r-5" href="{{ route("admin.fslevels.create") }}"><i--}}
                            {{--class="mdi mdi-plus"></i>--}}
                            {{--新增</a>--}}

                            <button class="btn btn-primary m-r-5" data-operate="ajax-submit">
                                <i class="mdi mdi-coin"></i>
                                一键反水
                            </button>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            @php $total_count = $total_tz_amount = $total_fs_money = 0; @endphp

                            <table class="table table-bordered table-hover text-center">
                                <thead>



                                {{--
                                <th>ID</th>
                                --}}

                                <tr>
                                    <th>
                                        <label class="lyear-checkbox checkbox-primary">
                                            <input type="checkbox" id="check-all"><span></span>
                                        </label>
                                    </th>
                                    <th class="text-center" style="width: 10%">会员</th>
                                    <th class="text-center" style="width: 20%">游戏类型</th>
                                    <th class="text-center" style="width: 5%">接口</th>
                                    <th class="text-center" style="width: 5%">笔数</th>
                                    <th class="text-center">有效投注金额</th>
                                    <th class="text-center" style="width: 20%">返水等级</th>
                                    <th class="text-center" style="width: 10%">返水比例</th>
                                    <th class="text-center" style="width: 15%">返水金额</th>
                                </tr>


                                </thead>

                                <tbody>

                                @if($gamerecords->count() && $data->count())
                                    @foreach ($data as $item)
                                        <tr>


                                            {{--
                                            <td>{{ $item->id }}</td>
                                            --}}

                                            @php
                                                $tz_valid = $gamerecords->where('member_id',$item->id)->sum('validBetAmount');
                                                $count = $gamerecords->where('member_id',$item->id)->count();
                                                //$fs_level = \App\Models\FsLevel::where('quota','<',$tz_valid)->where('game_type',$params['gameType'])->orderBy('level','desc')->first();
                                                $fs_level = \App\Models\FsLevel::where('lang',$item->lang)->memberMaxRate($item->id,$tz_valid,$params['gameType'])->first();

                                                $fs_money = $fs_level ? sprintf("%.2f",  $tz_valid * $fs_level->rate/100) : 0;
                                                // 合计
                                                $total_tz_amount += $fs_level ? $tz_valid : 0;
                                                $total_count += $fs_level ? $count : 0;
                                                $total_fs_money += $fs_money;

                                            @endphp

                                            @if($count && $fs_money)
                                                <td>
                                                    <label class="lyear-checkbox checkbox-primary">
                                                        <input type="checkbox" name="ids[]" value="{{ $item->id }}"><span></span>
                                                    </label>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ config('platform.game_type')[$params['gameType']] }}</td>
                                                <td>
                                                    {{ $params['api_name'] ?? '全部' }}
                                                </td>
                                                <td>
                                                    {{ $count }}
                                                </td>
                                                <td>
                                                    {{ $tz_valid }}
                                                </td>
                                                <td>{{ $fs_level->name ?? ''  }}</td>
                                                <td>{{ $fs_level->rate ?? 0 }}%</td>
                                                <td class="text-center"><input type="text" name="money[{{$item->id}}]"
                                                                               class="form-control"
                                                                               style="max-width: 80px;"
                                                                               value="{{ $fs_money }}"></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                                <tr>
                                    <td colspan="1"></td>
                                    <td><strong style="color: red">总合计</strong></td>
                                    <td colspan="2"></td>
                                    <td><strong style="color: red">{{ $total_count }}</strong></td>
                                    <td><strong style="color: red">{{ $total_tz_amount }}</strong></td>
                                    <td colspan="2"></td>
                                    <td><strong style="color: red">{{ $total_fs_money }}</strong></td>
                                </tr>
                            </table>
                        </div>

                        {{--
                        <div class="clearfix">
                            <div class="pull-left">
                                <p>总共 <strong style="color: red">{{ $data->total() }}</strong> 条</p>
                            </div>
                            <div class="pull-right">
                                {!! $data->appends($params)->render() !!}
                            </div>
                        </div>
                        --}}
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection

@section("footer-js")
    <script>
        //日期时间范围
        laydate.render({
            elem: '#created_at',
            type: 'datetime',
            max:'{{ date('Y-m-d',strtotime('-1 day')) }}', // 设置最大日期
            theme: "#33cabb",
            range: "~"
        });

    </script>
@endsection
