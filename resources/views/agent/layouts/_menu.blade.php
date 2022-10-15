<!--左侧导航-->
<aside class="lyear-layout-sidebar">

    <!-- logo -->
    <div id="logo" class="sidebar-header">
        <a href="{{ route('agent.main') }}"><h4 style="line-height:68px;color:white;overflow:hidden">@lang('res.agent_page.basic.main_title')</h4></a>
    </div>
    <div class="lyear-layout-sidebar-scroll">

        <nav class="sidebar-main">
            <ul class="nav nav-drawer">
                <li class="nav-item active">
                    <a class="multitabs" href="{{ route("agent.index.index") }}">
                        <i class="mdi mdi-home"></i>
                        <span>@lang('res.agent_page.title.main')</span>
                    </a>
                </li>

                @if(app(\App\Services\AgentService::class)->isTraditionalMode())
                    <li class="nav-item">
                        <a class="multitabs" href="{{ route('agent.memberoffline.index') }}">
                            <i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i>
                            <span>@lang('res.agent_page.title.offline')</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="multitabs" href="{{ route('agent.memberoffline.allagent') }}">
                            <i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i>
                            <span>@lang('res.agent_page.title.offline_list')</span>
                        </a>
                    </li>
                @endif

                @php
                    $menu = [
                        ['title' => trans('res.agent_page.title.promote_site'),'url' => route('agent.agentmember.index')],
                        ['title' => trans('res.agent_page.title.agent_report'),'url' => route('agent.memberoffline.total_sy')],
                        ['title' => trans('res.agent_page.title.recharge_list'),'url' => route('agent.memberoffline.rechargelist')],
                        ['title' => trans('res.agent_page.title.drawing_list'),'url' => route('agent.memberoffline.drawinglist')],
                        ['title' => trans('res.agent_page.title.money_log'),'url' => route('agent.memberoffline.moneylog')],
                        ['title' => trans('res.agent_page.title.fd_logs'),'url' => route('agent.memberoffline.agent_fd_logs')],
                        ['title' => trans('res.agent_page.title.game_records'),'url' => route('agent.memberoffline.gamerecords')],
                    ];
                @endphp

                @foreach($menu as $item)
                    <li class="nav-item">
                        <a class="multitabs" href="{{ $item['url'] }}">
                            <i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i>
                            <span>{{ $item['title'] }}</span>
                        </a>
                    </li>
                @endforeach

                {{-- 
                <li class="nav-item active">
                    <a class="multitabs" href="{{ route("admin.index.index") }}">
                <i class="mdi mdi-home"></i>
                <span>后台首页</span>
                </a>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)">
                        <i class="mdi mdi-format-align-justify"></i>
                        <span>管理员管理</span>
                    </a>
                    <ul class="nav nav-subnav">
                        <li>
                            <a class="multitabs" href="{{ route('admin.users.index') }}">
                                <i class="mdi mdi-home"></i>
                                管理员列表
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="mdi mdi-format-align-justify"></i>
                        <span>表单</span></a>
                    <ul class="nav nav-subnav">
                        <li> <a class="multitabs" href="lyear_forms_elements.html">基本元素</a> </li>
                        <li> <a class="multitabs" href="lyear_forms_radio.html">单选框</a> </li>
                        <li> <a class="multitabs" href="lyear_forms_checkbox.html">复选框</a> </li>
                        <li> <a class="multitabs" href="lyear_forms_switch.html">开关</a> </li>
                    </ul>
                </li>

                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="mdi mdi-menu"></i> <span>多级菜单</span></a>
                    <ul class="nav nav-subnav">
                        <li> <a href="#!">一级菜单</a> </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="#!">一级菜单</a>
                            <ul class="nav nav-subnav">
                                <li> <a href="#!">二级菜单</a> </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <a href="#!">二级菜单</a>
                                    <ul class="nav nav-subnav">
                                        <li> <a href="#!">三级菜单</a> </li>
                                        <li> <a href="#!">三级菜单</a> </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li> <a href="#!">一级菜单</a> </li>
                    </ul>
                </li>
                --}}
            </ul>
        </nav>

    </div>

</aside>
<!--End 左侧导航-->
