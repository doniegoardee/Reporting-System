<div class="page-content scrollable-content bg-light">

    <div class="container mt-4">

        {{-- ALL REPORTS --}}
        <h3 class="mb-3">All Reports</h3>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>Incident/Disaster Type</th>
                        <th>Location</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allReports as $index => $report)
                        <tr>
                            <td class="text-center">
                                {{ ($allReports->currentPage() - 1) * $allReports->perPage() + $index + 1 }}</td>
                            <td>{{ $report->subject_type }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $report->id }}">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $allReports->links() }}
            </div>
        </div>

        {{-- PENDING REPORTS --}}
        <h3 class="mt-5 mb-3">Pending Reports</h3>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <thead class="table-warning">
                    <tr>
                        <th></th>
                        <th>Incident/Disaster Type</th>
                        <th>Location</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending as $index => $report)
                        <tr>
                            <td class="text-center">
                                {{ ($pending->currentPage() - 1) * $pending->perPage() + $index + 1 }}
                            </td>
                            <td>{{ $report->subject_type }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $report->id }}">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pending->links() }}
            </div>
        </div>

        {{-- RESOLVED REPORTS --}}
        <h3 class="mt-5 mb-3">Resolved Reports</h3>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <thead class="table-success">
                    <tr>
                        <th></th>
                        <th>Incident/Disaster Type</th>
                        <th>Location</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resolved as $index => $report)
                        <tr>
                            <td class="text-center">
                                {{ ($resolved->currentPage() - 1) * $resolved->perPage() + $index + 1 }}</td>
                            <td>{{ $report->subject_type }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $report->id }}">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $resolved->links() }}
            </div>
        </div>

        {{-- CLOSED REPORTS --}}
        <h3 class="mt-5 mb-3">Closed Reports</h3>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th></th>
                        <th>Incident/Disaster Type</th>
                        <th>Location</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($closed as $index => $report)
                        <tr>
                            <td class="text-center">
                                {{ ($closed->currentPage() - 1) * $closed->perPage() + $index + 1 }}
                            </td>
                            <td>{{ $report->subject_type }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $report->id }}">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $closed->links() }}
            </div>
        </div>

    </div>

    {{-- Modal --}}
    @php
        $allReportsItems = $allReports->items();
        $pendingItems = $pending->items();
        $resolvedItems = $resolved->items();
        $closedItems = $closed->items();
    @endphp

    @foreach (array_merge($allReportsItems, $pendingItems, $resolvedItems, $closedItems) as $report)
        <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                        <p><strong>Location:</strong> {{ $report->location }}</p>
                        <p><strong>Description:</strong> {{ $report->description }}</p>
                        <p><strong>Date & Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>

                        @if ($report->image)
                            <div class="text-center mt-3">
                                <img src="{{ asset('image/' . $report->image) }}" class="img-fluid rounded"
                                    style="width: 10rem; height: 10rem;"alt="Report Image">
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

</div>
