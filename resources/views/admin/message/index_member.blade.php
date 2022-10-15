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
                            //'visible_type' => ['name' => '可见类型','type' => 'select','data' => config('platform.message_visible_type')],
                            //'send_type' => ['name' => '发送类型','type' => 'select','data' => config('platform.message_send_type')]
                            'member_name' => ['name' => trans('res.common.member_name'),'type' => 'text'],
                            'status' => ['name' => trans('res.member_message.field.status'),'type' => 'select','data' => trans('res.option.message_status')]
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
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/messages/ids">
                        <i class="mdi mdi-window-close"></i> @lang('res.btn.delete')
                    </a>

                    <a class="btn btn-primary" data-operate="batch" data-url="{{ route('admin.messages.post_mark_deal') }}">
                        <i class="mdi mdi-comment-check"></i> @lang('res.member_message.index.btn_batch_read')
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
                            @include('layouts._table_header',['data' => \App\Models\Message::$member_field])
                            {{-- <th>回复状态</th> --}}
                            <th width=100>@lang('res.common.updated_at')</th>
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
                                @include('layouts._table_body',['data' => \App\Models\Message::$member_field,'item' => $item])
                                {{-- <th>
                                  @if(count($item->child) > 0)
                                  <span class="label label-success">已回复</span>
                                  @else
                                  <span class="label label-danger">未回复</span>
                                  @endif
                                </th> --}}
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">

                                        {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                            data-toggle="tooltip" data-original-title="反馈详情"
                                            data-url="{{ route('admin.messages.show', ['message' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a> --}}

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.member_message.index.btn_detail')"
                                           data-reload="true"
                                           data-url="{{ route('admin.messages.history', ['message' => $item->id]) }}">
                                            <i class="mdi mdi-file-document-box"></i>
                                        </a>

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="iframe-page"
                                           data-toggle="tooltip" data-original-title="@lang('res.member_message.index.btn_reply')" data-title="@lang('res.member_message.index.btn_reply')"
                                           data-url="{{ route('admin.messages.reply', ['message' => $item->id]) }}">
                                            <i class="mdi mdi-reply"></i>
                                        </a>

                                        @if($item->status == \App\Models\Message::STATUS_NOT_DEAL)
                                            <a class="btn btn-xs btn-default" href="javascript:;"
                                               data-toggle="tooltip" data-original-title="@lang('res.member_message.index.btn_mark')" data-title="@lang('res.member_message.index.btn_mark')"
                                               data-operate="alert-deal" data-message="@lang('res.member_message.index.title_mark')" data-method="post"
                                               data-url="{{ route('admin.messages.post_mark_deal', ['ids' => $item->id]) }}"
                                            >
                                                <i class="mdi mdi-checkbox-marked-outline"></i>
                                            </a>
                                        @endif

                                        @if(count($item->child) > 0)

                                            {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                                data-toggle="tooltip" data-original-title="回复详情"
                                                data-url="{{ route('admin.messages.show', ['message' => $item->child->id]) }}">
                                                <i class="mdi mdi-comment-account"></i>
                                            </a> --}}

                                            {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                                data-toggle="tooltip" data-original-title="删除回复"
                                                data-message="确定删除管理员对该站内信的回复吗"
                                                data-url="{{ route('admin.messages.destroy', ['message' => $item->child->id]) }}">
                                                <i class="mdi mdi-window-close"></i>
                                            </a> --}}

                                        @else

                                        @endif

                                        {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                            data-toggle="tooltip" data-original-title="删除"
                                            data-url="{{ route('admin.messages.destroy', ['message' => $item->id]) }}">
                                            <i class="mdi mdi-window-close"></i>
                                        </a> --}}
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