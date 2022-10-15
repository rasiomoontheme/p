@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#searchContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> @lang('res.btn.collapse')
                        </button>
                    </li>
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body collapse in" id="searchContent" aria-expanded="true">
                <form action="" method="get" id="searchForm" name="searchForm">
                    <div class="row">
                        @include('layouts._search_field',
                        [
                        'list' => [
                            'created_at' => ['name' => trans('res.common.created_at'),'type' => 'datetime'],
                            'visible_type' => ['name' => trans('res.message.field.visible_type'),'type' => 'select','data' => config('platform.message_visible_type')],
                            //'send_type' => ['name' => '发送类型','type' => 'select','data' => config('platform.message_send_type')]
                            ]
                        ])

                        <div class="col-lg-2 col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">@lang('res.btn.search')</button>&nbsp;
                                <button type="reset" class="btn btn-warning"
                                        onclick="document.searchForm.reset()">@lang('res.btn.reset')</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-toolbar clearfix">
                <div class="toolbar-btn-action">
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.messages.create") }}"><i
                                class="mdi mdi-plus"></i>
                        @lang('res.btn.add')</a>
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/messages/ids">
                        <i class="mdi mdi-window-close"></i> @lang('res.btn.delete')
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <label class="lyear-checkbox checkbox-primary">
                                    <input type="checkbox" id="check-all"><span></span>
                                </label>
                            </th>
                            <th>@lang('res.message.index.visible_member')</th>
                            @include('layouts._table_header',['data' => \App\Models\Message::$list_field, 'model' => 'message'])

                            {{-- <th width=100>@lang('res.common.updated_at')</th> --}}
                            <th width=100>@lang('res.member.field.status')</th>
                            <th width=100>@lang('res.common.created_at')</th>
                            <th>@lang('res.common.operate')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    <label class="lyear-checkbox checkbox-primary">
                                        <input type="checkbox" name="ids[]" value="{{ $item->id }}"><span></span>
                                    </label>
                                </td>
                                <th>
                                    @if($item->member)
                                        @include("layouts._member_dropmenus",['member' => $item->member])
                                    @else
                                        '@lang('res.message.index.all_member')'
                                    @endif
                                    {{--{{ $item->member->name ?? '所有会员' }}--}}
                                </th>
                                @include('layouts._table_body',['data' => \App\Models\Message::$list_field,'item' => $item])
                                {{-- <td>{{ $item->updated_at }}</td> --}}
                                <td>
                                    @if($item->visible_type == \App\Models\Message::VISIBLE_TYPE_MEMBER)
                                        {{ \Illuminate\Support\Arr::get(trans('res.option.is_read'),$item->member_message->first()->is_read ?? 0) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.messages.edit',['message' => $item->id]) }}" title=""
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.detail')"
                                           data-url="{{ route('admin.messages.show', ['message' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="iframe-page"
                                            data-toggle="tooltip" data-original-title="消息回复" data-title="更改会员余额"
                                            data-url="{{ route('admin.member.modify_money', ['member' => $item->id]) }}">
                                            <i class="mdi mdi-coin"></i>
                                        </a> --}}

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.messages.destroy', ['message' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="clearfix">
                    <div class="pull-left">
                        <p>@lang('res.common.total') <strong style="color: red">{{ $data->total() }}</strong> @lang('res.common.count')</p>
                    </div>
                    <div class="pull-right">
                        {!! $data->appends($params)->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection