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
                    <div class="card-header">
                        <h2 class="mb-0">Activity Log</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Log Name</th>
                                        <th class="text-center">Properties</th>
                                        <th class="text-center">Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activity as $log)
                                        <tr>
                                            <td class="text-center">{{ $log->log_name }}</td>
                                            <td class="text-center">{{ $log->properties }}</td>
                                            <td class="text-center">{{ $log->event }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.contents.footer')


</body>

</html>
