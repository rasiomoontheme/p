@extends('layouts.baseframe')

@php
    $title = '系统语言';
@endphp

@section('title', $title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body">

                <form method="post" class="form-horizontal" action="{{ route('admin.user.post_lang') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">语言/Language</label>
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
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button">保存内容</button>
                            <button class="btn btn-default" type="reset">重置</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection