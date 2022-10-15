@extends('layouts.baseframe')

@php
    $isUpdated = isset($model->id);
    $title = $isUpdated?"Cập nhật quyền":"Tạo mới quyền"
@endphp

@section('title', $title ?? '')

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i>Quay lại
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ $isUpdated?route('admin.permissions.update',['permission' => $model->id]):route('admin.permissions.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tên quyền</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="name" placeholder="Vui lòng nhập tên quyền"
                                   value="{{ $isUpdated?$model->name:"" }}" @if($isUpdated) readonly @endif>
                        </div>
                    </div>

                    @foreach(config('platform.language_type') as $k => $v)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tên quyền[{{$v}}]</label>
                            <div class="col-sm-4">
                                <input type="text" required class="form-control" name="lang_json[{{ $k }}]" placeholder="Vui lòng nhập tên quyền[{{$v}}]"
                                       value="{{ $isUpdated ? $model->getLangName($k):"" }}">
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Biểu tượng</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="icon" placeholder="Vui lòng nhập một biểu tượng"
                                   value="{{ $isUpdated?$model->icon:"" }}" @if(!$isUpdated) required @endif
                                   data-operate="select-icon" data-target="#functions">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tên tuyến đường</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="route_name" placeholder="Vui lòng nhập tên tuyến đường" value="{{ $isUpdated?$model->route_name:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Menu cha</label>
                        <div class="col-sm-4">
                            <select class="form-control m-b js_select2" name="pid">
                                <option value="0">Vui lòng chọn menu cha...</option>
                                {!! $html !!}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Có hiển thị không</label>
                        <div class="col-sm-4">
                            @foreach(\App\Models\Permission::$isShowMap as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_show" @if($isUpdated && $model->is_show === $k) checked @endif > <span>{{ $v }}
                                / {{$k}}</span></label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Trọng lượng</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight" placeholder="Vui lòng nhập trọng lượng"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="description" placeholder="Vui lòng nhập mô tả"
                                   value="{{ $isUpdated?$model->description:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nhận xét</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark" placeholder="Vui lòng nhập nhận xét"
                                   value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit" type="button">Lưu nội dung</button>
                            <button class="btn btn-default" type="reset">Đặt lại</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
