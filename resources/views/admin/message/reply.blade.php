@extends('layouts.baseframe')
@php
    // $title = "站内信回复";
@endphp
@section('title', $_title)

<div class="col-sm-12 p-t-15">

    <div class="card">
        <div class="card-header">
            <h4>{{ $_title }}</h4>
        </div>
        <div class="card-body">

            <input type="hidden" id="iframe_id" value="">

            <form method="post" class="form-horizontal"
                  action="{{ route('admin.messages.post_reply',['message' => $model->id]) }}" id="form">

                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('res.member_message.field.title')</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="{{ $model->title }}"
                               readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('res.member_message.field.content')</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" cols="30" rows="4" readonly>{{ $model->content }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label required">@lang('res.member_message.field.reply_title')</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="title" value=""
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label required">@lang('res.member_message.field.reply_content')</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="content" cols="30" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">@lang('res.message.field.url')</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="url" value=""
                               required>
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

@section('content')
@endsection
