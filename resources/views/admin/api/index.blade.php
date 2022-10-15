@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('res.apis.index.top_title')</h4>
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
                <form action="{{ route('admin.systemconfig.sync') }}" method="post" id="searchForm" name="searchForm" class="form-horizontal">
                    <div class="row p-15">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <td width="20%">@lang('res.apis.index.api_domain')</td>
                                <td width="10%">@lang('res.apis.index.api_prefix')</td>
                                <td width="20%">api_id</td>
                                <td>api_key</td>
                                <td>Thời gian lấy lịch sử cược (Phút)</td>
                                <td width="5%">@lang('res.common.operate')</td>
                            </tr>
                            </thead>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="remote_api_domain-{{ \App\Models\Base::LANG_COMMON }}"
                                           placeholder="?:api.888.com" value="{{ $config['remote_api_domain'] ?? '' }}" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="remote_api_prefix-{{ \App\Models\Base::LANG_COMMON }}" placeholder="?:9k"
                                           value="{{ $config['remote_api_prefix'] ?? '' }}" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="remote_api_id-{{ \App\Models\Base::LANG_COMMON }}" placeholder=""
                                           value="{{ $config['remote_api_id'] ?? '' }}" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="remote_api_key-{{ \App\Models\Base::LANG_COMMON }}" placeholder=""
                                           value="{{ $config['remote_api_key'] ?? '' }}" />
                                </td>
                                <td>
                                    <input type="number" min="1" pattern="[0-9]" class="form-control"  oninput="validity.valid||(value='');"
                                           name="remote_api_time_cron_get_bet_history-{{ \App\Models\Base::LANG_COMMON }}" placeholder=""
                                           value="{{ $config['remote_api_time_cron_get_bet_history'] ?? '' }}" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-operate="ajax-submit">@lang('res.btn.save')</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                <!--addcode -->
                <form action="{{ route('admin.systemconfig.checkagentsync') }}" method="post" id="searchForm" name="searchForm" class="form-horizontal">
                    <div class="row p-15">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <td width="5%">Agent Credit</td>
                                <td width="5%">@lang('res.common.operate')</td>
                            </tr>
                            </thead>
                            <tr>                               
                                <td>{{ $config['remote_check_agent'] ?? '' }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-operate="ajax-submit"><i class="mdi mdi-refresh"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                <!--addcode -->
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>

            <div class="card-toolbar clearfix">
                <div class="toolbar-btn-action">
                    <a class="btn btn-primary m-r-5" href="{{ route("admin.apis.create") }}"><i
                                class="mdi mdi-plus"></i>
                        @lang('res.btn.add')</a>
                    {{-- <a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> ??</a>
                    <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> ??</a> --}}
                    <a class="btn btn-danger" id="batchDelete" data-operate="delete" data-url="/admin/apis/ids">
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
                            @include('layouts._table_header',['data' => \App\Models\Api::$list_field,'model' => 'apis'])
                            <th width="200">@lang('res.apis.field.lang_list')</th>
                            <th width="120">@lang('res.apis.field.api_money')</th>
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
                                @include('layouts._table_body',['data' => \App\Models\Api::$list_field,'item' => $item])
                                <td>
                                    @if($item->lang_list)
                                        @foreach (json_decode($item->lang_list,1) as $k => $v)
                                            <span class="label {{ config('platform.style_label')[$k+1] }}">{{ config('platform.lang_select')[$v] }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if(\App\Models\Api::isCommonWallet() && !in_array($item->api_name,[\App\Models\Api::COMMON_WALLET_API,\App\Models\Api::LY_LOTTERY]))
                                        <a href="javascript:;" class="btn btn-danger btn-xs">
                                            <span>{{ $item->api_money }}</span>
                                        </a>
                                    @else
                                        <a href="javascript:;" class="btn btn-danger btn-xs fresh-money"
                                           data-url="{{ route('admin.api.refresh',['api_code' => $item->api_name]) }}"
                                           data-toggle="tooltip" data-original-title="@lang('res.apis.index.btn_refresh')">
                                            <i class="mdi mdi-refresh"></i>
                                            <span>{{ $item->api_money }}</span>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-default"
                                           href="{{ route('admin.apis.edit',['api' => $item->id,'is_super' => request('is_super')]) }}" title=""
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.edit')"><i
                                                    class="mdi mdi-pencil"></i></a>

                                        {{-- <a class="btn btn-xs btn-default" href="javascript:;" data-operate="show-page"
                                            data-toggle="tooltip" data-original-title="??"
                                            data-url="{{ route('admin.apis.show', ['api' => $item->id]) }}">
                                        <i class="mdi mdi-file-document-box"></i>
                                        </a> --}}

                                        <a class="btn btn-xs btn-default" href="javascript:;" data-operate="delete"
                                           data-toggle="tooltip" data-original-title="@lang('res.btn.delete')"
                                           data-url="{{ route('admin.apis.destroy', ['api' => $item->id]) }}">
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
                        <p>@lang('res.common.total') <strong style="color: red">{{ count($data) }}</strong> @lang('res.common.count')</p>
                    </div>

                </div>

            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <h4>@lang('res.apis.index.config_title')</h4>
            </div>

            <div class="card-body">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#admin" id="register-tab" role="tab" data-toggle="tab">@lang('res.apis.index.config_title')</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="register">
                        @include('layouts._system_config_field',['group_name' => 'admin'])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer-js")
    <script>
        //??????
        laydate.render({
            elem: '#created_at',
            type: 'datetime',
            theme: "#33cabb",
            range: "~"
        });

        $('.fresh-money').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);

            if(!_this.data('url')) return;

            $.ajax({
                url: _this.data('url'),
                method:'get',
                success:function(res){
                    _this.attr("disabled", false);

                    if(res.code == 200 && res.data) _this.find('span').html(res.data)
                    else $.utils.layerError(res.message)
                },
                error:function(err){
                    _this.attr("disabled", false);

                }
            });
        })


    </script>
@endsection
