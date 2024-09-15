<!DOCTYPE html>
<html>

<head>
    @include('admin-2.contents.css')
</head>

<body>
    @include('admin-2.contents.header')

    <div class="d-flex align-items-stretch">
        @include('admin-2.contents.sidebar')

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Resolved Reports</h2>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Filter Reports</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin-2.filter-resolved') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="issue" class="form-label">Report Type</label>
                                <select class="form-select" name="issue" id="issue">
                                    <option value="">Select Incident Type</option>
                                    <option value="flood" {{ request('issue') == 'flood' ? 'selected' : '' }}>Flood
                                    </option>
                                    <option value="typhoon" {{ request('issue') == 'typhoon' ? 'selected' : '' }}>
                                        Typhoon</option>
                                    <option value="earthquake" {{ request('issue') == 'earthquake' ? 'selected' : '' }}>
                                        Earthquake</option>
                                    <option value="fire" {{ request('issue') == 'fire' ? 'selected' : '' }}>Fire
                                    </option>
                                    <option value="medical" {{ request('issue') == 'medical' ? 'selected' : '' }}>
                                        Medical Emergency</option>
                                    <option value="infrastructure"
                                        {{ request('issue') == 'infrastructure' ? 'selected' : '' }}>Infrastructure
                                        Damage</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" name="location" class="form-select">
                                    <option value="">Select Location</option>
                                    <option value="Centro" {{ request('location') == 'Centro' ? 'selected' : '' }}>
                                        Centro</option>
                                    <option value="Centro West"
                                        {{ request('location') == 'Centro West' ? 'selected' : '' }}>Centro West
                                    </option>
                                    <option value="Cabaritan"
                                        {{ request('location') == 'Cabaritan' ? 'selected' : '' }}>Cabaritan</option>
                                    <option value="Santa Maria"
                                        {{ request('location') == 'Santa Maria' ? 'selected' : '' }}>Santa Maria
                                    </option>
                                    <option value="Leron" {{ request('location') == 'Leron' ? 'selected' : '' }}>Leron
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="created_at" class="form-label">Date</label>
                                <input type="date" id="created_at" name="created_at" class="form-control"
                                    value="{{ request('created_at') }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin-2.filter-resolved') }}" class="btn btn-secondary ms-2">Clear
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
                                                    class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2 me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $report->id }}">
                                                    View
                                                </a>

                                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal{{ $report->id }}">
                                                    Mark as Closed
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Confirmation Modal -->
                                    <div class="modal fade" id="confirmModal{{ $report->id }}" tabindex="-1"
                                        aria-labelledby="confirmModalLabel{{ $report->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmModalLabel{{ $report->id }}">
                                                        Confirm Action</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to mark this report as closed?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form
                                                        action="{{ route('admin-2.update', ['id' => $report->id, 'status' => 'closed']) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">Confirm</button>
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
                </div>
            </div>

            @include('admin-2.contents.footer')

</body>

</html>
