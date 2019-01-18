<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="/img/crm.png" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/home" class="nav-link {{ Request::is('home*')||Request::is('/') ? 'active' : '' }}">
                       <div class="nav-icon fas fa-tachometer-alt"></div>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>

                @if(Auth::user()->hasPermissionTo('users'))
                <li class="nav-item">
                    <a href="/users" class="nav-link  {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Аккаунты
                        </p>
                    </a>
                </li>
                    <li class="nav-item">
                        <a href="/employees" class="nav-link  {{ Request::is('employees*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Сотрудники
                            </p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasPermissionTo('permissions'))
                <li class="nav-item">
                    <a href="/permissions" class="nav-link  {{ Request::is('permissions*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-accessible-icon"></i>
                        <p>
                            Доступы

                        </p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasPermissionTo('roles'))
                <li class="nav-item">
                    <a href="/roles" class="nav-link  {{ Request::is('roles*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Должности
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