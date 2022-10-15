@extends('layouts.baseframe')

@php
    // $title = 'APP内容设置'
@endphp

@section('title', $_title)

@section('content')

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h4>{{ trans('res.configs.vip1_lang_default') }}</h4>
            </div>

            <div class="card-body">
                <form method="post" class="form-horizontal"
                      action="{{ route('admin.systemconfigs.post_lang_default') }}"
                      id="form">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">{{ trans('res.configs.vip1_lang_default') }}</label>
                        <div class="col-sm-4">
                            <select name="default" class="form-control js_select2">
                                <option value="{{ $default }}">@lang('res.common.select_default')</option>
                                @foreach($fields as $key => $val)
                                    <option value="{{ $key }}" @if($key == $default) selected @endif>{{ $val }}</option>
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



        <div class="card">

            <div class="card-header">
                <h4>{{ trans('res.configs.vip1_lang_fields') }}</h4>
            </div>

            <div class="card-body">
                <form method="post" class="form-horizontal"
                      action="{{ route('admin.systemconfigs.post_lang_fields') }}"
                      id="form">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">{{ trans('res.configs.vip1_lang_fields') }}</label>
                        <div class="col-sm-8">
                            @foreach($config as $key => $val)
                                <label class="lyear-checkbox checkbox-primary checkbox-inline">
                                    <input name="fields[]" type="checkbox" value="{{ $key }}"
                                           @if(in_array($key,array_keys($fields))) checked="checked" @endif>
                                    <span>{{ $val }}</span>
                                </label>
                            @endforeach
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

        <div class="card">

            <div class="card-header">
                <h4>Ngôn ngữ hệ thống</h4>
            </div>

            <div class="card-body">
                <form method="post" class="form-horizontal" action="{{ route('admin.user.post_lang') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.common.lang_title')</label>
                        <div class="col-sm-4">
                            <select name="lang" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(config('platform.language_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($user->lang == $key) selected @endif>
                                        {{ $value }}</option>
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
