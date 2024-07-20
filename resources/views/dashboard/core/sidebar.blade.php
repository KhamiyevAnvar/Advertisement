 <!-- Page Wrapper -->
 <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if(request()->segment(2) == 'home') active @endif"">
            <a class="nav-link" href="{{route("dashboard.home")}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item @if(request()->segment(2) == 'car') active @endif">
            <a class="nav-link" href="{{route("dashboard.car.index")}}">
                <i class="fas fa-fw fa-car"></i>
                <span>Cars</span></a>
        </li>

        <li class="nav-item @if(request()->segment(2) == 'car-model') active @endif">
            <a class="nav-link" href="{{route("dashboard.car-model.index")}}">
                <i class="fa-solid fa-car-rear"></i>

                <span>Cars model</span></a>
        </li>

        <li class="nav-item @if(request()->segment(2) == 'site-user') active @endif">
            <a class="nav-link" href="{{route("dashboard.site-user.index")}}">
                <i class="fa fa-users"></i>
                <span>Users</span></a>
        </li>

        <li class="nav-item @if(request()->segment(2) == 'site-admin') active @endif">
            <a class="nav-link" href="{{route("dashboard.site-admin.index")}}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Admins</span></a>
        </li>

        <li class="nav-item @if(request()->segment(2) == 'advertisemnet') active @endif">
            <a class="nav-link" href="{{route("dashboard.advertisement.index")}}">
                <i class="fa-solid fa-pager"></i>
                <span>Advertisement</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Reports</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Time</h6>
                    <a class="collapse-item" href="">Daily</a>
                    <a class="collapse-item" href="{{route('dashboard.report.montly')}}">Montly</a>
                    <a class="collapse-item" href="">Years</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Components</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="{{asset("dashboardFront/img/undraw_rocket.svg")}}" alt="...">
            <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
            <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
        </div>

    </ul>
    <!-- End of Sidebar -->
 