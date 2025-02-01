<!DOCTYPE html>
<html>

<head>
    @include('admin.contents.css')
</head>

<body>
    @include('admin.contents.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.contents.sidebar')
        <!-- Sidebar Navigation end-->

        <div class="page-content">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="mb-0">Users</h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <form action="{{ route('admin.user') }}" method="GET" class="mb-4">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control"
                                        placeholder="Search by name or email" value="{{ request('query') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="icon-magnifying-glass-browser"></i> Search</button>
                                    </div>
                                </div>
                            </form>


                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">User ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">@if($user->role == 0)
                                                User
                                            @elseif($user->role == 1)
                                                Agency
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--
                                <form action="{{ route('export.reports') }}" method="post">
                                    @csrf
                                    <button type="submit">export</button>
                                </form> --}}

                    </div>
                </div>
            </div>

            @include('admin.contents.footer')
        </div>
    </div>
</body>

</html>
