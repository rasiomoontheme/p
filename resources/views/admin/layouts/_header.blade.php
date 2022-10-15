<!--头部信息-->
<header class="lyear-layout-header">

    <nav class="navbar navbar-default">
        <div class="topbar">

            <div class="topbar-left">
                <div class="lyear-aside-toggler">
                    <span class="lyear-toggler-bar"></span>
                    <span class="lyear-toggler-bar"></span>
                    <span class="lyear-toggler-bar"></span>
                </div>

                {{-- 快捷操作 --}}
                <li class="dropdown">
                    <a href="{{ route('admin.recharges.index') }}" class="js-create-tab multitabs" >
                        <span>@lang('res.common.recharge_list')</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="{{ route('admin.drawings.index') }}" class="js-create-tab multitabs" >
                        <span>@lang('res.common.drawing_list')</span>
                    </a>
                </li>
            </div>

            <ul class="topbar-right">

                <li class="dropdown dropdown-profile">
                    <a href="javascript:void(0)" data-toggle="dropdown">
                        <img class="img-avatar img-avatar-48 m-r-10" src="{{ asset('/images/avatar.jpg') }}"
                             alt="麟游" />
                        <span>{{ auth()->user()->name }} <span class="caret"></span></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li> <a class="multitabs" data-url="{{ route('admin.user.info') }}" href="javascript:void(0)"><i
                                        class="mdi mdi-account"></i> @lang('res.common.user_info')</a> </li>
                        <li> <a class="multitabs" data-url="{{ route('admin.user.modify_pwd') }}" href="javascript:void(0)"><i
                                        class="mdi mdi-lock-outline"></i> @lang('res.common.modify_pwd')</a>
                        </li>

                        {{-- 绑定谷歌验证码 --}}
                        @if(systemconfig('is_backend_google_auth'))
                            <li>
                                <a class="multitabs" data-url="{{ route('admin.user.google') }}" href="javascript:void(0)"><i
                                            class="mdi mdi-lock-outline"></i> @lang('res.common.user_google')</a>
                            </li>
                        @endif

                        {{--                        <li>--}}
                        {{--                            <a class="multitabs" data-url="{{ route('admin.user.lang') }}" href="javascript:void(0)"><i--}}
                        {{--                                        class="mdi mdi-code-tags"></i> @lang('res.common.lang_title')--}}
                        {{--                        </li>--}}
                        {{--<li> <a href="javascript:void(0)"><i class="mdi mdi-delete"></i> 清空缓存</a></li>--}}

                        <li>
                            <a href="javascript:void(0)"
                               data-url="{{ route('admin.fix.url') }}" data-operate="alert-deal"
                               data-message="@lang('res.common.fix_url_notice')" data-method="post">
                                <i class="mdi mdi-delete"></i> @lang('res.common.fix_url')
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;"
                               data-url="{{ route('admin.logout') }}"
                               data-message='@lang('res.common.logout_title')'
                               data-operate="delete"
                            >
                                <i class="mdi mdi-logout-variant"></i>
                                @lang('res.common.logout')
                            </a>
                        </li>
                    </ul>
                </li>

                <!--切换主题配色-->
                <li class="dropdown dropdown-skin">
                    <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
                    <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                        <li class="drop-title">
                            <p>LOGO</p>
                        </li>
                        <li class="drop-skin-li clearfix">
                            <span class="inverse">
                                <input type="radio" name="logo_bg" value="default" id="logo_bg_1" checked>
                                <label for="logo_bg_1"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                                <label for="logo_bg_2"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                                <label for="logo_bg_3"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                                <label for="logo_bg_4"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                                <label for="logo_bg_5"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                                <label for="logo_bg_6"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                                <label for="logo_bg_7"></label>
                            </span>
                            <span>
                                <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8">
                                <label for="logo_bg_8"></label>
                            </span>
                        </li>
                        <li class="drop-title">
                            <p>@lang('res.common.color_header')</p>
                        </li>
                        <li class="drop-skin-li clearfix">
                            <span class="inverse">
                                <input type="radio" name="header_bg" value="default" id="header_bg_1" checked>
                                <label for="header_bg_1"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                                <label for="header_bg_2"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                                <label for="header_bg_3"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                                <label for="header_bg_4"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                                <label for="header_bg_5"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                                <label for="header_bg_6"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                                <label for="header_bg_7"></label>
                            </span>
                            <span>
                                <input type="radio" name="header_bg" value="color_8" id="header_bg_8">
                                <label for="header_bg_8"></label>
                            </span>
                        </li>
                        <li class="drop-title">
                            <p>@lang('res.common.color_sidebar')</p>
                        </li>
                        <li class="drop-skin-li clearfix">
                            <span class="inverse">
                                <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1" checked>
                                <label for="sidebar_bg_1"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                                <label for="sidebar_bg_2"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                                <label for="sidebar_bg_3"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                                <label for="sidebar_bg_4"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                                <label for="sidebar_bg_5"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                                <label for="sidebar_bg_6"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                                <label for="sidebar_bg_7"></label>
                            </span>
                            <span>
                                <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8">
                                <label for="sidebar_bg_8"></label>
                            </span>
                        </li>
                    </ul>
                </li>
                <!--切换主题配色-->
            </ul>

        </div>
    </nav>

</header>
<!--End 头部信息-->
