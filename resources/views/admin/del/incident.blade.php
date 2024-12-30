<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Incident List</h2>
            </div>
        </div>

        @if (session('success'))
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
                        icon: 'success',
                        title: 'Incident Archived'
                    });
                });
            </script>
        @endif
        @if (session('success2'))
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
                        icon: 'success',
                        title: 'Incident Unarchived'
                    });
                });
            </script>
        @endif

        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Incident List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Incident Type</th>
                                <th class="text-center">Actions</th>
                                <th class="text-center">Coresponding Agency</th>
                                <th class="text-center">Contact Info</th>
                                <th class="text-center">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inc as $incident)
                                <tr>
                                    <td class="text-center">{{ $incident->id }}</td>
                                    <td class="text-center">{{ $incident->name }}</td>
                                    <td class="text-center">{{ $incident->agency }}</td>
                                    <td class="text-center">{{ $incident->contact }}</td>
                                    <td class="text-center">{{ $incident->email }}</td>
                                    <td class="text-center p-0">
                                        <form action="{{ route('admin.del-inc', $incident->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger delete-btn mt-1">Archive</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Archive Incident List</h4>
                </div>
                <div class="card-body">


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Incident Type</th>
                                <th class="text-center">Coresponding Agency</th>
                                <th class="text-center">Contact Info</th>
                                <th class="text-center">Email</th>
                                {{-- <th class="text-center">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arcinc as $incidents)
                                <tr>
                                    <td class="text-center">{{ $incidents->id }}</td>
                                    <td class="text-center">{{ $incidents->name }}</td>
                                    <td class="text-center">{{ $incidents->agency }}</td>
                                    <td class="text-center">{{ $incidents->contact }}</td>
                                    <td class="text-center">{{ $incidents->email }}</td>
                                    <td class="text-center p-0">
                                        <form action="{{ route('admin.un-inc', $incidents->id) }}" method="POST"
                                            class="unarchive-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-success unarchive-btn mt-1">Unarchive</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>



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
                            confirmButtonText: 'Yes, archive it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.unarchive-form').forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to restore this incident?",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, unarchive it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>


</x-app-layout>
