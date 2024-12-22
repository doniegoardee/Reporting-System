<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        {{ $userAgency }}
    </div>


    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->routeIs('agency.home') ? 'active' : '' }}"
            href="{{ route('agency.home') }}">Dashboard</a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->routeIs('agency.records') ? 'active' : '' }}"
            href="{{ route('agency.records') }}">Records</a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->routeIs('agency.logs') ? 'active' : '' }}"
            href="">Activity Logs</a>
    </div>
</div>
<!-- Page content wrapper-->
<div id="page-content-wrapper">
    <!-- Top navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <button class="btn btn-primary" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    {{-- <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#!">Link</a></li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                style="font-size: 20px" class="fa-regular fa-circle-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#!"><i class="fa-solid fa-pen"></i> Edit
                                Profile</a>
                            <a class="dropdown-item d-flex align-items-center" href="#!"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> <!-- Added spacing with 'me-2' -->
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            {{-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!">Something else here</a> --}}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container-fluid">

        {{ $slot }}

    </div>
</div>
