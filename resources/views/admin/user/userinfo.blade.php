@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">{{ $_title }}</div>
            <div class="card-body">

                <form method="post" class="form-horizontal" action="">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="name"
                                   value="{{ $user->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.field.create_ip')</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="create_ip"
                                   value="{{ $user->create_ip }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.user.field.status')</label>
                        <div class="col-sm-4">
                            <select name="status" class="form-control js_select2" disabled>
                                <option value="">--@lang('res.common.select_default')--</option>
                                @foreach(trans('res.user.status') as $key =>$value)
                                    <option value="{{ $key }}" @if($user->status == $key) selected @endif>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection