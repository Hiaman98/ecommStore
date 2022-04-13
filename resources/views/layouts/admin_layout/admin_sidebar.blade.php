<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{ asset("images/admin_images/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ Auth::guard("admin")->user()->name }}</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("dashboard") }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("update.admin.details") }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.settings") }}" class="nav-link @if(Request::path("admin/update/details")) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.section.index") }}" class="nav-link @if(Request::path("admin/section"))  @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin Section</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("admin.category.index") }}" class="nav-link @if(Request::path("admin/category"))  @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.category.add") }}" class="nav-link @if(Request::path("add/category"))  @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>