<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Add Barangay</h2>
                <hr class="mt-0">

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
                        title: 'Barangay Added'
                    });
                });
            </script>
        @endif


        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Barangay</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.add_barangay') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Baranagay</label>
                            <input type="text" class="form-control" id="name" name="barangay" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Barangay</button>
                    </form>
                </div>
            </div>
        </div>




</x-app-layout>
