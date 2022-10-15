@extends('layouts.baseframe')

@php
    $title = trans('res.member.index.register_setting');
@endphp

@section('title', $title)

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.member.post_register_setting') }}" method="post" id="searchForm" name="searchForm"
                  class="form-horizontal">

                @foreach(config('platform.register_setting_field') as $key => $val)
                    @php
                        $isopen = \Illuminate\Support\Arr::get($data,$key,1)
                    @endphp

                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ trans('res.option.register_setting_field')[$key] }}</label>
                        <div class="col-sm-4 switch-col">
                            <label class="lyear-switch switch-solid switch-primary">
                                <input type="checkbox" name="{{ $key }}" value="{{ $isopen }}" @if($isopen) checked @endif>

                                @if(!$isopen)
                                    <input type="hidden" name="{{ $key }}" value="{{ $isopen }}">
                                @endif
                                <span></span>
                            </label>
                        </div>
                    </div>
                @endforeach

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
                        <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection