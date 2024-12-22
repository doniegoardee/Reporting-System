<div class="page-content scrollable-content bg-light">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>

    <div class="mb-4">
        <div class="btn-group" role="group" aria-label="Report Filters">
            <a href="{{ route('admin-2.all-reports') }}" class="btn btn-outline-primary">
                All Reports ({{ $allReportsCount }})
            </a>
            <a href="{{ route('admin-2.pending') }}" class="btn btn-outline-warning">
                Pending Reports ({{ $pendingCount }})
            </a>
            <a href="{{ route('admin-2.resolved') }}" class="btn btn-outline-success">
                Resolved Reports ({{ $resolvedCount }})
            </a>
            <a href="{{ route('admin-2.closed') }}" class="btn btn-outline-secondary">
                Closed Reports ({{ $closedCount }})
            </a>
        </div>
    </div>

    {{-- ALL REPORTS --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3>All Reports</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Incident/Disaster Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Date and Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allReports as $index => $report)
                            <tr>
                                <td class="text-center">
                                    {{ ($allReports->currentPage() - 1) * $allReports->perPage() + $index + 1 }}
                                </td>
                                <td class="text-center">{{ $report->subject_type }}</td>
                                <td class="text-center">{{ $report->location }}</td>
                                <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center p-0">
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $report->id }}">
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $allReports->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- PENDING --}}
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h3>Pending Reports</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="bg-warning text-dark">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Incident/Disaster Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Date and Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending as $index => $report)
                            <tr>
                                <td class="text-center">
                                    {{ ($pending->currentPage() - 1) * $pending->perPage() + $index + 1 }}
                                </td>
                                <td class="text-center">{{ $report->subject_type }}</td>
                                <td class="text-center">{{ $report->location }}</td>
                                <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center p-0">
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $report->id }}">
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $pending->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- RESOLVED --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h3>Resolved Reports</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="bg-success text-white">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Incident/Disaster Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Date and Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resolved as $index => $report)
                            <tr>
                                <td class="text-center">
                                    {{ ($resolved->currentPage() - 1) * $resolved->perPage() + $index + 1 }}
                                </td>
                                <td class="text-center">{{ $report->subject_type }}</td>
                                <td class="text-center">{{ $report->location }}</td>
                                <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center p-0">
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $report->id }}">
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $resolved->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- CLOSED --}}
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h3>Closed Reports</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Incident/Disaster Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Date and Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($closed as $index => $report)
                            <tr>
                                <td class="text-center">
                                    {{ ($closed->currentPage() - 1) * $closed->perPage() + $index + 1 }}
                                </td>
                                <td class="text-center">{{ $report->subject_type }}</td>
                                <td class="text-center">{{ $report->location }}</td>
                                <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center p-0">
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $report->id }}">
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $closed->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h3>Recent Reports</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead class="bg-info text-white">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Incident/Disaster Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Date and Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent as $index => $report)
                            <tr>
                                <td class="text-center">
                                    {{ ($recent->currentPage() - 1) * $recent->perPage() + $index + 1 }}
                                </td>
                                <td class="text-center">{{ $report->subject_type }}</td>
                                <td class="text-center">{{ $report->location }}</td>
                                <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center p-0">
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $report->id }}">
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $recent->links() }}
                </div>
            </div>
        </div>
    </div>

    @php
        $allReportsItems = $allReports->items();
        $pendingItems = $pending->items();
        $resolvedItems = $resolved->items();
        $closedItems = $closed->items();
        $recentItems = $recent->items();
    @endphp

    @foreach (array_merge($allReportsItems, $pendingItems, $resolvedItems, $closedItems, $recentItems) as $report)
        <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                        <p><strong>Location:</strong> {{ $report->location }}</p>
                        <p><strong>Description:</strong> {{ $report->description }}</p>
                        <p><strong>Date & Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>


                        @if ($report->image)
                            <div class="text-center mt-3">
                                <img src="{{ asset('image/' . $report->image) }}" class="img-fluid"
                                    alt="Report Image">
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
