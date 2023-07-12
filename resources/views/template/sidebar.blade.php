<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cubes"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tester</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('datakaryawan*','gajiAjax*') ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-coffee"></i>
            <span>HR</span>
        </a>
        <div id="collapsePages" class="collapse {{ Request::is('datakaryawan*','gajiAjax*') ? 'show' : '' }}" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('datakaryawanAjax.index') }}">Data Karyawan</a>
                @role('it|manager')
                <a class="collapse-item" href="{{ route('gajiAjax.index') }}">Gaji Karyawan</a>
                @endrole
                <a class="collapse-item" href="forgot-password.html">DLL</a>
            </div>
        </div>
    </li>

    {{-- Register --}}
    @role('it')
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminController.index') }}">{{ __('Admin Controller') }}</a>
    </li>
    @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
