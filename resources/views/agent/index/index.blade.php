@extends('layouts.baseframe')

@section('title', '首页')

@section('content')
    <div class="col-sm-12">

        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="card bg-primary">
                    <div class="card-body clearfix">
                        <div class="pull-right">
                            <p class="h6 text-white m-t-0">@lang('res.agent_page.desc.offline_num')</p>
                            <p class="h3 text-white m-b-0">{{ $agent_child_count }}</p>
                        </div>
                        <div class="pull-left">
                        <span class="img-avatar img-avatar-48 bg-translucent">
                            <i class="mdi mdi-account fa-1-5x"></i>
                        </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection