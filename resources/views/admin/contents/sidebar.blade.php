<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center py-2">
        <div class="avatar"><img src="{{ url('image/logo.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Admin</h1>
            <p></p>
        </div>
    </div>
    {{-- <!-- Sidebar Navidation Menus--><span class="heading">Main</span> --}}
    <ul class="list-unstyled">
        <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a href="{{ route('home.admin') }}"> <i
                    class="icon-home"></i>Dashboard </a></li>
        <li class="{{ Request::is('admin/manage-reports') ? 'active' : '' }}"><a href="{{ route('admin.reports') }}">
                <i class="fa fa-bar-chart"></i>Manage Reports </a>
        </li>
        <li class="{{ Request::is('admin/list-users') ? 'active' : '' }}"><a href="{{ route('admin.user') }}"> <i
                    class="icon-grid"></i> Manage Users </a></li>
        <li class="{{ Request::is('admin/status') ? 'active' : '' }}"><a href="{{ route('status') }}"> <i
                    class="icon-grid"></i> Report Status </a></li>
        <li class="{{ Request::is('admin/activity-log') ? 'active' : '' }}"><a
                href="{{ route('admin.activity-log') }}">
                <i class="fa fa-bar-chart"></i>Activity Log</a></li>

    </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
    </ul>
</nav>
