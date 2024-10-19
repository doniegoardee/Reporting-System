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

        <div class="container">
            <h2>Barangays List</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barangay Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bar as $barangay)
                        <tr>
                            <td>{{ $barangay->id }}</td>
                            <td>{{ $barangay->barangay }}</td>
                            <td>
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

</body>

</html>
