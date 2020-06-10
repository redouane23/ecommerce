<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" style="height: 36px;width: 36px"
             src="{{ auth()->user()->image_path }}"
             alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->email }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.welcome') }}"><i
                    class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">@lang('site.dashboard')</span></a></li>
        @if (auth()->user()->hasPermission('read_categories'))
            <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.categories.index') }}"><i
                        class="app-menu__icon fa fa-th"></i><span
                        class="app-menu__label">@lang('site.categories')</span></a></li>
        @endif
        @if (auth()->user()->hasPermission('read_suppliers'))
            <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.suppliers.index') }}"><i
                        class="app-menu__icon fa fa-users"></i><span
                        class="app-menu__label">@lang('site.suppliers')</span></a></li>
        @endif
        @if (auth()->user()->hasPermission('read_products'))
            <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.products.index') }}"><i
                        class="app-menu__icon fa fa-th"></i><span
                        class="app-menu__label">@lang('site.products')</span></a></li>
        @endif
        @if (auth()->user()->hasPermission('read_clients'))
            <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.clients.index') }}"><i
                        class="app-menu__icon fa fa-users"></i><span
                        class="app-menu__label">@lang('site.clients')</span></a></li>
        @endif
        @if (auth()->user()->hasPermission('read_orders'))
            <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.orders.index') }}"><i
                        class="app-menu__icon fa fa-shopping-basket"></i><span
                        class="app-menu__label">@lang('site.all_orders')</span></a></li>

            {{--            <li class="treeview"><a class="app-menu__item text-capitalize" href="#"--}}
            {{--                                    data-toggle="treeview"><i--}}
            {{--                        class="app-menu__icon fa fa-th"></i><span class="app-menu__label">@lang('site.orders')</span><i--}}
            {{--                        class="treeview-indicator fa fa-angle-right"></i></a>--}}
            {{--                <ul class="treeview-menu">--}}
            {{--                    <li><a class="treeview-item text-capitalize" href="{{ route('dashboard.orders.index') }}"><i--}}
            {{--                                class="icon fa fa-circle-o"></i> @lang('site.pending_orders')</a>--}}
            {{--                    </li>--}}
            {{--                    --}}{{--                    <li><a class="treeview-item text-capitalize" href="widgets.html"><i--}}
            {{--                    --}}{{--                                class="icon fa fa-circle-o"></i>@lang('site.orders_received')</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            <li class="treeview"><a class="app-menu__item text-capitalize" href="#" data-toggle="treeview"><i--}}
            {{--                        class="app-menu__icon fa fa-th"></i><span--}}
            {{--                        class="app-menu__label">@lang('site.all_orders')</span><i--}}
            {{--                        class="treeview-indicator fa fa-angle-right"></i></a>--}}
            {{--                <ul class="treeview-menu">--}}
            {{--                    <li><a class="treeview-item text-capitalize" href="ui-cards.html"><i--}}
            {{--                                class="icon fa fa-circle-o"></i> @lang('site.pending_orders')</a>--}}
            {{--                    </li>--}}
            {{--                    <li><a class="treeview-item text-capitalize" href="widgets.html"><i--}}
            {{--                                class="icon fa fa-circle-o"></i>@lang('site.orders_received')</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
        @endif
        <li><a class="app-menu__item text-capitalize"
               href="{{ route('dashboard.clients.orders.index', auth()->user()->id) }}"><i
                    class="app-menu__icon fa fa-shopping-cart"></i><span
                    class="app-menu__label">@lang('site.your_orders')</span></a></li>

        <li><a class="app-menu__item text-capitalize" href="#"><i
                    class="app-menu__icon fa fa-envelope"></i><span
                    class="app-menu__label">@lang('site.messages')</span></a></li>

        <li><a class="app-menu__item text-capitalize" href="#"><i
                    class="app-menu__icon fa fa-cogs"></i><span
                    class="app-menu__label">@lang('site.setting')</span></a></li>

        @if (auth()->user()->hasPermission('read_users'))
            <li><a class="app-menu__item text-capitalize" href="{{ route('dashboard.users.index') }}"><i
                        class="app-menu__icon fa fa-user"></i><span
                        class="app-menu__label">@lang('site.users')</span></a></li>
        @endif

    </ul>
</aside>
