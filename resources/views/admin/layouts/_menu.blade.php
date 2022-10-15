<!--左侧导航-->
<aside class="lyear-layout-sidebar">

    <!-- logo -->
    <div id="logo" class="sidebar-header">
        <a href="{{ route('admin.main') }}"><img src="{{ asset('/images/logo-sidebar.png') }}" title="Logo" alt="Logo" /></a>
    </div>
    <div class="lyear-layout-sidebar-scroll">

        <nav class="sidebar-main">
            <ul class="nav nav-drawer">

                @foreach (app(App\Services\MenuService::class)->getPermissionsByGuard() as $permissions)


                    @if($loop->first)
                        <li class="nav-item active">
                    @else
                        <li class="nav-item @if($permissions->children) nav-item-has-subnav @endif">
                            @endif

                            @if($permissions->route_name)
                                <a class="multitabs" href="{{ route($permissions->route_name) }}" title="{{ $permissions->getLangName() }}">
                                    @else
                                        <a href="javascript:void(0)" title="{{ $permissions->getLangName() }}">
                                            @endif

                                            <i class="{{ $permissions->icon }}"></i>
                                            <span>{{ $permissions->getLangName() }}</span>
                                        </a>

                                        @if($permissions->children)
                                            <ul class="nav nav-subnav">
                                                @foreach ($permissions->children as $permission)
                                                    @if($permission->is_show && $permission->isItemShow())
                                                        <li>
                                                            <a class="multitabs" href="{{ $permission->route_name ? route($permission->route_name) : '#' }}" title="{{ $permission->getLangName() }}">
                                                                <i class="{{ $permission->icon }}"></i>
                                                                {{ $permission->getLangName() }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                            @endif
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
