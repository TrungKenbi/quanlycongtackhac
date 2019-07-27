<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Trang Chính</span></a></li>
                @can('product-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('products.index') }}" aria-expanded="false"><i class="mdi mdi-note-multiple-outline"></i><span class="hide-menu">Quản Lý Công Tác</span></a></li>
                @endcan
                @role('Admin')
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-fingerprint"></i><span class="hide-menu">Quản Trị Hệ Thống</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Quản Lý Người Dùng</span></a></li>
                        <li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Quản Lý Chức Vụ</span></a></li>
                    </ul>
                </li>
                @endrole
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
