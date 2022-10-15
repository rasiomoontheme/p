@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">{{ $_title }}</div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ route('admin.user.post_modify_pwd') }}" id="form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.modify_pwd.oldpassword')</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="oldpassword" value=""
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.modify_pwd.password')</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" value=""
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.modify_pwd.password_confirmation')</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password_confirmation" value=""
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
@endsection