@if($member)
    @php
        //$_notice_member = [1];
        $_notice_member = \App\Models\MemberLog::memberRecent()->whereIn('member_id',\App\Models\Member::where('is_tips_on',1)->pluck('id'))->pluck('member_id')->toArray();
    @endphp

    {{--dropup--}}
    <div class="btn-group">
        <button style="width: 90px;" type="button" title="{{ $member->name }} @if($member->is_in_on) (@lang('res.common.inner') @endif @if(in_array($member->id,$_notice_member)) (@lang('res.common.login_notice')) @endif" class="btn @if($member->is_in_on) btn-warning @else btn-info @endif btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if(in_array($member->id,$_notice_member))
                <i title="@lang('res.common.login_notice')" class="mdi mdi-star"></i>
            @endif

            {{ $member->name }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu progress-bar-info">
            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.member_apis') - 【{{ $member->name }}】"
                   data-url="{{ route('admin.member.member_apis',['member' => $member]) }}">@lang('res.option.member_apis')</a></li>
            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.recharges') - 【{{ $member->name }}】"
                data-url="{{ route('admin.recharges.index',['member_id' => $member->id]) }}">@lang('res.option.recharges')</a></li>
            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.drawings') - 【{{ $member->name }}】"
                   data-url="{{ route('admin.drawings.index',['member_id' => $member->id]) }}">@lang('res.option.drawings')</a></li>
            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.transfers') - 【{{ $member->name }}】"
                   data-url="{{ route('admin.transfers.index',['member_id' => $member->id]) }}">@lang('res.option.transfers')</a></li>
            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.gamerecords') - 【{{ $member->name }}】"
                   data-url="{{ route('admin.gamerecords.index',['member_id' => $member->id]) }}">@lang('res.option.gamerecords')</a></li>
            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.memberlogs') - 【{{ $member->name }}】"
                   data-url="{{ route('admin.memberlogs.index',['member_id' => $member->id]) }}">@lang('res.option.memberlogs')</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="javascript:;" data-operate="iframe-page" data-title="@lang('res.member.index.title_modify_money')"
                   data-url="{{ route('admin.member.modify_money', ['member' => $member->id]) }}">@lang('res.option.modify_money')</a></li>

            <li><a href="javascript:;" data-operate="show-page" data-title="@lang('res.option.arbitrage_query') - 【{{ $member->name }}】"
                   data-url="{{ route('admin.quick.member_arbitrage_query', ['member_id' => $member->id, 'type' => 'ip']) }}">@lang('res.option.arbitrage_query')</a></li>

            <li><a href="javascript:;" data-operate="alert-deal" data-title="@lang('res.option.make_offline')" data-message="@lang('res.option.make_offline_msg')" data-method="post"
                   data-url="{{ route('admin.member.make_offline', ['member' => $member->id]) }}">@lang('res.option.make_offline')</a></li>

            @if((!$member->isAgent() && app(\App\Services\AgentService::class)->isTraditionalMode() && !$member->top_id ) || (!app(\App\Services\AgentService::class)->isTraditionalMode() && !$member->isAgent()) )
            <li>
                <a href="javascript:;" data-operate="iframe-page"
                   data-url="{{ route('admin.agents.assign',['member' => $member->id]) }}"
                   data-title="@lang('res.member.index.title_assign_member_agent',['name' => $member->name])">
                    @lang('res.member.index.title_assign_agent')
                </a>
            </li>
            @endif

            @if((app(\App\Services\AgentService::class)->isTraditionalMode() && !$member->isAgent()) || !app(\App\Services\AgentService::class)->isTraditionalMode())
            <li>
                <a href="javascript:;" data-operate="iframe-page" data-title="@lang('res.member.index.title_modify_member_top',['name' => $member->name])"
                   data-url="{{ route('admin.member.modify_top', ['member' => $member->id]) }}">
                    @lang('res.member.index.title_modify_top')
                </a>
            </li>
            @endif
        </ul>
    </div>
@else
    已删除
@endif

