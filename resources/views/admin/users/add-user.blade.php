<x-app-layout>
    <div class="content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Add New Agency Account</h2>
                <hr class="mt-0 bg-dark">
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Add Agency</h4>
                        </div>
                        <div class="card-body p-4">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.adduser') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Hidden input for user role -->
                                <input type="hidden" name="role" value="1">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <!-- Name Field -->
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                placeholder="Enter you full name" value="{{ old('name') }}" required
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <!-- Email Field -->
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                placeholder="Enter your email address" value="{{ old('email') }}"
                                                required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <!-- Agency Field -->
                                        <div class="form-group mb-3">
                                            <label for="agency" class="form-label">Responding Agency</label>
                                            <input id="agency" type="text"
                                                class="form-control @error('agency') is-invalid @enderror"
                                                name="agency" value="{{ old('agency') }}" required
                                                placeholder="Enter your agency" autocomplete="agency" autofocus>
                                            @error('agency')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <!-- Contact Field -->
                                        <div class="form-group mb-3">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input id="contact" type="text"
                                                class="form-control @error('contact') is-invalid @enderror"
                                                name="contact" placeholder="Enter your contact number"
                                                value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <!-- Password Field -->
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter your password" required
                                                autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">

                                        <!-- Confirm Password Field -->
                                        <div class="form-group mb-4">
                                            <label for="password-confirm" class="form-label">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                placeholder="Confirm your password" name="password_confirmation"
                                                required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <!-- Profile Image Field -->
                                        <div class="form-group mb-4">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input id="profile_image" type="file"
                                                class="form-control @error('profile_image') is-invalid @enderror"
                                                name="profile_image" accept="image/*">
                                            @error('profile_image')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Add User</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>



</x-app-layout>
