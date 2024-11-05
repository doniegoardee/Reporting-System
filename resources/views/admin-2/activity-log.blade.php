<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Activity Log</h2>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped ">
                        <thead class="table-dark">
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

</x-app-layout>
