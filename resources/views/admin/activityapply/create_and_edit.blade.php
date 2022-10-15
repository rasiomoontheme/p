@extends('layouts.baseframe')
@php
    $title = $status == App\Models\ActivityApply::STATUS_ENSURE ? trans('res.activity_apply.edit.title_confirm') : trans('res.activity_apply.edit.title_reject');
@endphp

@section('title', $title ?? '')

@section('content')
    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            @lang('res.activity_apply.edit.top_notice')
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                {{-- <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i>返回
                        </button>
                    </li>
                </ul> --}}
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ route('admin.activityapplies.post_confirm',['activityapply' => $model->id,'status' => $status]) }}"
                      id="form">

                    <input type="hidden" id="iframe_id" value="">

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.common.member_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control"
                                   value="{{ $model->member->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.activity.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control"
                                   value="{{ $model->activity->title }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.activity_apply.field.data_content')</label>
                        <div class="col-sm-4">

                            <table class="table table-hover table-bordered">
                                <tbody>
                                @foreach (json_decode($model->data_content,1) as $key => $item)

                                    <tr>
                                        <td width="30%">{{ \Illuminate\Support\Arr::get(trans('res.option.activity_apply_field'),$key) }}</td>
                                        <td>{{ $item }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.activity_apply.field.status')</label>
                        <div class="col-sm-4">
                            <select name="status" class="form-control js_select2" disabled>
                                @foreach(trans('res.option.activity_apply_status') as $key =>$value)
                                    <option value="{{ $key }}" @if($status == $key) selected
                                            @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.activity_apply.field.remark')</label>
                        <div class="col-sm-4">
                            <textarea name="remark" class="form-control" cols="30" rows="4"></textarea>
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
    {{-- <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script> --}}
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {



        });

    </script>
@endsection
