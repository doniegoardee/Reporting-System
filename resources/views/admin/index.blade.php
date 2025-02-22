<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Dashboard</h2>
                <hr class="mt-0">
            </div>
        </div>
        <div class="container-fluid mt-4">
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group" role="group" aria-label="Report Filters">
                    <a href="{{ route('admin.all-reports') }}" class="btn btn-outline-primary">
                        All Reports
                        <span class="badge bg-primary rounded-1 p-2 text-white">{{ $allReportsCount }}</span>
                    </a>

                    <a href="{{ route('admin.pending') }}" class="btn btn-outline-warning">
                        Pending Reports
                        <span class="badge bg-warning rounded-1 p-2 text-white">{{ $pendingCount }}</span>
                    </a>
                    <a href="{{ route('admin.resolved') }}" class="btn btn-outline-success">
                        Resolved Reports
                        <span class="badge bg-success rounded-1 p-2 text-white"> {{ $resolvedCount }}
                        </span>
                    </a>
                    <a href="{{ route('admin.closed') }}" class="btn btn-outline-secondary">
                        Closed Reports
                        <span class="badge bg-secondary rounded-1 p-2 text-white">{{ $closedCount }}</span>
                    </a>
                </div>
            </div>

            {{-- ALL REPORTS --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>All Reports</h5>
                </div>
                <div class="card-body">
                    @if ($allReports->isEmpty())
                        <p class="text-center text-muted">No reports available.</p>
                    @else
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center">No.</th>
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
                                            <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}
                                            </td>
                                            <td class="text-center">
                                                <a href="#"
                                                    class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $report->id }}">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $allReports->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- PENDING --}}
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5>Pending Reports</h5>
                </div>
                <div class="card-body">
                    @if ($pending->isEmpty())
                        <p class="text-center text-muted">No pending reports available.</p>
                    @else
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="bg-warning text-dark">
                                    <tr>
                                        <th class="text-center">No.</th>
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
                                            <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}
                                            </td>
                                            <td class="text-center">
                                                <a href="#"
                                                class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#pendingModal{{ $report->id }}">
                                                View
                                             </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $pending->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- RESOLVED --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5>Resolved Reports</h5>
                </div>
                <div class="card-body">
                    @if ($resolved->isEmpty())
                        <p class="text-center text-muted">No resolved reports available.</p>
                    @else
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th class="text-center">No.</th>
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
                                            <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}
                                            </td>
                                            <td class="text-center">
                                                <a href="#"
                                                    class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $report->id }}">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $resolved->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- CLOSED --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5>Closed Reports</h5>
                </div>
                <div class="card-body">
                    @if ($closed->isEmpty())
                        <p class="text-center text-muted">No closed reports available.</p>
                    @else
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th class="text-center">No.</th>
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
                                            <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}
                                            </td>
                                            <td class="text-center">
                                                <a href="#"
                                                    class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $report->id }}">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $closed->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @foreach ($pending as $report)
    <div class="modal fade" id="pendingModal{{ $report->id }}" tabindex="-1"
         aria-labelledby="exampleModalLabel{{ $report->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel{{ $report->id }}">Pending Report #{{ $report->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                    <p><strong>Location:</strong> {{ $report->location }}</p>
                    <p><strong>Description:</strong> {{ $report->description }}</p>
                    <p><strong>Reported by:</strong> {{ $report->name }}</p>
                    <p><strong>Date Reported:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($report->status) }}</p>
                    @if (!empty($report->image))
                        @php
                            $images = is_array($report->image) ? $report->image : json_decode($report->image, true);
                        @endphp
                        @if (!empty($images) && is_array($images))
                            @foreach ($images as $image)
                                <img src="{{ asset('images/' . $image) }}" alt="Report Image" style="width: 100%; margin-bottom: 10px;">
                            @endforeach
                        @else
                            <img src="{{ asset('images/' . $report->image) }}" alt="Report Image" style="width: 100%; margin-bottom: 10px;">
                        @endif
                    @else
                        <p class="text-muted">No images available for this report.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Modal for each report (for all sections) -->
@foreach ($allReports as $report)
<div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
     aria-labelledby="exampleModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{ $report->id }}">Report #{{ $report->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                <p><strong>Location:</strong> {{ $report->location }}</p>
                <p><strong>Description:</strong> {{ $report->description }}</p>
                <p><strong>Reported by:</strong> {{ $report->name }}</p>
                <p><strong>Date Reported:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($report->status) }}</p>
                @if (!empty($report->image))
                    @php
                        $images = is_array($report->image) ? $report->image : json_decode($report->image, true);
                    @endphp
                    @if (!empty($images) && is_array($images))
                        @foreach ($images as $image)
                            <img src="{{ asset('images/' . $image) }}" alt="Report Image" style="width: 100%; margin-bottom: 10px;">
                        @endforeach
                    @else
                        <img src="{{ asset('images/' . $report->image) }}" alt="Report Image" style="width: 100%; margin-bottom: 10px;">
                    @endif
                @else
                    <p class="text-muted">No images available for this report.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
</x-app-layout>
