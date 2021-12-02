<a href="#" class="brand-link">
    <span class="brand-text font-weight-light">Wap Angel</span>
</a>

<div class="sidebar">
    
    <div class="dropdown bg-light  pt-1 pb-1 ">
        <button class="btn btn-secondry btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('public/wa_assets/images/icons/user_active.png')}}" class="rounded-circle" alt="..."> Welcome - {{session('ADMIN_NAME')}}
        </button>
        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
            <li class="nav-item">
                <a class="dropdown-item active" aria-current="page" href="{{url('admin/logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item menu-open">
                <a href="{{url('admin/dashboard')}}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/wap-admin')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i><p>Wap Admins</p>
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Master<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    {{-- <li class="nav-item">
                        <a href="{{url('/country')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i><p>Country</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/state')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i><p>State</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/city')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i><p>City</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{url('#')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i><p>Master-1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('#')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i><p>Master-2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('#')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i><p>Master-3</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="{{url('/admin')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
            

            <li class="nav-header">EXAMPLES</li>
             
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>