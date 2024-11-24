<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ url('image/logo.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Reporting System</h1>
            <p></p>
        </div>
    </div>

    <ul class="list-unstyled">
        <li class="{{ Route::currentRouteName() === 'home.user' ? 'active' : '' }}">
            <a href="{{ route('home.user') }}">
                <i class="icon-home"></i>Dashboard
            </a>
        </li>
        <li class="{{ in_array(Route::currentRouteName(), ['user.create', 'user.incident']) ? 'active' : '' }}">
            <a href="{{ route('user.incident') }}">
                <i class="fa-solid fa-pen-to-square"></i>Report Incident
            </a>
        </li>
        <li class="{{ Route::currentRouteName() === 'user.report' ? 'active' : '' }}">
            <a href="{{ route('user.report') }}">
                <i class="fa-solid fa-note-sticky"></i> My Reports
            </a>
        </li>
    </ul>

    <span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li class="{{ Route::currentRouteName() === 'user.settings' ? 'active' : '' }}">
            <a href="{{ route('user.settings') }}">
                <i class="icon-settings"></i>Settings
            </a>
        </li>
    </ul>

</nav>
