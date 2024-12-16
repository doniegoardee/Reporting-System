<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Add New Admin Account</h2>
            </div>
        </div>

        <div class="container-fluid">

            <div class="page-content">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-primary text-white text-center">
                                    <h3 class="mb-0">Add New User</h3>
                                </div>
                                <div class="card-body p-4">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('admin-2.adduser') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- Hidden input for user role -->
                                        <input type="hidden" name="role" value="2">

                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="password-confirm" class="form-label">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input id="profile_image" type="file"
                                                class="form-control @error('profile_image') is-invalid @enderror"
                                                name="profile_image" accept="image/*">
                                            @error('profile_image')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Add User
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



</x-app-layout>
