<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-success"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                </li>
                {{-- user setting sidebar --}}
                @role('superadmin')
                    <li class="nav-header">Super Admin</li>
                    <li class="nav-item menu-{{ (request()->is('superadmin/*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ (request()->is('superadmin/*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                        User Management
                            <i class="right fas fa-cog"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ (request()->is('superadmin/users*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link {{ (request()->is('superadmin/role')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.roles_permission') }}" class="nav-link {{ (request()->is('superadmin/role-permission*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Role Permission</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                @endrole
                {{-- end user seting sidebar --}}

                {{-- role admin --}}
                @role('admin')
                    <li class="nav-header">Admin</li>
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link {{ (request()->is('admin/category*')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags text-muted"></i>
                        <p>
                            Category
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link {{ (request()->is('admin/product*')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box text-danger"></i>
                        <p>
                            Product
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ (request()->is('admin/orders')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dolly-flatbed text-warning"></i>
                        <p>
                            Pesanan
                        </p>
                        </a>
                    </li>
                    <li class="nav-item menu-{{ (request()->is('administrator/reports*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ (request()->is('administrator/reports*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book text-info"></i>
                        <p>
                        Report
                            <i class="right fas fa-hand-point-left text-warning"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report.order') }}" class="nav-link {{ (request()->is('admin/reports/order')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.return') }}" class="nav-link {{ (request()->is('admin/reports/return')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Retur</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('other') }}" class="nav-link {{ (request()->is('admin/other')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-grip-horizontal text-success"></i>
                        <p>
                            Lainnya
                        </p>
                        </a>
                    </li>
                @endrole
                {{-- end role admin --}}
                @role('gudang')
                    <li class="nav-header">Gudang</li>
                    <li class="nav-item">
                        <a href="{{ route('gudang.product.index') }}" class="nav-link {{ (request()->is('gudang/produk*')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                        <p>
                            List Product
                        </p>
                        </a>
                    </li>
                @endrole
                {{-- role gudang --}}

                {{-- end role gudang --}}
                {{-- Configured sidebar links --}}
                {{-- @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') --}}
            </ul>
        </nav>
    </div>

</aside>
