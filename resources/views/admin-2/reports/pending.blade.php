<!DOCTYPE html>
<html>

<head>

    @include('admin-2.contents.css')

</head>

<body>

    @include('admin-2.contents.header')


    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin-2.contents.sidebar')

        <!-- Sidebar Navigation end-->

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Pending Reports</h2>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Filter Reports</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin-2.filter-pending') }}">
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



            @foreach ($pending as $report)
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
                            </div>
                            <div class="modal-footer">
                                <form id="resolve-form{{ $report->id }}"
                                    action="{{ route('admin-2.update', ['id' => $report->id, 'status' => 'resolved']) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>

                                <form id="close-form{{ $report->id }}"
                                    action="{{ route('admin-2.update', ['id' => $report->id, 'status' => 'closed']) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>

                                <button type="button" class="btn btn-success"
                                    onclick="event.preventDefault(); document.getElementById('resolve-form{{ $report->id }}').submit();">Yes,
                                    Mark as Resolved</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            @include('admin-2.contents.footer')


</body>

</html>
