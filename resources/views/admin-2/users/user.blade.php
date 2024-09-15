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

        <div class="page-content">
            <div class="container mt-5">
                <!-- Card for Users -->
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="mb-0">Users</h2>
                    </div>

                    <div class="card-body">
                        <!-- Search Form -->
                        <form action="{{ route('admin-2.user') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="query" class="form-control"
                                    placeholder="Search by name or email" value="{{ request('query') }}">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i>
                                    Search</button>
                            </div>
                        </form>

                        <!-- User Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin-2.contents.footer')


</body>

</html>


{{--
                                <form action="{{ route('export.reports') }}" method="post">
                                    @csrf
                                    <button type="submit">export</button>
                                </form> --}}
