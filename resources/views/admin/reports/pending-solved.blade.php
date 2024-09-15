<!DOCTYPE html>
<html>

<head>
    @include('admin.contents.css')
</head>

<body>
    @include('admin.contents.header')
    <div class="d-flex align-items-stretch">
        @include('admin.contents.sidebar')
        <div class="page-content scrollable-content">
            <div class="container mt-5">

                <!-- Filtering Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Filter Reports</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('status') }}">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="report" class="form-label">Report Type</label>
                                    <select id="report" name="report" class="form-control">
                                        <option value="">Select Report Type</option>
                                        <option value="theft" {{ request('report') == 'theft' ? 'selected' : '' }}>
                                            Theft</option>
                                        <option value="vandalism"
                                            {{ request('report') == 'vandalism' ? 'selected' : '' }}>Vandalism</option>
                                        <option value="public_disturbance"
                                            {{ request('report') == 'public_disturbance' ? 'selected' : '' }}>Public
                                            Disturbance</option>
                                        <option value="littering/dumping"
                                            {{ request('report') == 'littering/dumping' ? 'selected' : '' }}>
                                            Littering/Dumping</option>
                                        <option value="harassment"
                                            {{ request('report') == 'harassment' ? 'selected' : '' }}>Harassment
                                        </option>
                                        <option value="assault" {{ request('report') == 'assault' ? 'selected' : '' }}>
                                            Assault</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="location" class="form-label">Location</label>
                                    <select id="location" name="location" class="form-control">
                                        <option value="">Select Location</option>
                                        <option value="Centro" {{ request('location') == 'Centro' ? 'selected' : '' }}>
                                            Centro</option>
                                        <option value="Centro West"
                                            {{ request('location') == 'Centro West' ? 'selected' : '' }}>Centro West
                                        </option>
                                        <option value="Cabaritan"
                                            {{ request('location') == 'Cabaritan' ? 'selected' : '' }}>Cabaritan
                                        </option>
                                        <option value="Santa Maria"
                                            {{ request('location') == 'Santa Maria' ? 'selected' : '' }}>Santa Maria
                                        </option>
                                        <option value="Leron" {{ request('location') == 'Leron' ? 'selected' : '' }}>
                                            Leron
                                        </option>
                                        <option value="Mala Weste"
                                            {{ request('location') == 'Mala Weste' ? 'selected' : '' }}>Mala Weste
                                        </option>
                                        <option value="Mala Este"
                                            {{ request('location') == 'Mala Este' ? 'selected' : '' }}>Mala Este
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="created_at" class="form-label">Date</label>
                                    <input type="date" id="created_at" name="created_at" class="form-control"
                                        value="{{ request('created_at') }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                                    <a href="{{ route('status') }}" class="btn btn-secondary">Clear Filter</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Pending Reports -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Pending Reports</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Issue Type</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Description</th>
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
                                            <td class="text-center">{{ $report->description }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalPending{{ $report->id }}">View</a>
                                                <a href="{{ route('admin.update-status', ['id' => $report->id, 'status' => 'solved']) }}"
                                                    class="btn btn-success btn-sm">Resolved</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <!-- Pagination Links for Pending Reports -->
                            @if ($pending->total() > $pending->perPage())
                                {{ $pending->appends(request()->except('page'))->links('pagination::bootstrap-4', ['paginator' => $pending]) }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Resolved Reports -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">Resolved Reports</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Issue Type</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solved as $index => $report)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($solved->currentPage() - 1) * $solved->perPage() + $index + 1 }}
                                            </td>
                                            <td class="text-center">{{ $report->subject_type }}</td>
                                            <td class="text-center">{{ $report->location }}</td>
                                            <td class="text-center">{{ $report->description }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalSolved{{ $report->id }}">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <!-- Pagination Links for Resolved Reports -->
                            @if ($solved->total() > $solved->perPage())
                                {{ $solved->appends(request()->except('page'))->links('pagination::bootstrap-4', ['paginator' => $solved]) }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Rejected Reports -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Rejected Reports</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Issue Type</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rejected as $index => $report)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($rejected->currentPage() - 1) * $rejected->perPage() + $index + 1 }}
                                            </td>
                                            <td class="text-center">{{ $report->subject_type }}</td>
                                            <td class="text-center">{{ $report->location }}</td>
                                            <td class="text-center">{{ $report->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <!-- Pagination Links for Rejected Reports -->
                            @if ($rejected->total() > $rejected->perPage())
                                {{ $rejected->appends(request()->except('page'))->links('pagination::bootstrap-4', ['paginator' => $rejected]) }}
                            @endif
                        </div>
                    </div>
                </div>



                <div class="card-body px-2 py-2">
                    <button class="btn btn-success">Import PDF</button>
                </div>

                <!-- Modals for Pending Reports -->
                @foreach ($pending as $report)
                    <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-5">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-semibold" id="exampleModalLabel">Pending Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Name:</b> {{ $report->name }}</p>
                                    <p><b>Report Type:</b> {{ $report->subject_type }}</p>
                                    <p><b>Location:</b> {{ $report->location }}</p>
                                    <p><b>Description:</b> {{ $report->description }}</p>
                                    <p><b>Image:</b>
                                        @if ($report->image)
                                            <img src="{{ asset('image/' . $report->image) }}"
                                                class="rounded-3 border" width="200" height="200"
                                                alt="Report Image">
                                        @endif
                                    </p>
                                </div>
                                <div class="modal-footer py-0">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modals for Solved Reports -->
                @foreach ($solved as $report)
                    <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-5">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-semibold" id="exampleModalLabel">Resolved Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Name:</b> {{ $report->name }}</p>
                                    <p><b>Report Type:</b> {{ $report->subject_type }}</p>
                                    <p><b>Location:</b> {{ $report->location }}</p>
                                    <p><b>Description:</b> {{ $report->description }}</p>
                                    <p><b>Image:</b>
                                        @if ($report->image)
                                            <img src="{{ asset('image/' . $report->image) }}"
                                                class="rounded-3 border" width="200" height="200"
                                                alt="Report Image">
                                        @endif
                                    </p>
                                </div>
                                <div class="modal-footer py-0">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @include('admin.contents.footer')
            </div>
        </div>
</body>

</html>
