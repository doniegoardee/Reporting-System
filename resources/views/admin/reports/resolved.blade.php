<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Dashboard</h2>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Filter Reports</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.filter-resolved') }}">
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
                                <a href="{{ route('admin.filter-resolved') }}" class="btn btn-secondary ms-2">Clear
                                    Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">

                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    iconColor: 'white',
                                    customClass: {
                                        popup: 'colored-toast',
                                    },
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Report closed'
                                });
                            });
                        </script>
                    @endif

                    @if ($resolved->isEmpty())
                        <div class="alert text-center" role="alert">
                            No reports available.
                        </div>
                    @else
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-striped table-hover">
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
                                            <td class="text-center p-0">
                                                <a href="#"
                                                    class="btn btn-secondary mt-1 fw-semibold text-decoration-none rounded-1 me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $report->id }}">
                                                    View
                                                </a>

                                                <a href="#" class="btn btn-success mt-1" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal{{ $report->id }}">
                                                    Mark as Closed
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- View Modal -->
                                        <div class="modal fade" id="viewModal{{ $report->id }}" tabindex="-1"
                                            aria-labelledby="viewModalLabel{{ $report->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel{{ $report->id }}">
                                                            Report Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Incident Type:</strong> {{ $report->subject_type }}
                                                        </p>
                                                        <p><strong>Location:</strong> {{ $report->location }}</p>
                                                        <p><strong>Status:</strong> {{ $report->status }}</p>
                                                        <p><strong>Created At:</strong>
                                                            {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y, h:i A') }}
                                                        </p>
                                                        <p><strong>Responding Agency:</strong>
                                                            {{ $report->responding_agency ?? 'N/A' }}</p>
                                                        <p><strong>Resolved Time:</strong>
                                                            {{ $report->resolved_time ? \Carbon\Carbon::parse($report->resolved_time)->format('d M Y, h:i A') : 'N/A' }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Confirmation Modal -->
                                        <div class="modal fade" id="confirmModal{{ $report->id }}" tabindex="-1"
                                            aria-labelledby="confirmModalLabel{{ $report->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="confirmModalLabel{{ $report->id }}">
                                                            Confirm Action</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to mark this report as closed?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form
                                                            action="{{ route('admin.update', ['id' => $report->id, 'status' => 'closed']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-success">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End of Modal -->
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
        </div>
    </div>
</x-app-layout>
