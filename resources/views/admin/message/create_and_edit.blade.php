@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"站内信修改":"站内信新增";
    $member_list = \App\Models\Member::query()->normal()->get()->pluck('name','id');
    // dd($title)
@endphp

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
                      action="{{ $isUpdated?route('admin.messages.update',['message' => $model->id]):route('admin.messages.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.message.field.visible_type')</label>
                        <div class="col-sm-4">
                            <select name="visible_type" class="form-control js_select2" @if($isUpdated) disabled @endif>
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.message_visible_type') as $key =>$value)
                                    @if($key != \App\Models\Message::VISIBLE_TYPE_ADMIN)
                                        <option value="{{ $key }}" @if($isUpdated && $model->visible_type == $key) selected
                                                @endif>{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="display:none" id="member-input">
                        <label class="col-sm-2 control-label required">@lang('res.common.member_name')</label>
                        <div class="col-sm-4">
                            <select name="member_id" class="form-control js_select2" @if($isUpdated) disabled @endif>
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach($member_list as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->member_id == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>

                            {{-- <input type="number" class="form-control" name="member_id" placeholder="请输入会员id"
                                value="{{ $isUpdated?$model->member_id:"" }}" @if(!$isUpdated) required @endif> --}}
                        </div>
                    </div>

                    <div class="form-group" style="display:none" id="allmember-input">
                        <label class="col-sm-2 control-label required">@lang('res.common.lang')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2" @if($isUpdated) disabled @endif>
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.language_type') as $k => $v)
                                    <option value="{{ $k }}" @if($isUpdated && $model->lang == $k) selected
                                            @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label ">上条消息ID</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="pid" placeholder="请输入上条消息ID"
                                value="{{ $isUpdated?$model->pid:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.message.field.title')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="title" value="{{ $isUpdated?$model->title:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.message.field.url')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="url"
                                   value="{{ $isUpdated?$model->url:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.message.field.content')</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="content" cols="30" rows="4">{{ $isUpdated?$model->content:"" }}</textarea>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label required">发送类型</label>
                        <div class="col-sm-4">
                            <select name="send_type" class="form-control js_select2">
                                <option value="">--请选择--</option>
                                @foreach(config('platform.message_send_type') as $key =>$value)
                                <option value="{{ $key }}"
                                    @if($isUpdated && $model->send_type == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

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

            function checkIsSingle(){
                var statusSelect = $("[name='visible_type']");
                if(statusSelect.find("option:selected").attr("value") == {{ App\Models\Message::VISIBLE_TYPE_MEMBER }}){
                    $('#member-input').show();
                    $('#allmember-input').hide();
                }else if(statusSelect.find("option:selected").attr("value") == {{ App\Models\Message::VISIBLE_TYPE_ALL }}){
                    $('#member-input').hide();
                    $('#allmember-input').show();
                }else{
                    $('#member-input').hide();
                    $('#allmember-input').hide();
                }
            }

            checkIsSingle();

            $("[name='visible_type']").change(function(){
                checkIsSingle();
            });

        });

    </script>
@endsection
