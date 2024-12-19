{{-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">{{ __('Contact') }}</label>
                        <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror"
                            name="contact" value="{{ old('contact') }}" required autocomplete="contact">
                        @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                        <input id="profile_image" type="file" name="profile_image" class="form-control">
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form> --}}

<!Doctype html>
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
    </style>
</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="row w-100 shadow-lg rounded p-4"
            style="max-width: 1000px; min-height: 550px; background-color: white;">
            <!-- Left Side: Logo Section -->
            <div class="col-md-5 mb-4 mb-md-0 border rounded-1">
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
            <div class="col-md-7">
                <h4 class="text-center">Register your Account</h4>
                <hr class="mt-0 mb-3">

                <div class="mt-3">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label fw-bold">Full Name</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Type your full name here..." required
                                    autocomplete="name" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="contact" class="form-label fw-bold">Contact</label>
                                <input id="contact" type="tel"
                                    class="form-control @error('contact') is-invalid @enderror" name="contact"
                                    value="{{ old('contact') }}" placeholder="Enter your contact number" required
                                    autocomplete="contact">
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="example@gmail.com" required
                                    autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Enter your password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="password-confirm" class="form-label fw-bold">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Confirm your password" required
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="profile_image" class="form-label fw-bold">Profile Picture</label>
                                    <input id="profile_image" type="file" name="profile_image" class="form-control">
                                </div>

                            </div>
                        </div>


                        <!-- Login Button and Forgot Password -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Register') }}</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <a href="{{ route('login') }}" class="text-decoration-none">Already have an Account?
                                    Login here.</a>
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
