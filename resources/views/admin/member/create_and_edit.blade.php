@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
@endphp

@section('title', $_title ?? '')

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
                      action="{{ $isUpdated?route('admin.members.update',['member' => $model->id]):route('admin.members.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.member.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $isUpdated?$model->name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label @if(!$isUpdated) required @endif">@lang('res.member.field.password')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="password"
                                   value="" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    @if($isUpdated)
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.original_password')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="original_password"
                                       value="{{ $isUpdated?$model->original_password:"" }}" @if(!$isUpdated) required @endif
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.o_password')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="o_password"
                                       value="{{ $isUpdated?$model->o_password:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.nickname')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nickname"
                                   value="{{ $isUpdated?$model->nickname:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.realname')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="realname"
                                   value="{{ $isUpdated?$model->realname:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.email')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email"
                                   value="{{ $isUpdated?$model->email:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.phone')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="phone"
                                   value="{{ $isUpdated?$model->phone:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.qq')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="qq"
                                   value="{{ $isUpdated?$model->qq:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Line</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="line"
                                   value="{{ $isUpdated?$model->line:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">FaceBook</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="facebook"
                                   value="{{ $isUpdated?$model->facebook:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.gender')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.gender') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="gender" @if($isUpdated && $model->gender === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.lang')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2" @if($isUpdated) disabled @endif>
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.lang_select') as $k => $v)
                                    <option value="{{ $k }}" @if($isUpdated && $model->lang == $k) selected
                                            @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if($isUpdated)

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.level')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="level" readonly
                                       value="{{ $isUpdated?$model->level:"" }}" @if(!$isUpdated) required @endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.invite_code')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="invite_code"
                                       value="{{ $isUpdated?$model->invite_code:"" }}" @if(!$isUpdated) required @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.qk_pwd')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="qk_pwd"
                                       value="{{ $isUpdated?$model->qk_pwd:"" }}" @if(!$isUpdated) required @endif>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.money')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="money"
                                       value="{{ $isUpdated?$model->money:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.fs_money')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="fs_money"
                                       value="{{ $isUpdated?$model->fs_money:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.total_money')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="total_money"
                                       value="{{ $isUpdated?$model->total_money:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.member.field.ml_money')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="ml_money"
                                       value="{{ $isUpdated?$model->ml_money:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.score')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="score"
                                       value="{{ $isUpdated?$model->score:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.total_credit')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="total_credit" readonly
                                       value="{{ $isUpdated?$model->total_credit:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.used_credit')</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="used_credit"
                                       value="{{ $isUpdated?$model->used_credit:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.register_ip')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="register_ip"
                                       value="{{ $isUpdated?$model->register_ip:"" }}" @if(!$isUpdated) required @endif readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.member.field.is_demo')</label>
                            <div class="col-sm-4">
                                @foreach(trans('res.option.boolean') as $k => $v)
                                    <label class="lyear-radio radio-inline radio-primary">
                                        <input type="radio" value="{{ $k }}" name="is_demo" @if($isUpdated && $model->is_demo === $k) checked @endif disabled>
                                        <span>{{ $v }}</span></label>
                                @endforeach
                            </div>
                        </div>

                    @endif
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.status')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.member_status') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="status" @if($isUpdated && $model->status === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label ">是否登录</label>
                        <div class="col-sm-4">
                            @foreach(config('platform.boolean') as $k => $v)
                            <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                    name="is_login" @if($isUpdated && $model->is_login === $k) checked @endif >
                    <span>{{ $v }}</span></label>
                    @endforeach
            </div>
        </div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.is_tips_on')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.boolean') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}" name="is_tips_on"
                                                                                             @if($isUpdated && $model->is_tips_on === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                        <div class="col-sm-4">
            <span class="help-block">
                @lang('res.member.edit.is_tips_on_notice')
            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.member.field.is_in_on')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.boolean') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}" name="is_in_on"
                                                                                             @if($isUpdated && $model->is_in_on === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                        <div class="col-sm-4">
            <span class="help-block">
                @lang('res.member.edit.is_in_on_notice')
            </span>
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


        });

    </script>
@endsection
