<x-app-layout>
    <div class="content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Closed Reports</h2>
                <hr class="mt-0">
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Filter Reports</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.filter-closed') }}">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label for="issue" class="form-label">Report Type</label>
                                <select class="form-select" name="issue" id="issue">
                                    <option value="" disabled {{ !request('issue') ? 'selected' : '' }}>
                                        Select Incident Type
                                    </option>
                                    @foreach ($incident as $incidentType)
                                        <option value="{{ $incidentType->id }}"
                                            {{ request('issue') == $incidentType->id ? 'selected' : '' }}>
                                            {{ $incidentType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" name="location" class="form-select">
                                    <option value="" disabled {{ !request('location') ? 'selected' : '' }}>
                                        Select Location
                                    </option>
                                    @foreach ($barangay as $barangays)
                                        <option value="{{ $barangays->id }}"
                                            {{ request('location') == $barangays->id ? 'selected' : '' }}>
                                            {{ $barangays->barangay }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control"
                                            value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            value="{{ request('end_date') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.filter-closed') }}" class="btn btn-secondary ms-2">Clear Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    @if ($closed->isEmpty())
                        <p class="text-center text-muted">No reports available.</p>
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
                                <tbody class="text-center">
                                    @foreach ($closed as $index => $report)
                                        <tr>
                                            <td>
                                                {{ ($closed->currentPage() - 1) * $closed->perPage() + $index + 1 }}
                                            </td>
                                            <td>{{ $report->subject_type }}</td>
                                            <td>{{ $report->location }}</td>
                                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                            <td class="p-0">
                                                <a href="#" class="btn btn-secondary mt-1" data-bs-toggle="modal"
                                                    data-bs-target="#reportModal{{ $report->id }}">
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

            @foreach ($closed as $report)
                <div class="modal fade" id="reportModal{{ $report->id }}" tabindex="-1"
                    aria-labelledby="reportModalLabel{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reportModalLabel{{ $report->id }}">Report Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Incident/Disaster Type:</strong> {{ $report->subject_type }}</p>
                                <p><strong>Location:</strong> {{ $report->location }}</p>
                                <p><strong>Date and Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>
                                <p><strong>Severity:</strong> {{ $report->severity }}</p>
                                <p><strong>Number of Affected People:</strong> {{ $report->num_affected }}</p>

                                @if ($report->image)
                                    <div class="text-center mt-3">
                                        <img src="{{ asset('images/' . $report->image) }}" class="img-fluid"
                                            width="200" alt="Report Image">
                                    </div>
                                    @else
                                    No image available
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

</x-app-layout>
