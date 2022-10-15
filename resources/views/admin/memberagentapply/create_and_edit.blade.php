@extends('layouts.baseframe')


@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i> @lang('res.btn.back')
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ route('admin.memberagentapplies.update',['memberagentapply' => $model->id]) }}"
                      id="form">

                    @csrf

                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $model->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.member_agent_apply.field.member_id')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="member_id"
                                   value="{{ $model->member_id }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.member_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $model->member->name ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member_agent_apply.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $model->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member_agent_apply.field.email')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email"
                                   value="{{ $model->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member_agent_apply.field.msn_qq')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="msn_qq"
                                   value="{{ $model->msn_qq }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member_agent_apply.field.reason')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="reason"
                                   value="{{ $model->reason }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.member_agent_apply.field.status')</label>
                        <div class="col-sm-4">
                            <select name="status" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.apply_status') as $key =>$value)
                                    <option value="{{ $key }}" @if($model->status == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group" id="fail_reason" style="display:none;">
                        <label class="col-sm-2 control-label required">@lang('res.member_agent_apply.field.fail_reason')</label>
                        <div class="col-sm-4">
                            <textarea name="fail_reason" id="" cols="30" rows="3" class="form-control"></textarea>
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
        $(function () {

            $("[name='status']").change(function(){
                var statusSelect = $(this);
                if(statusSelect.find("option:selected").attr("value") == 2){
                    $('#fail_reason').show();
                }else{
                    $('#fail_reason').hide();
                }
            });

        });

    </script>
@endsection
