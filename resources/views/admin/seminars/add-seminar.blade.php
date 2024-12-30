<x-app-layout>
    <div class="content">
        <div class="container-fluid">


            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Create Seminar</h2>
                    <hr class="mt-0 bg-black">
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
                            title: 'Seminar Created'
                        });
                    });
                </script>
            @endif
            <div class="container">

                <div class="card py-2 px-4">
                    <div class="card-header">
                        <h4 class="text-center">Create Seminar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.seminar-store') }}" method="POST">
                            @csrf

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Enter seminar title" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4"
                                    placeholder="Enter seminar description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <!-- Date -->
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" id="date" name="date" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <!-- Location -->
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" id="location" name="location" class="form-control"
                                            placeholder="Enter seminar location" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create Seminar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
