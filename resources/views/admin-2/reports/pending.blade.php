<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Pending Reports</h2>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Filter Reports</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin-2.filter-pending') }}">
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
                                <a href="{{ route('admin-2.filter-pending') }}" class="btn btn-secondary ms-2">Clear
                                    Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">

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
                                                    class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2 me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $report->id }}">
                                                    View
                                                </a>

                                                <a href="" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#resolveModal{{ $report->id }}">
                                                    Mark as Resolved
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


            @foreach ($pending as $report)
                <!-- Modal for Viewing Report Details -->
                <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $report->id }}">Report Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                                <p><strong>Location:</strong> {{ $report->location }}</p>
                                <p><strong>Description:</strong> {{ $report->description }}</p>
                                <p><strong>Date & Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>
                                <p><strong>Responding Agency:</strong> {{ $report->responding_agency ?? 'N/A' }}</p>
                                <p><strong>Resolved Time:</strong>
                                    {{ $report->resolved_at ? $report->resolved_at->format('d M Y, h:i A') : 'Not resolved yet' }}
                                </p>

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

                <!-- Modal for Marking Report as Resolved -->
                <div class="modal fade" id="resolveModal{{ $report->id }}" tabindex="-1"
                    aria-labelledby="resolveModalLabel{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="resolveModalLabel{{ $report->id }}">Mark Report as
                                    Resolved</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to mark this report as resolved?</p>
                                <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                                <p><strong>Location:</strong> {{ $report->location }}</p>
                                <p><strong>Date & Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>

                                <div class="mb-3">
                                    <label for="responding-agency{{ $report->id }}" class="form-label">Responding
                                        Agency</label>
                                    <input type="text" class="form-control"
                                        id="responding-agency{{ $report->id }}" name="responding_agency" required>
                                </div>

                                <div class="mb-3">
                                    <label for="resolved-time{{ $report->id }}" class="form-label">Resolved
                                        Time</label>
                                    <input type="datetime-local" class="form-control"
                                        id="resolved-time{{ $report->id }}" name="resolved_time" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form id="resolve-form{{ $report->id }}"
                                    action="{{ route('admin-2.update', ['id' => $report->id, 'status' => 'resolved']) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="responding_agency"
                                        id="hidden-responding-agency{{ $report->id }}">
                                    <input type="hidden" name="resolved_time"
                                        id="hidden-resolved-time{{ $report->id }}">
                                </form>

                                <button type="button" class="btn btn-success"
                                    onclick="event.preventDefault();
                                document.getElementById('hidden-responding-agency{{ $report->id }}').value = document.getElementById('responding-agency{{ $report->id }}').value;
                                document.getElementById('hidden-resolved-time{{ $report->id }}').value = document.getElementById('resolved-time{{ $report->id }}').value;
                                document.getElementById('resolve-form{{ $report->id }}').submit();">Yes,
                                    Mark as Resolved</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

</x-app-layout>
