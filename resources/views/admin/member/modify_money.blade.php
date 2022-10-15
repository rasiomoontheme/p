@extends('layouts.baseframe')

@section('title', $_title)
@section('content')
    <div class="col-sm-12 p-t-15">

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>
            <div class="card-body">

                <input type="hidden" id="iframe_id" value="">

                <form method="post" class="form-horizontal"
                      action="{{ route('admin.member.post_modify_money',['member' => $model->id]) }}" id="form">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.member.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $model->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.money')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ $model->money }}" readonly>
                        </div>
                        <label class="col-sm-2 control-label ">@lang('res.member.field.fs_money')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ $model->fs_money }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.total_money')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ app(\App\Models\GameRecord::class)->getMemberTotalValidBet($model->id) }}" readonly>
                        </div>
                        <label class="col-sm-2 control-label ">@lang('res.member.field.score')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ $model->score }}" readonly>
                        </div>

                        <label class="col-sm-2 control-label ">@lang('res.member.field.ml_money')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ $model->ml_money }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.total_credit')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ $model->total_credit }}" readonly>
                        </div>
                        <label class="col-sm-2 control-label ">@lang('res.member.field.used_credit')</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="{{ $model->used_credit }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.member_money_log.field.money_type')</label>
                        <div class="col-sm-4">
                            <select name="money_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.member_money_type') as $key =>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.member_money_log.field.number_type')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.money_number_type') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="number_type">
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group" id="ml-area">
                        <label class="col-sm-2 control-label">@lang('res.member.modify_money.is_add_ml')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.boolean') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="is_add_ml">
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                        <div class="col-sm-4 help-block">
                            @lang('res.member.modify_money.is_add_ml_notice')
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.member_money_log.field.money')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="money" value=""
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member_money_log.field.description')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="description"
                                   value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member_money_log.field.remark')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="remark"
                                   value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
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
        $(function(){
            initView();

            function initView(){
                $('#ml-area').hide();

                if($('[name="money_type"]').find("option:selected").attr("value") == 'money'
                    && $('[name="number_type"]:checked').val() === "1"){
                    $('#ml-area').show();
                }else{
                    $('#ml-area').hide();
                }
            }

            $('[name="money_type"]').change(function(){
                initView();
            });

            $('[name="number_type"]').click(function(){
                console.log('a');
                initView();
            });
        });
    </script>
@endsection
