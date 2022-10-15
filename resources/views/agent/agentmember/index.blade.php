@extends('layouts.baseframe')

@section('title', trans('res.agent_page.title.promote_site'))

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ trans('res.agent_page.title.promote_site') }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
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
                            <th width="10%" class="text-center">@lang('res.member.field.name')</th>
                            <th style="width: 10%;min-width: 200px;">@lang('res.member.field.realname')/@lang('res.agent_page.field.register_at')</th>
                            <th style="width: 10%">@lang('res.member.money_report.is_agent_and_top_agent')</th>
                            <th style="width: 10%">@lang('res.member.field.phone')/@lang('res.member.field.email')</th>
                            <th style="width: 10%">@lang('res.member.field.status')</th>
                            <th style="width: 10%">@lang('res.member.field.invite_code')</th>
                            <th style="width: 10%">@lang('res.agent_page.field.pc_agent_url')</th>
                            <th style="width: 10%">@lang('res.agent_page.field.wap_agent_url')</th>
                            <th width="15%">@lang('res.common.operate')</th>
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
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->realname ?? ' - ' }} /<br> {{ $item->created_at }}</td>
                                <td>
                                    @if ($item->agent_id > 0)
                                        <span style="color: red">{{ trans('res.option.boolean')[1] }}</span>
                                    @else
                                        <span>{{ trans('res.option.boolean')[0] }}</span>
                                    @endif
                                    /{{ $item->top->member->name ?? ' - ' }}
                                </td>
                                <td>{{ $item->phone }}/{{ $item->email }}</td>
                                <td>
                                    @include('layouts._table_label',[
                                    'list' => App\Models\Member::$list_field,
                                    //'style' => 'platform.style_status',
                                    'key' => $item->status,
                                    //'data' => 'platform.member_status']
                                    'field' => 'status'
                                    ])
                                </td>
                                <td>{{ $item->invite_code }}</td>
                                <td>
                                    {{ $item->agent->getAgentUri() }}
                                </td>
                                <td>
                                    {{ $item->agent->getAgentUri(1) }}
                                </td>
                                <td>
                                    <button class="make_code btn btn-primary btn-xs">
                                        <i class="mdi mdi-qrcode"></i>
                                        @lang('res.agent_page.btn.qrcode')
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{--
                <div class="clearfix">
                    <div class="pull-left">
                        <p>总共 <strong style="color: red">{{ $data->total() }}</strong> 条</p>
                    </div>
                    <div class="pull-right">
                        {!! $data->appends($params)->render() !!}
                    </div>
                </div>
                --}}
            </div>

        </div>

    </div>

    <style>
        .qrcode>img {
            margin: 0 auto;
        }

    </style>
    <div id="qrcode" style="display: none;margin: 0 auto;text-align:center;background-color: white;">
    </div>
@endsection

@section("footer-js")
    <script type="text/javascript" src="{{ asset('/js/base64.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.qrcode.js') }}"></script>

    <script>
        $(function () {

            $('.make_code').click(function () {
                var url = $(this).parent().prev().html().toString().trim();
                var name = $(this).parent().parent().children().eq(1).html().toString().trim();
                console.log(name);
                generateQrcode(url);
                window.layer.open({
                    type: 1,
                    shadeClose: true,
                    title: '【' + name + '】{{ trans('res.agent_page.field.qrcode_title') }}',
                    content: $('#qrcode').html()
                });
            });

            function generateQrcode(base64) {
                var options = {
                    render: 'image',
                    text: base64, //Base64.decode(base64),
                    size: 180,
                    ecLevel: 'M',
                    color: '#222222',
                    minVersion: 1,
                    quiet: 1,
                    mode: 0
                };
                $("#qrcode").empty().qrcode(options);
            }
        });

    </script>
@endsection
