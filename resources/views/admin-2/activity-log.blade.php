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
                    <table class="table table-bordered">
                        <thead class="table-danger">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>User</th>
                                <th>Subject Type</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $perPage = $logs->perPage();
                                $currentPage = $logs->currentPage();
                                $counter = ($currentPage - 1) * $perPage + 1;
                            @endphp
                            @forelse ($logs as $log)
                                @php
                                    $description = '';
                                    $subjectType = $log->subject_type;
                                    $description = $log->description;
                                    $module = isset($activity_types[$subjectType])
                                        ? $activity_types[$subjectType]
                                        : null;

                                    if ($module == 'User Module' && $description == 'created') {
                                        $description = 'New User Registered';
                                    } elseif ($module == 'User Module' && $description == 'updated') {
                                        $description = 'User updated his/her information';
                                    } elseif ($module == 'Reports Module' && $description == 'updated') {
                                        $report = $log->subject;

                                        if ($report && $report->status == 'resolved') {
                                            $description = 'Report Resolved';
                                        } elseif ($report && $report->status == 'closed') {
                                            $description = 'Report Closed';
                                        } else {
                                            $description = 'Updated Report';
                                        }
                                    }
                                    // Check for Login activity
                                    elseif ($description == 'logged in') {
                                        $description =
                                            'User ' . optional($log->causer)->name . ' Logged in successfully';
                                    }
                                @endphp
                                <tr class="text-center">
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ optional($log->causer)->name }}</td>
                                    <td>{{ $activity_types[$log->subject_type] }}</td>
                                    <td>{{ $description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('F d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Activity</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

</x-app-layout>
