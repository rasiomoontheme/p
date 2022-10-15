@extends('layouts.baseframe')

@php
    $isUpdated = isset($model->id);
@endphp

{{--
@php
$isUpdated = isset($model->id);
$title = $isUpdated?"代理修改":"代理新增";

if($isUpdated){
$member = $model->member;
}
@endphp
--}}
@section('title', $_title)

@section('content')
    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h4>{{ $_title }}</h4>

                @if($isUpdated)
                    <ul class="card-actions">
                        <li>
                            <button type="button" onclick="javascript:window.history.go(-1);">
                                <i class="mdi mdi-skip-backward"></i> @lang('res.btn.back')
                            </button>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ $isUpdated?route('admin.agents.update',['agent' => $model->id]):route('admin.agents.post_assign',['member' => $member->id]) }}"
                      id="form">

                    @csrf

                    @if($isUpdated)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $model->id }}">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.agent.field.member_id')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="member_id"
                                   value="{{ $member->id }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.member.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $member->name }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.agent.field.agent_pc_uri')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="agent_pc_uri"
                                   value="{{ $isUpdated?$model->agent_pc_uri:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label required">@lang('res.agent.field.agent_wap_uri')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="agent_wap_uri"
                                   value="{{ $isUpdated?$model->agent_wap_uri:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>

                    {{--
                    <div class="form-group">
                        <label class="col-sm-2 control-label required">代理链接</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="agent_uri" placeholder="请输入代理链接"
                                value="{{ $isUpdated?$model->agent_uri:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">代理链接前缀</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="agent_uri_pre" placeholder="请输入代理链接前缀"
                                value="{{ $isUpdated?$model->agent_uri_pre:"" }}" @if(!$isUpdated) required @endif>
                        </div>
                    </div>
                    --}}

                    @if($isUpdated && $model->apply_data)
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">@lang('res.agent.field.apply_data')</label>
                            <div class="col-sm-4">

                                <table class="table table-hover table-bordered">
                                    <tbody>
                                    @foreach (json_decode($model->apply_data,1) as $key => $item)
                                        @if(!in_array($key,['member_id','status']))
                                            <tr>
                                                {{--<td width="30%">{{ App\Models\MemberAgentApply::$list_field[$key]['name'] }}</td>--}}
                                                <td width="30%">{{ \Illuminate\Support\Arr::get(trans('res.member_agent_apply.field'),$key) }}</td>
                                                <td>{{ $item }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if($is_delete)
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.agent.field.assign_type')</label>
                            <div class="col-sm-4">
                                <select name="assign_type" class="select2 form-control">
                                    <option value="">@lang('res.common.select_default')</option>
                                    {{--@foreach(config('platform.agent_assign_types') as $key => $value)--}}
                                    @foreach(trans('res.option.agent_assign_types') as $key => $value)
                                        <option value="{{ $key }}">{{ $value  }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="help-block" style="color: red">
                                @lang('res.agent.assign.notice')
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">@lang('res.agent.field.remark')</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remark"
                                   value="{{ $isUpdated?$model->remark:"" }}" @if(!$isUpdated) required @endif>
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
    {{--<script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>--}}
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>
        $(function () {



        });

    </script>
@endsection
