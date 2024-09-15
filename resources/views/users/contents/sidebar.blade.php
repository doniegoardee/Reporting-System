<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ url('image/logo.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Reporting System</h1>
            <p></p>
        </div>
    </div>
    {{-- <!-- Sidebar Navidation Menus--><span class="heading">Main</span> --}}
    <ul class="list-unstyled">
        <li class="{{ Request::is('user/home') ? 'active' : '' }}"><a href="{{ route('home.user') }}"> <i
                    class="icon-home"></i>Dashboard </a></li>
        <li class="{{ Request::is('user/create-reports') ? 'active' : '' }}"><a href="{{ route('user.create') }}">
                <i class="fa-solid fa-pen-to-square"></i>Create Reports </a>
        </li>

        <li class="{{ Request::is('user/my-reports') ? 'active' : '' }}"><a href="{{ route('user.report') }}"> <i
                    class="fa-solid fa-note-sticky"></i> My Reports </a></li>


    </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li class="{{ Request::is('setting') ? 'active' : '' }}"> <a href="{{ route('user.settings') }}"> <i
                    class="icon-settings"></i>Settings </a></li>
    </ul>
</nav>
