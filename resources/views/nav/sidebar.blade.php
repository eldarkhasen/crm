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
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/crm.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/home" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt "></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>

                @if(Auth::user()->hasPermissionTo('users'))
                <li class="nav-item">
                    <a href="/users" class="nav-link  {{ Request::is('users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Сотрудники

                        </p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasPermissionTo('permissions'))
                <li class="nav-item">
                    <a href="/permissions" class="nav-link  {{ Request::is('permissions') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-accessible-icon"></i>
                        <p>
                            Доступы

                        </p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasPermissionTo('roles'))
                <li class="nav-item">
                    <a href="/roles" class="nav-link  {{ Request::is('roles') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Должности
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Услуги
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>