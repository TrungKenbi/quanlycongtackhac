<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Bảng Điều Khiển</span></a></li>
                @can('otherwork-list')
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-note-multiple-outline"></i><span class="hide-menu">Công Tác Khác</span></a>
                    <ul aria-expanded="false" class="collapse first-level in">
                        <li class="sidebar-item"><a href="{{ route('otherworks.index') }}" class="sidebar-link"><i class="mdi mdi-clipboard"></i><span class="hide-menu">Xem Các Công Tác</span></a></li>
                        <li class="sidebar-item"><a href="{{ route('otherworks.create') }}" class="sidebar-link"><i class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Thêm Công Tác Mới</span></a></li>
                        <li class="sidebar-item"><a href="{{ route('otherworks.export') }}" class="sidebar-link"><i class="mdi mdi-file-export"></i><span class="hide-menu">Xuất Báo Cáo Cá Nhân</span></a></li>

                    </ul>
                </li>
                @endcan

                @can('otherwork-management')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Quản Lý Công Tác Khác</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{ route('otherworks-management.index') }}" class="sidebar-link"><i class="mdi mdi-clipboard"></i><span class="hide-menu">Xem Các Công Tác</span></a></li>
                        <li class="sidebar-item"><a href="{{ route('otherworks-management.reportUser') }}" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">Báo Cáo Theo Giảng Viên</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-group"></i><span class="hide-menu">Báo Cáo Theo Khoa</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-file-export"></i><span class="hide-menu">Xuất Báo Cáo</span></a></li>

                    </ul>
                </li>
                @endcan

                @role('Admin')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-fingerprint"></i><span class="hide-menu">Quản Trị Hệ Thống</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Quản Lý Người Dùng</span></a></li>
                        <li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Quản Lý Chức Vụ</span></a></li>
                        @if(auth()->user()->can('permission-list')   ||
                            auth()->user()->can('permission-create') ||
                            auth()->user()->can('permission-edit')   ||
                            auth()->user()->can('permission-delete'))
                        <li class="sidebar-item"><a href="{{ route('permissions.index') }}" class="sidebar-link"><i class="mdi mdi-key"></i><span class="hide-menu">Quản Lý Quyền Hạn</span></a></li>
                        @endif
                    </ul>
                </li>
                @endrole
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
