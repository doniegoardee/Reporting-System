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
                    <h2 class="h5 no-margin-bottom">Delete Barangay</h2>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Barangay List</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Barangay Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bar as $barangay)
                                    <tr>
                                        <td class="text-center">{{ $barangay->id }}</td>
                                        <td class="text-center">{{ $barangay->barangay }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin-2.del-bar', $barangay->id) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @include('admin-2.contents.footer')

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.delete-form').forEach(function(form) {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>

</html>
