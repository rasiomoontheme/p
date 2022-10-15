@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>@lang('res.send_agent.msg.top_notice')</strong>
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
                            'created_at' => ['name' => trans('res.agent_yj_log.field.created_at'),'type' => 'datetime'],
                            'agent_id' => ['name' => trans('res.common.agent_id'),'type' => 'select','data' => \App\Models\Member::getAgentArray()],
                            'lang' => ['name' => trans('res.yj_level.field.lang'),'type' => 'select','data' => config('platform.lang_select')],
                            ]
                        ])


                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">@lang('res.btn.search')</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">@lang('res.btn.reset')
                                </button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        <div class="card">

            <form method="post" action="{{ route('admin.sendagent.store')  }}">

                <input type="hidden" name="created_at" value="{{ isset_and_not_empty($params,'created_at','') }}">

                <div class="card-toolbar clearfix">
                    <div class="toolbar-btn-action">

                        <button class="btn btn-primary m-r-5" data-operate="ajax-submit">
                            <i class="mdi mdi-coin"></i>
                            @lang('res.agent_yj_log.field.send_yj')
                        </button>

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <style>
                            .tr{background:#3C4D82;color:#ffffff;text-align: center}
                        </style>

                        <table class="table table-bordered table-hover text-center">
                            <tr>
                                <td colspan="19">@lang('res.agent_yj_log.field.top_title')</td>
                            </tr>

                            <tr>

                                <td rowspan="2">
                                    <label class="lyear-checkbox checkbox-primary">
                                        <input type="checkbox" id="check-all"><span></span>
                                    </label>
                                </td>

                                <td rowspan="2">@lang('res.common.agent_id')</td>
                                <td rowspan="2">@lang('res.agent_yj_log.field.offline')</td>
                                <td rowspan="2">@lang('res.agent_yj_log.field.balance')</td>
                                <td colspan="2">@lang('res.agent_yj_log.field.transfer')</td>
                                <td colspan="3">@lang('res.agent_yj_log.field.bonus')</td>
                                {{--<td rowspan="2">其他情况</td>--}}
                                <td rowspan="2">@lang('res.agent_yj_log.field.last_at')</td>
                                <td rowspan="2">@lang('res.agent_yj_log.field.money')</td>
                                <td rowspan="2">@lang('res.agent_yj_log.field.remark')</td>
                                <td rowspan="2">@lang('res.common.operate')</td>
                            </tr>
                            <tr>
                                <td>@lang('res.agent_yj_log.field.deposit')</td>
                                <td>@lang('res.agent_yj_log.field.withdraw')</td>
                                <td>@lang('res.agent_yj_log.field.activity')</td>
                                <td>@lang('res.agent_yj_log.field.rebate')</td>
                                <td>@lang('res.agent_yj_log.field.other')</td>
                            </tr>

                            @foreach($data as $item)
                                @php
                                    $searchDate = [];
                                    $confirmDate = [];
                                    if(array_key_exists('created_at',$params)){
                                        $searchDate = convertDateToArray($params['created_at'],'created_at');
                                        $confirmDate = convertDateToArray($params['created_at'],'confirm_at');
                                    }

                                    $lang = $params['lang'];

                                    // 获取活跃用户列表
                                    $m_list = $item->getActiveChildIds($lang)->pluck('id');

                                    $recharge_money = \App\Models\Recharge::where('status',\App\Models\Recharge::STATUS_SUCCESS)->whereIn('member_id',$m_list)->where($confirmDate)->sum('money');

                                    $drawing_money = \App\Models\Drawing::where('status',\App\Models\Drawing::STATUS_SUCCESS)->whereIn('member_id',$m_list)->where($confirmDate)->sum('money');

                                    // 活动赠送
                                    $dividend_money_1 = \App\Models\MemberMoneyLog::whereIn('member_id',$m_list)->where($searchDate)->activityMoney()->sum('money');
                                    // 反水
                                    $dividend_money_2 = \App\Models\MemberMoneyLog::whereIn('member_id',$m_list)->where($searchDate)->where('operate_type',\App\Models\MemberMoneyLog::OPERATE_TYPE_FANSHUI)->sum('money');
                                    // 其它
                                    $dividend_money_3 = \App\Models\MemberMoneyLog::whereIn('member_id',$m_list)->where($searchDate)->otherMoney()->sum('money');

                                    // 总收益
                                    $total_sy_money = $recharge_money - $drawing_money - $dividend_money_1 - $dividend_money_2 - $dividend_money_3;

                                    // 获取活跃下线的人数
                                    $active_num = \App\Models\Recharge::where('status',\App\Models\Recharge::STATUS_SUCCESS)->whereIn('member_id',$m_list)->where($confirmDate)->select(\DB::raw('sum(money) as user_count'))->groupBy('member_id')->having('user_count', '>=', systemconfig('daili_active_money') ?? 0)->get()->count();

                                    // 根据收益，member判断佣金等级
                                    $yjlevel = \App\Models\YjLevel::getYjLevel($active_num,$total_sy_money,$lang);

                                    $rate = $yjlevel ? $yjlevel->rate : 0;
                                @endphp

                                <tr>
                                    <td>
                                        <label class="lyear-checkbox checkbox-primary">
                                            <input type="checkbox" name="ids[]" value="{{ $item->id }}"><span></span>
                                            <input type="hidden" name="yl_money[{{ $item->id }}]" value="{{ $total_sy_money }}">
                                        </label>
                                    </td>
                                    <td>{{ $item->name  }}</td>
                                    <td>{{ count($m_list)  }}</td>
                                    <td>{{ $item->getActiveChildIds($lang)->sum('money') }}</td>
                                    <td>
                                        {{ $recharge_money }}
                                    </td>
                                    <td>
                                        {{ $drawing_money }}
                                    </td>
                                    <td>
                                        {{ $dividend_money_1 }}
                                    </td>
                                    <td>
                                        {{ $dividend_money_2 }}
                                    </td>
                                    <td>
                                        {{ $dividend_money_3 }}
                                    </td>
                                    <td>
                                        {{ $item->agent->yjlogs->sortByDesc('created_at')->first()->created_at ?? '-' }}
                                    </td>
                                    <td>
                                        <input type="number" data-test="{{$total_sy_money}}" data-rate="{{$rate}}" class="form-control" name="money[{{ $item->id }}]" value="{{ ($total_sy_money*$rate)/100 }}" style="max-width: 80px;">
                                    </td>
                                    <td>
                                        <textarea name="remark[{{ $item->id }}]"  rows="2" class="form-control"></textarea>
                                    </td>
                                    <td>
                                        <button type="button" data-title="@lang('res.agent_yj_log.field.history',['name' => $item->name])" data-url="{{ route('admin.agentyjlog.history',['agent' => $item->agent_id])  }}" data-operate="iframe-page" class="btn btn-info btn-xs show-cate">@lang('res.agent_yj_log.field.record')</button>
                                    </td>
                                </tr>
                            @endforeach
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
            </form>
        </div>

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
