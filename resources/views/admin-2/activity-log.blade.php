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
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Activity Log</h3>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">Log Name</th>
                                        <th class="text-center">Properties</th>
                                        <th class="text-center">Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($activity as $log)
                                        <tr>
                                            <td class="text-center">{{ $log->log_name }}</td>
                                            <td class="text-center">{{ $log->properties }}</td>
                                            <td class="text-center">{{ $log->event }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No activity logs
                                                available.</td>
                                        </tr>
                                    @endforelse
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
