<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- CSRF Token -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="antialiased">
    <h1 class=" bg-primary p-3 fw-bold text-center">Incident Report System</h1>

    <div class="mt-4 pt-4">

        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">

                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                            class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    @if (auth()->user()->role == 'user')
                                        <a href="{{ route('home.user') }}" type="button" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-primary btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Home</a>
                                    @elseif(auth()->user()->role == 'admin')
                                        <a href="{{ route('home.admin') }}" type="button" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-primary btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Home</a>
                                    @elseif(auth()->user()->role == 'admin-2')
                                        <a href="{{ route('admin-2.index') }}" type="button" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-primary btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Home</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" type="" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" type="button" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-primary btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</a>
                                    @endif
                                @endauth

                            </div>
                        @endif

                    </div>

                </div>
            </div>
    </div>

    </section>

    {{-- <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li> --}}


    </div>
</body>

</html>
