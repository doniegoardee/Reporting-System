<!DOCTYPE html>
<html>

<head>
    @include('admin-2.contents.css')
</head>

<body>
    @include('admin-2.contents.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin-2.contents.sidebar')
        <!-- Sidebar Navigation end-->

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Settings</h2>
                </div>
            </div>

            <section class="no-padding-top">
                <div class="container-fluid">
                    <!-- Profile Section -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="block">
                                <div class="title"><strong>Profile</strong></div>
                                <div class="block-body">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        @if ($user->profile_image && $user->profile_image !== 'image/default-avatar')
                                            <img src="{{ asset($user->profile_image) }}" alt="Profile Image"
                                                class="img-fluid mt-2 rounded-3" style="max-width: 150px;">
                                        @else
                                            <img src="{{ asset('image/default-avatar.png') }}" alt="Default Avatar"
                                                class="img-fluid mt-2 rounded-3" style="max-width: 150px;">
                                        @endif

                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                value="{{ $user->name }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ $user->email }}" required>
                                        </div>


                                        <small class="form-text text-muted">Upload a new profile image if you want
                                            to change it. Current image:</small>

                                        <div class="form-group mb-3">
                                            <label for="profile_image">Profile Image</label>
                                            <input type="file" id="profile_image" name="profile_image"
                                                class="form-control">

                                        </div>

                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>


                            <div class="block mt-4">
                                <div class="title"><strong>Change Password</strong></div>
                                <div class="block-body">
                                    <form method="POST" action="">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" id="current_password" name="current_password"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="new_password">New Password</label>
                                            <input type="password" id="new_password" name="new_password"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="new_password_confirmation">Confirm New Password</label>
                                            <input type="password" id="new_password_confirmation"
                                                name="new_password_confirmation" class="form-control" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                            </div>


                            <div class="block mt-4">
                                <div class="title"><strong>Delete Account</strong></div>
                                <div class="block-body">
                                    <form method="POST" action="">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete
                                            Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            @include('admin-2.contents.footer')
        </div>
    </div>
</body>

</html>
