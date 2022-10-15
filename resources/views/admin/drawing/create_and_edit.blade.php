@extends('layouts.baseframe')
@php
    $isSuccess = $status == App\Models\Drawing::STATUS_SUCCESS;
    // $title = $isSuccess ? "审核通过":"审核不通过";
@endphp

@section('title', $_title)

@section('content')
    <div class="col-sm-12 p-t-15">

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>
            <div class="card-body">
                <input type="hidden" id="iframe_id" value="">
                <form method="post" class="form-horizontal" action="{{ $isSuccess ? route('admin.drawings.post_confirm',['drawing' => $model->id])
                : route('admin.drawings.post_reject',['drawing' => $model->id]) }}" id="form">

                    @csrf
                    <input type="hidden" name="id" value="{{ $model->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.member_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $model->member->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.drawing.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $model->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.drawing.field.money')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" value="{{ $model->money }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.drawing.field.account')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="account"
                                   value="{{ $model->account }}" readonly>
                        </div>
                        <div class="col-sm-4 help-block">
                            {{ isset_and_not_empty(json_decode($model->member_bank_info,1),'bank_type_text') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.drawing.field.counter_fee')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="counter_fee"
                                   value="{{ $model->counter_fee }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.drawing.field.member_remark')</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="member_remark" cols="30" rows="3" readonly>{{ $model->member_remark }}</textarea>
                        </div>
                    </div>



                    @if(!$isSuccess)
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.drawing.field.fail_reason')</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="fail_reason" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    @endif


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

        });

    </script>
@endsection
