@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"体育比赛修改":"体育比赛新增"
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
                      action="{{ $isUpdated?route('admin.sports.update',['sport' => $model->id]):route('admin.sports.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.home_team_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="home_team_name"
                                   value="{{ $isUpdated?$model->home_team_name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.home_team_name_en')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="home_team_name_en"
                                   value="{{ $isUpdated?$model->home_team_name_en:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.home_team_img')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="home_team_img"
                                   value="{{ $isUpdated?$model->home_team_img:"" }}" @if(!$isUpdated) required
                                    @endif>
                        </div>
                    </div>
                    <div class="form-group" id="upload-area">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="home_team_img"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'sport']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                @if($isUpdated) data-image-url="{{ $model->home_team_img }}" @endif>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.home_odds')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="home_odds"
                                   value="{{ $isUpdated?$model->home_odds:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.visiting_team_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="visiting_team_name"
                                   value="{{ $isUpdated?$model->visiting_team_name:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.visiting_team_name_en')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="visiting_team_name_en"
                                   value="{{ $isUpdated?$model->visiting_team_name_en:"" }}"
                                   @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.visiting_team_img')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="visiting_team_img"
                                   value="{{ $isUpdated?$model->visiting_team_img:"" }}" @if(!$isUpdated) required
                                    @endif>
                        </div>
                    </div>
                    <div class="form-group" id="upload-area">
                        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
                        <div class="col-sm-8">
                            <ul class="list-inline clearfix lyear-uploads-pic" id="visiting_team_img"
                                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'sport']) }}"
                                data-delete-url="{{ route('attachment.delete') }}"
                                @if($isUpdated) data-image-url="{{ $model->visiting_team_img }}" @endif>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.visiting_odds')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="visiting_odds"
                                   value="{{ $isUpdated?$model->visiting_odds:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.let_ball')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="let_ball"
                                   value="{{ $isUpdated?$model->let_ball:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.match_cup')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="match_cup"
                                   value="{{ $isUpdated?$model->match_cup:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.match_cup_en')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="match_cup_en"
                                   value="{{ $isUpdated?$model->match_cup_en:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.match_at')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="match_at"
                                   value="{{ $isUpdated?$model->match_at:"" }}" @if(!$isUpdated) required @endif readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.sport.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.boolean') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" value="{{ $k }}" name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.sport.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
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

            //日期时间范围
            laydate.render({
                elem: '[name="match_at"]',
                type: 'datetime',
                theme: "#33cabb",
                // range: "~"
            });

            // 单图上传
            $('#home_team_img').imageUpload({
                $callback_input: $('.form-control[name="home_team_img"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });
            // 单图上传
            $('#visiting_team_img').imageUpload({
                $callback_input: $('.form-control[name="visiting_team_img"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });
        });

    </script>
@endsection