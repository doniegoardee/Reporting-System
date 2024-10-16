<!DOCTYPE html>
<html>

<head>
    @include('admin-2.contents.css')
</head>

<body>
    @include('admin-2.contents.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation -->
        @include('admin-2.contents.sidebar')
        <!-- Sidebar Navigation end -->

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">All Reports</h2>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Filter Reports</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin-2.filter') }}">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <label for="report" class="form-label">Incident Type</label>
                                <select class="form-select" name="report" id="report">
                                    <option value="">Select Incident Type</option>
                                    @foreach ($incidentTypes as $incidentType)
                                        <option value="{{ $incidentType->id }}"
                                            {{ request('report') == $incidentType->id ? 'selected' : '' }}>
                                            {{ $incidentType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" name="location" class="form-select">
                                    <option value="">Select Location</option>
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
                                <button type="submit" class="btn btn-primary px-4">Filter</button>
                                <a href="{{ route('admin-2.filter') }}" class="btn btn-secondary ms-2 px-4">Clear
                                    Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card-body px-2 py-2">
                <button class="btn btn-success">Export PDF</button>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Incident/Disaster Type</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center">Status</th>
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
                                        <td class="text-center">{{ $report->status }}</td>
                                        <td class="text-center">{{ $report->created_at->format('d M Y, h:i A') }}</td>
                                        <td class="text-center">
                                            <a href="#"
                                                class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $report->id }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $allReports->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($allReports as $report)
                <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $report->id }}">Report Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                                <p><strong>Name:</strong> {{ $report->name }}</p>
                                <p><strong>Location:</strong> {{ $report->location }}</p>
                                <p><strong>Description:</strong> {{ $report->description }}</p>
                                <p><strong>Status:</strong> {{ $report->status }}</p>
                                <p><strong>Date & Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>

                                @if ($report->image)
                                    <div class="text-center mt-3">
                                        <img src="{{ asset('image/' . $report->image) }}" class="img-fluid"
                                            width="150rem" length="150rem" alt="Report Image">
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @include('admin-2.contents.footer')
        </div>
    </div>
</body>

</html>
