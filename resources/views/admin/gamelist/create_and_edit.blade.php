@extends('layouts.baseframe')
@php
    $isUpdated = isset($model->id);
    // $title = $isUpdated?"电子/棋牌游戏修改":"电子/棋牌游戏新增"

@endphp

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
                      action="{{ $isUpdated?route('admin.gamelists.update',['gamelist' => $model->id]):route('admin.gamelists.store') }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <input type="hidden" id="iframe_id" value="">

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_list.field.api_name')</label>
                        <div class="col-sm-4">
                            <select name="api_name" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(\App\Models\Api::getApiNameArray() as $key => $value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->api_name == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_list.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{ $isUpdated?$model->name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_list.field.en_name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="en_name"
                                   value="{{ $isUpdated?$model->en_name:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.game_type')</label>
                        <div class="col-sm-4">
                            <select name="game_type" class="form-control js_select2">
                                <option value="">@lang('res.common.select_default')</option>
                                @foreach(trans('res.option.game_type') as $key =>$value)
                                    <option value="{{ $key }}" @if($isUpdated && $model->game_type == $key) selected
                                            @elseif($key == 3) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_list.field.game_code')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="game_code"
                                   value="{{ $isUpdated?$model->game_code:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    {{--
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">TCG游戏类型</label>
                        <div class="col-sm-4">
                            <select name="tcg_game_type" class="form-control js_select2">
                                <option value="">--请选择--</option>
                                @foreach(config('platform.tcg_game_type') as $key =>$value)
                                <option value="{{ $key }}" @if($isUpdated && $model->tcg_game_type == $key) selected
                                    @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.param_remark')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="param_remark"
                                   value="{{ $isUpdated?$model->param_remark:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.img_path')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="img_path"
                                   value="{{ $isUpdated?$model->img_path:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.img_url')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="img_url"
                                   value="{{ $isUpdated?$model->img_url:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.client_type')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.client_type') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="client_type" @if($isUpdated && $model->client_type === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.platform')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="platform"
                                   value="{{ $isUpdated?$model->platform:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.game_list.field.is_open')</label>
                        <div class="col-sm-4">
                            @foreach(trans('res.option.is_open') as $k => $v)
                                <label class="lyear-radio radio-inline radio-primary"><input type="radio" value="{{ $k }}"
                                                                                             name="is_open" @if($isUpdated && $model->is_open === $k) checked @endif >
                                    <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.game_list.field.weight')</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="weight"
                                   value="{{ $isUpdated?$model->weight:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.game_list.field.tags')</label>
                        <div class="col-sm-4">
                            <select id="tags" name="tags[]" class="form-control js_select2" multiple="multiple">
                                {{-- <option value="">--请选择--</option> --}}
                                {{-- @if($isUpdated && $model->tags == $key) selected @endif --}}
                                @foreach(trans('res.option.tag_type') as $key =>$value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" data-operate="ajax-submit"
                                    type="button" data-select2="tags">@lang('res.btn.save')</button>
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

            if($("[name=id]")){
                $("#tags").val({!! json_encode($model->tags_array ?? []) !!}).trigger('change');
            }
            // $("[name='tags']").val(['0','2']).trigger('change');


        });

    </script>
@endsection
