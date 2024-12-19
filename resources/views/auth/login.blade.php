<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('login') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font  --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Nunito", sans-serif;
        }

        .colored-toast.swal2-icon-success {
            background-color: #012970 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #DC3545 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
</head>

<body>
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'warning',
                    title: 'Incorrect Email or Password!'
                });
            });
        </script>
    @endif
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="row w-100 shadow-lg rounded p-4"
            style="max-width: 900px; min-height: 500px; background-color: white;">
            <!-- Left Side: Logo Section -->
            <div class="col-md-6 mb-4 mb-md-0 border rounded-1">
                <div class="row">
                    <div class="col-12 d-flex justify-content-start mt-1">
                        <img src="{{ asset('image/logo.jpg') }}" alt="Logo" class="img-fluid rounded rounded-circle"
                            style="max-width: 50px; height: auto; max-height: 300px;">
                    </div>
                </div>
                <div class="row" style="height: 80%;"> <!-- Ensuring the row takes full height -->
                    <div class="col-12 d-flex justify-content-center align-items-center" style="height: 100%;">
                        <!-- Centering vertically -->
                        <h1 class="text-center">Reporting System of Buguey Municipal</h1>
                    </div>
                </div>
            </div>


            <!-- Right Side: Login Form -->
            <div class="col-md-6">
                <h4 class="text-center">{{ __('Login to Your Account') }}</h4>
                <hr class="mt-0 mb-3">

                <div class="mt-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Enter your Email" required autocomplete="email"
                                autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Enter your Password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <!-- Login Button and Forgot Password -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link p-0 text-decoration-none text-danger"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <a href="{{ route('register') }}"
                                    class="text-decoration-none">{{ __('Don\'t have an account? Register') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
