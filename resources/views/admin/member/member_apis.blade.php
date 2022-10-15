@extends('layouts.baseframe')

@section('title', $_title)
@section('content')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Check Product Username</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Game Code</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="gamecode" id="gamecode"></td>
                            <td><input type="text" class="form-control" name="username" id="username"></td>
                            <td>
                                <a href="javascript:;" class="btn btn-primary check-product"
                                    data-url="{{ route('admin.member.checkproduct_api') }}" data-toggle="tooltip" 
                                    <i class="mdi mdi-refresh"></i>
                                    <span>Check</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>@lang('res.member.member_apis.api_title')</th>
                            <th>Password</th>
                            <th>@lang('res.member.member_apis.money')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->api->api_title ?? trans('res.member.member_apis.null') }}</td>
                                <td>{{ $item->password ?? trans('res.member.member_apis.null') }}</td>
                                <td>
                                    <a href="javascript:;" class="btn btn-danger btn-xs fresh-money"
                                       data-url="{{ route('admin.member.refresh_api',['member_api' => $item]) }}"
                                       data-toggle="tooltip" data-original-title="@lang('res.member.member_apis.refresh')" data-gamecode="{{ $item->api_token }}"
                                       data-user="{{ $item->username }}">
                                        <i class="mdi mdi-refresh"></i>
                                        <span>{{ $item->money }}</span>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs change-password"
                                       data-url="{{ route('admin.member.changepassword_api',['member_api' => $item]) }}"
                                       data-toggle="tooltip" data-gamecode="{{ $item->api_token }}" data-user="{{ $item->username }}">
                                        <i class="mdi mdi-refresh"></i>
                                        <span>Change password</span>
                                    </a>
                                    <a href="javascript:;" class="btn btn-info btn-xs recycle-money"
                                       data-url="{{ route('admin.member.recycle_api',['member_api' => $item]) }}"
                                       data-toggle="tooltip" data-original-title="@lang('res.member.member_apis.recycle')">
                                        <span>@lang('res.member.member_apis.recycle')</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("footer-js")
    <script>
        $('.check-product').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);
            if(!_this.data('url')) return;
            var gamecode = $('#gamecode').val();
            var username = $('#username').val();
            $.ajax({
                url: _this.data('url'),
                method:'post',
                data: {
                    gamecode : gamecode,
                    username : username
                },
                success:function(res){
                    _this.attr("disabled", false);
                    if(res.code == 200 && res.data) _this.find('span').html(res.data)
                    else $.utils.layerError(res.message)
                },
                error:function(err){
                    _this.attr("disabled", false);
                }
            });
        });
        $('.fresh-money').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);
            if(!_this.data('url')) return;
            var gamecode = $(this).attr('data-gamecode');
            var user = $(this).attr('data-user');
            $.ajax({
                url: _this.data('url'),
                method:'post',
                data: {
                    gamecode : gamecode,
                    username : user
                },
                success:function(res){
                    _this.attr("disabled", false);
                    if(res.code == 200 && res.data) _this.find('span').html(res.data)
                    else $.utils.layerError(res.message)
                },
                error:function(err){
                    _this.attr("disabled", false);
                }
            });
        });
        $('.change-password').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);
            if(!_this.data('url')) return;
            var gamecode = $(this).attr('data-gamecode');
            var user = $(this).attr('data-user');
            $.ajax({
                url: _this.data('url'),
                method:'post',
                data: {
                    gamecode : gamecode,
                    username : user
                },
                success:function(res){
                    _this.attr("disabled", false);
                    if(res.code == 200 && res.data) _this.find('span').html(res.data)
                    else $.utils.layerError(res.message)
                },
                error:function(err){
                    _this.attr("disabled", false);
                }
            });
        });
        $('.recycle-money').click(function(){
            var _this = $(this);
            _this.attr("disabled", true);
            if(!_this.data('url')) return;
            $.ajax({
                url: _this.data('url'),
                method:'post',
                success:function(res){
                    _this.attr("disabled", false);
                    if(res.code == 200 && res.data >= 0){
                        _this.siblings('.fresh-money').find('span').html(parseFloat(res.data).toFixed(2));
                        $.utils.layerSuccess($.utils.getLangs('success_message'));
                    }
                    else $.utils.layerError(res.message);
                },
                error:function(err){
                    _this.attr("disabled", false);
                }
            });
        })
    </script>
@endsection