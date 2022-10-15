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

                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    @lang('res.quick.database_clean.top_notice')
                </div>

                <form class="form-horizontal" method="post" action="{{ route('admin.quick.post_database_clean') }}">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.member_name')</label>
                        <div class="col-sm-4">
                            <select name="member_id" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(\App\Models\Member::getMemberArray() as $key =>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="help-block" style="color: red;">
                                @lang('res.quick.database_clean.member_notice')
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.quick.database_clean.content')</label>
                        <div class="col-sm-10">

                            @php
                                $model_list = [
                                    get_class(app(\App\Models\Member::class)) => trans('res.quick.database_clean.member'),
                                    get_class(app(\App\Models\Agent::class)) => trans('res.quick.database_clean.agent'),
                                    get_class(app(\App\Models\AgentFdMoneyLog::class)) => trans('res.quick.database_clean.agent_fd_money_log'),
                                    get_class(app(\App\Models\AgentYjLog::class)) => trans('res.quick.database_clean.agent_yj_log'),
                                    get_class(app(\App\Models\Drawing::class)) => trans('res.quick.database_clean.drawing'),
                                    get_class(app(\App\Models\GameRecord::class)) => trans('res.quick.database_clean.game_record'),
                                    get_class(app(\App\Models\MemberMoneyLog::class)) => trans('res.quick.database_clean.member_money_log'),
                                    get_class(app(\App\Models\Recharge::class)) => trans('res.quick.database_clean.recharge'),
                                    get_class(app(\App\Models\Transfer::class)) => trans('res.quick.database_clean.transfer'),
                                    get_class(app(\App\Models\MemberLog::class)) => trans('res.quick.database_clean.member_log'),
                                    get_class(app(\App\Models\MemberWheel::class)) => trans('res.quick.database_clean.member_wheel'),
                                    get_class(app(\App\Models\DailyBonus::class)) => trans('res.quick.database_clean.daily_bonus'),
                                    get_class(app(\App\Models\MemberYuebaoPlan::class)) => trans('res.quick.database_clean.member_yuebao_plan'),
                                    get_class(app(\App\Models\CreditPayRecord::class)) => trans('res.quick.database_clean.credit_pay_record'),
                                    get_class(app(\App\Models\Activity::class)) => trans('res.quick.database_clean.activity'),
                                    get_class(app(\App\Models\ActivityApply::class)) => trans('res.quick.database_clean.activity_apply'),
                                ];
                            @endphp

                            <table class="table table-hover table-bordered table-cleans">
                                <thead>
                                <tr>
                                    <th>
                                        <label class="lyear-checkbox checkbox-primary">
                                            <input type="checkbox" id="check-all"><span></span>
                                        </label>
                                    </th>
                                    <th>
                                        @lang('res.quick.database_clean.content')
                                    </th>
                                    <th>
                                        @lang('res.quick.database_clean.oldest_date')
                                    </th>
                                    <th>
                                        @lang('res.quick.database_clean.latest_date')
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($model_list as $key => $val)
                                    <tr>
                                        <td>
                                            <label class="lyear-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{ $key }}"><span></span>
                                            </label>
                                        </td>
                                        <td class="clean-text">
                                            {{ $val }}
                                        </td>
                                        <td>
                                            @if($key::min('created_at'))
                                                {{ $key::min('created_at') }} （{{ trans('res.quick.database_clean.day_before',['date' => \Illuminate\Support\Carbon::parse($key::min('created_at'))->diffInDays()]) }}）
                                            @endif
                                        </td>
                                        <td>
                                            @if($key::max('created_at'))
                                                {{ $key::max('created_at') }} （{{ trans('res.quick.database_clean.day_before',['date' => \Illuminate\Support\Carbon::parse($key::max('created_at'))->diffInDays()]) }}）
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.quick.database_clean.day_field')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="days"
                                   value="30" required>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <div class="help-block">
                                @lang('res.quick.database_clean.day_notice')
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="confirm-btn" type="button">@lang('res.btn.save')</button>
                            <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@section('footer-js')
    <script>
        $('#confirm-btn').click(function() {
            var button = $(this);

            var models = [];

            models = $.utils.getBatchDeleteData();

            // 判断是否选中清理项
            if(models.length <= 0){
                $.utils.layerError('请先选择清理项');
                return;
            }

            models_text = '';

            Array.prototype.forEach.call($("input[name='ids[]']"), function(elem) {
                if ($(elem).val() && $(elem).prop("checked") == true) {
                    models_text += $(elem).closest('tr').find('.clean-text').html() + ','
                }
            });

            return layer.confirm('{{ trans('res.quick.database_clean.alert_before') }} <b style="color:red">' + models_text + '</b> {{ trans('res.quick.database_clean.alert_after') }}', {
                area: '30%',
                title: '{{ trans('res.quick.database_clean.alert_title') }}',
                btn: ['{{ trans('res.quick.database_clean.alert_1') }}','{{ trans('res.quick.database_clean.alert_2') }}'],
                yes:function(index,layero){
                    layer.close(index);
                    return true;
                    // $.utils.handleFormSubmit(button);
                },
                btn2:function(index,layero){
                    // return true;
                    $.utils.handleFormSubmit(button);
                }
            });
        })
    </script>
@endsection