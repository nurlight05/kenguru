<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Навигация</li>
                <li>
                    <a href="{{ route('main') }}" class="text-truncate" title="Перейти на сайт">
                        <i class="metismenu-icon pe-7s-back"></i>
                        Перейти на сайт
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.main') }}" class="@yield('active-main') text-truncate" title="Показатели">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Показатели
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.profile') }}" class="@yield('active-profile') text-truncate" title="Профиль">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Профиль
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="@yield('active-users') text-truncate" title="Пользователи">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Пользователи
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.couriers') }}" class="@yield('active-couriers') text-truncate" title="Курьеры">
                        <i class="metismenu-icon pe-7s-smile"></i>
                        Курьеры
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="@yield('active-orders') text-truncate" title="Заказы">
                        <i class="metismenu-icon pe-7s-shopbag"></i>
                        Заказы
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.feedbacks') }}" class="@yield('active-feedbacks') text-truncate" title="Отзывы и жалобы">
                        <i class="metismenu-icon pe-7s-ribbon"></i>
                        Отзывы и жалобы
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
