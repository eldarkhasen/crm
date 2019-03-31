<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="/img/crm.png" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">CRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="екгу">

                <li class="nav-item">
                    <a href="/home" class="nav-link {{ Request::is('home*')||Request::is('/') ? 'active' : '' }}">
                       <div class="nav-icon fas fa-tachometer-alt"></div>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                @if(Auth::user()->hasPermissionTo('patients') || Auth::user()->hasRole('admin') )
                <li class="nav-item">
                    <a href="/patients" class="nav-link  {{ Request::is('patients*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>
                            Пациенты
                        </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->hasPermissionTo('services') || Auth::user()->hasRole('admin') )
                <li class="nav-item">
                    <a href="/services" class="nav-link  {{ Request::is('services*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>
                            Услуги
                        </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->hasPermissionTo('materials') || Auth::user()->hasRole('admin') )
                    <li class="nav-item">
                        <a href="/materials" class="nav-link  {{ Request::is('materials*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dolly"></i>
                            <p>
                                Склад
                            </p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->hasPermissionTo('finance') || Auth::user()->hasRole('admin') )
                <li class="nav-item has-treeview {{ Request::is('cashBoxes*')||Request::is('paymentItems*')
                    || Request::is('cashFlows*') || Request::is('create-income*') || Request::is('create-expanse*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('cashBoxes*')|| Request::is('paymentItems*')
                        ||Request::is('cashFlows*') || Request::is('create-income*') || Request::is('create-expanse*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-hand-holding-usd"></i>
                        <p>
                            Финансы
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="/cashBoxes" class="nav-link  {{ Request::is('cashBoxes*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-credit-card"></i>
                                    <p>
                                        Счета и кассы
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/paymentItems" class="nav-link  {{ Request::is('paymentItems*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Статьи платежей
                                    </p>
                                </a>
                            </li>
                        <li class="nav-item">
                            <a href="/cashFlows" class="nav-link  {{ Request::is('cashFlows*') || Request::is('create-income*') || Request::is('create-expanse*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>
                                    Движение средств
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif
                @if(Auth::user()->hasPermissionTo('positions') || Auth::user()->hasPermissionTo('employees')|| Auth::user()->hasRole('admin')  )
                <li class="nav-item has-treeview {{ Request::is('positions*') || Request::is('employees*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('positions*') || Request::is('employees*') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Настройки
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Auth::user()->hasPermissionTo('positions') || Auth::user()->hasRole('admin') )
                            <li class="nav-item">
                                <a href="/positions" class="nav-link  {{ Request::is('positions*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Должности
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->hasPermissionTo('employees') || Auth::user()->hasRole('admin') )
                            <li class="nav-item">
                                <a href="/employees" class="nav-link  {{ Request::is('employees*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-md"></i>
                                    <p>
                                        Сотрудники
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/appointments" class="nav-link  {{ Request::is('appointments*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Записи
                        </p>
                    </a>
                </li>
                    @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>