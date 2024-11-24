<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('register', 'My Laravel App') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #4D9FE2; /* Light Blue */
            color: white;
            font-size: 1.25rem;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .btn-primary {
            background-color: #4D9FE2;
            border-color: #4D9FE2;
        }

        .btn-primary:hover {
            background-color: #3a8bbd;
            border-color: #3a8bbd;
        }

        .logo-image {
            max-width: 100%;
            height: auto;
        }

        .form-container {
            padding: 2rem;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .registration-layout {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 100vh;
            flex-wrap: wrap;
        }

        .registration-form-container {
            flex: 1;
            padding: 2rem;
            max-width: 500px;
        }

        .image-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .logo-container {
            text-align: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .registration-layout {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .image-container {
                margin-bottom: 2rem;
                width: 100%;
            }

            .registration-form-container {
                width: 100%;
            }
        }
    </style>

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">  <!-- Centered content with restricted width -->
        <div class="row w-100 justify-content-center">  <!-- Center the row -->
            <div class="col-12 col-md-4 d-flex justify-content-center mb-4 mb-md-0">  <!-- Logo Column -->
                <img src="{{ asset('image/logo.jpg') }}" alt="Logo" class="logo-image">
            </div>
            <div class="col-12 col-md-6 p-4">  <!-- Form Column -->
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">{{ __('Contact') }}</label>
                        <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact">
                        @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                </form>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>
