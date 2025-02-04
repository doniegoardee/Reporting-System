<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header py-3">
            <div class="container-fluid d-flex align-items-center">
                <a href="{{ route('admin.list.info') }}" class="btn btn-outline-dark me-3">
                    ← Back
                </a>
                <h2 class="h5 no-margin-bottom">Reports for {{ $subject_type }}</h2>
            </div>
        </div>

        <div class="container mt-4">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.reports.byIncident', ['subject_type' => $subject_type]) }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="location" class="form-label">Filter by Location:</label>
                        <select name="location" id="location" class="form-select">
                            <option value="">All Locations</option>
                            @foreach ($locations as $loc)
                                <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>
                                    {{ $loc }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="form-label">Filter by Status:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>

            @if ($reports->isEmpty())
                <div class="no-data-message text-center py-4">
                    <p class="text-muted">No reports found for {{ $subject_type }}.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered bg-white">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Report ID</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Reported By</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $report)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->location }}</td>
                                    <td>
                                        <span class="badge badge-{{ $report->status == 'pending' ? 'warning' : ($report->status == 'resolved' ? 'success' : 'secondary') }}">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $report->name }}</td>
                                    <td>{{ $report->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.reports.view', ['id' => $report->id]) }}" class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination justify-content-center mt-3">
                    {{ $reports->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
