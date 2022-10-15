@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">


        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            @if(!$user->google_secret)
                @lang('res.user.google.first_notice')
            @else
                @lang('res.user.google.reset_notice')
            @endif
        </div>

        <div class="card">
            <div class="card-header">{{ $_title }}</div>
            <div class="card-body">

                <form method="post" class="form-horizontal" action="{{ route('admin.user.post_google') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="name"
                                   value="{{ $user->name }}" readonly>
                        </div>
                    </div>

                    @if($is_save)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.user.google.scan_qrcode')</label>
                            <div class="col-sm-4">
                                <img src="{{ $img_url }}">
                                <input type="hidden" required class="form-control" name="google_secret"
                                       value="{{ $secret }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('res.user.field.google_secret')</label>
                            <div class="col-sm-4">
                                <input type="number" required class="form-control" name="code"
                                       value="">
                            </div>
                            <div class="col-sm-4">
                                <div class="help-block">
                                    @lang('res.user.google.secret_notice')
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            {{-- 重新绑定 提交绑定 --}}
                            @if(!$is_save)
                                {{--<a class="btn btn-primary" href="{{ route('admin.user.google',['is_save' => 1]) }}">重新绑定</a>--}}
                            @else
                                <button class="btn btn-primary" data-operate="ajax-submit" type="button">@lang('res.user.google.submit')</button>
                            @endif
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
@endsection