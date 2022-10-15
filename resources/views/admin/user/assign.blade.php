@extends('layouts.baseframe')

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
                      action="{{ route('admin.users.post_assign',['user' => $user->id]) }}"
                      id="form">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="name"
                                   value="{{ $user->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.assign.role')</label>
                        <div class="col-sm-4">
                            @foreach ($roles as $role)
                                <input type="checkbox" class="checkbox-primary" value="{{ $role->id }}" name="roles[]" @if(in_array($role->id,$user->roles->pluck("id")->toArray())) checked="checked" @endif>{{ $role->name}}
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
    </div>
@endsection