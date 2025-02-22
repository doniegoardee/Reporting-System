<style>
    .dropdown-menu {
        max-height: 300px;
        overflow-y: auto;
        padding: 5px;
        background-color: #fff;
        border: 1px solid #d0e7ff;
    }

    .notification-item {
        background-color: #f1f8ff;
        color: #333;
        margin: 5px 0;
        padding: 8px 10px;
        line-height: 1.5;
        border-bottom: 1px solid #d0e7ff;
        transition: background-color 0.2s;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        background-color: #e0f2ff;
        text-decoration: none;
    }
</style>

<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="What are you searching for...">
                        <button type="submit" class="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header--><a href="{{ url('/') }}" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><strong
                            class="text-primary">Reporting</strong><strong>System</strong></div>
                    <div class="brand-text brand-sm"><strong class="text-primary">R</strong><strong>S</strong></div>
                </a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>
            <div class="right-menu list-inline no-margin-bottom">
                {{-- <div class="list-inline-item"><a href="#" class="search-open nav-link"><i
                            class="icon-magnifying-glass-browser"></i></a></div> --}}
                <div class="right-menu list-inline no-margin-bottom">
                    <div class="list-inline-item dropdown">
                        <a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="nav-link messages-toggle">
                            <i class="fa-solid fa-bell"></i>
                            <span class="badge dashbg-1">{{ $user->notifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1"
                            style="max-height: 300px; overflow-y: auto;">
                            @if ($user && $user->notifications->count())
                                @forelse ($user->notifications as $notification)
                                    <a class="dropdown-item notification-item" href="#">
                                        {{ $notification->data['name'] }}
                                    </a>
                                @empty
                                    <div
                                        class="dropdown-item text-warning bg-dark border border-warning rounded my-2 p-2">
                                        No notifications
                                    </div>
                                @endforelse
                            @else
                                <div class="dropdown-item text-warning bg-dark border border-warning rounded my-2 p-2">
                                    No notifications
                                </div>
                            @endif
                        </div>
                    </div>


                    <a href="{{ route('admin-2.settings') }}">
                        <img src="{{ asset($user->profile_image) }}" class="img-thumbnail" alt="Profile Image"
                            style="width: 35px; height: 35px; border-radius:50%;">
                    </a>

                </div>


                <!-- Tasks-->

                <!-- Tasks end-->
                <!-- Megamenu-->

                <!-- Megamenu end     -->
                <!-- Languages dropdown    -->
                {{--  <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="{{ url('admincss/img/flags/16/GB.png') }}" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
          <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#" class="dropdown-item"> <img src="{{url('admincss/img/flags/16/DE.png')}}" alt="English" class="mr-2"><span>German</span></a><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French  </span></a></div>
        </div>  --}}
                <!-- Log out               -->


            </div>
    </nav>
</header>
