<nav style="z-index:2" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ url('image/logo.jpg') }}" alt="..." class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">Reporting System</h1>
            <p></p>
        </div>
    </div>


    <ul class="list-unstyled">

        <li class="{{ Request::is('admin-2/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin-2.index') }}">
                <i class="icon-home"></i>Dashboard
            </a>
        </li>


        <li
            class="{{ Request::is('admin-2/reports/all', 'admin-2/reports/pending', 'admin-2/reports/resolved', 'admin-2/reports/closed') ? 'active' : '' }}">
            <a href="#reports"
                aria-expanded="{{ Request::is('admin-2/reports/all', 'admin-2/reports/pending', 'admin-2/reports/resolved', 'admin-2/reports/closed') ? 'true' : 'false' }}"
                data-toggle="collapse">
                <i class="fa-solid fa-file-lines"></i>Manage Reports
            </a>
            <ul id="reports"
                class="collapse list-unstyled {{ Request::is('admin-2/reports/all', 'admin-2/reports/pending', 'admin-2/reports/resolved', 'admin-2/reports/closed') ? 'show' : '' }}">
                <li><a href="{{ route('admin-2.all-reports') }}"
                        class="{{ Request::is('admin-2/reports/all') ? 'active' : '' }}">All Reports</a></li>
                <li><a href="{{ route('admin-2.pending') }}"
                        class="{{ Request::is('admin-2/reports/pending') ? 'active' : '' }}">Pending Reports</a></li>
                <li><a href="{{ route('admin-2.resolved') }}"
                        class="{{ Request::is('admin-2/reports/resolved') ? 'active' : '' }}">Resolved Reports</a></li>
                <li><a href="{{ route('admin-2.closed') }}"
                        class="{{ Request::is('admin-2/reports/closed') ? 'active' : '' }}">Closed Reports</a></li>
            </ul>
        </li>

        <li class="{{ Request::is('admin-2/users/list', 'admin-2/users/add') ? 'active' : '' }}">
            <a href="#users"
                aria-expanded="{{ Request::is('admin-2/users/list', 'admin-2/users/add') ? 'true' : 'false' }}"
                data-toggle="collapse">
                <i class="fa-solid fa-users"></i>Manage Users
            </a>
            <ul id="users"
                class="collapse list-unstyled {{ Request::is('admin-2/users/list', 'admin-2/users/add') ? 'show' : '' }}">
                <li><a href="{{ route('admin-2.user') }}"
                        class="{{ Request::is('admin-2/users/list') ? 'active' : '' }}">All Users</a></li>
                <li><a href="{{ route('admin-2.add_user') }}"
                        class="{{ Request::is('admin-2/users/add') ? 'active' : '' }}">Add Users</a></li>
            </ul>
        </li>

        <li class="{{ Request::is('admin-2/add/incident', 'admin-2/add/incident/barangay') ? 'active' : '' }}">
            <a href="#incident"
                aria-expanded="{{ Request::is('admin-2/add/incident', 'admin-2/add/incident/barangay') ? 'true' : 'false' }}"
                data-toggle="collapse">
                <i class="fa-solid fa-plus"></i>Add
            </a>
            <ul id="incident"
                class="collapse list-unstyled {{ Request::is('admin-2/add/incident', 'admin-2/add/incident/barangay') ? 'show' : '' }}">
                <li><a href="{{ route('admin-2.incident') }}"
                        class="{{ Request::is('admin-2/add/incident') ? 'active' : '' }}">Add Incident</a></li>
                <li><a href="{{ route('admin-2.barangay') }}"
                        class="{{ Request::is('admin-2/add/incident/barangay') ? 'active' : '' }}">Add Barangay</a>
                </li>
            </ul>
        </li>




        <li class="{{ Request::is('admin-2/analysis') ? 'active' : '' }}">
            <a href="{{ route('admin-2.analysis') }}">
                <i class="fa-solid fa-chart-line"></i>Analysis
            </a>
        </li>


        <li class="{{ Request::is('admin-2/activity-log') ? 'active' : '' }}">
            <a href="{{ route('admin-2.activity-log') }}">
                <i class="icon-grid"></i>Activity Log
            </a>
        </li>
    </ul>


    <span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li class="{{ Request::is('admin-2/settings/setting') ? 'active' : '' }}"><a
                href="{{ route('admin-2.settings') }}"><i class="icon-settings"></i>Settings </a></li>
    </ul>
</nav>
