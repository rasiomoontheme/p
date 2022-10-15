@extends('layouts.baseframe')

@section('title', $_title ?? '')
@section('content')
    <div class="col-sm-12 p-t-15">

        @if(!$model->top_id)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!! trans('res.member.modify_top.notice') !!}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>
            <div class="card-body">
                <form method="post" class="form-horizontal"
                      action="{{ route('admin.member.post_modify_top',['member' => $model->id]) }}" id="form">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.member.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $model->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.top_id')</label>
                        <div class="col-sm-4">
                            <select name="top_id" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(\App\Models\Member::getAgentArray() as $key =>$value)
                                    @if($key != $model->agent_id)
                                        <option value="{{ $key }}" @if($model->top_id == $key) selected @endif>{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
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