<div class="page-content scrollable-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>

    <div class="container mt-3">
        <!-- Overview Cards -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-1">
                <div class="card text-white bg-info rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Reports</h5>
                        <p class="card-text">{{ $adminreport }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-1">
                <div class="card text-white bg-secondary rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Pending Reports</h5>
                        <p class="card-text">{{ $pendingreport }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-1">
                <div class="card text-white bg-success rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Solved Reports</h5>
                        <p class="card-text">{{ $solvedreport }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Reports -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Total Reports</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Issue Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $index => $report)
                            <tr>
                                <td class="text-center">
                                    {{ ($reports->currentPage() - 1) * $reports->perPage() + $index + 1 }}</td>
                                <td class="text-center">{{ $report->subject_type }}</td>
                                <td class="text-center">{{ $report->location }}</td>
                                <td>
                                    <div class="d-flex justify-content-center p-0">
                                        {{-- View --}}
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $report->id }}">
                                            {{-- <i class="fas fa-fw fa-magnifying-glass fs-5 me-3 text-success"></i> --}}
                                            View
                                        </a>

                                    </div>
                                </td>
                                {{-- <td class="text-center">
                                    @if ($report->image)
                                        <img src="{{ asset('image/' . $report->image) }}" width="30" height="30"
                                            alt="Report Image">
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                @if ($reports->total() > $reports->perPage())
                    {{ $reports->onEachSide(1)->links() }}
                @endif
            </div>
        </div>

        <!-- Resolved Reports -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Resolved Reports</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Issue Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resolved as $index => $resolve)
                            <tr>
                                <td class="text-center">
                                    {{ ($resolved->currentPage() - 1) * $resolved->perPage() + $index + 1 }}</td>
                                <td class="text-center">{{ $resolve->subject_type }}</td>
                                <td class="text-center">{{ $resolve->location }}</td>
                                <td>
                                    <div class="d-flex justify-content-center p-0">
                                        {{-- View --}}
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $resolve->id }}">
                                            {{-- <i class="fas fa-fw fa-magnifying-glass fs-5 me-3 text-success"></i> --}}
                                            View
                                        </a>

                                    </div>
                                </td>
                                {{-- <td class="text-center">
                                    @if ($resolve->image)
                                        <img src="{{ asset('image/' . $resolve->image) }}" width="30"
                                            height="30" alt="Report Image">
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                @if ($resolved->total() > $resolved->perPage())
                    {{ $resolved->onEachSide(1)->links() }}
                @endif
            </div>
        </div>

        <!-- Pending Reports -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Pending Reports</h3>
            </div>
            <div class="card-body">
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Issue Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending as $index => $pendings)
                            <tr>
                                <td class="text-center">
                                    {{ ($pending->currentPage() - 1) * $pending->perPage() + $index + 1 }}</td>
                                <td class="text-center">{{ $pendings->subject_type }}</td>
                                <td class="text-center">{{ $pendings->location }}</td>
                                <td>
                                    <div class="d-flex justify-content-center p-0">
                                        {{-- View --}}
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $pendings->id }}">
                                            {{-- <i class="fas fa-fw fa-magnifying-glass fs-5 me-3 text-success"></i> --}}
                                            View
                                        </a>

                                    </div>
                                </td>
                                {{-- <td class="text-center">
                                    @if ($pending->image)
                                        <img src="{{ asset('image/' . $pending->image) }}" width="30"
                                            height="30" alt="Report Image">
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                @if ($pending->total() > $pending->perPage())
                    {{ $pending->onEachSide(1)->links() }}
                @endif
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Recent Reports</h3>
            </div>
            <div class="card-body">
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Issue Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent as $index => $recents)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $recents->subject_type }}</td>
                                <td class="text-center">{{ $recents->location }}</td>
                                <td>
                                    <div class="d-flex justify-content-center p-0">
                                        {{-- View --}}
                                        <a href="#"
                                            class="bg-secondary text-light fw-semibold text-decoration-none rounded-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $recents->id }}">
                                            {{-- <i class="fas fa-fw fa-magnifying-glass fs-5 me-3 text-success"></i> --}}
                                            View
                                        </a>

                                    </div>
                                </td>
                                {{-- <td class="text-center">
                                    @if ($recent->image)
                                        <img src="{{ asset('image/' . $recent->image) }}" width="30" height="30"
                                            alt="Report Image">
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @foreach ($reports as $report)
        <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold " id="exampleModalLabel">Report
                            Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Add your appointment details here --}}
                        <p><b>Name:</b> {{ $report->name }}</p>
                        <p><b>Report Type:</b> {{ $report->subject_type }}</p>
                        <p><b>Location:</b> {{ $report->location }}</p>
                        <p><b>Description:</b> {{ $report->description }}</p>
                        <p><b>Image:</b>
                            @if ($report->image)
                                <img src="{{ asset('image/' . $report->image) }}" class="rounded-3 border"
                                    width="200" height="200" alt="Report Image">
                            @endif
                        </p>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal --}}
    @foreach ($resolved as $resolved)
        <div class="modal fade" id="exampleModal{{ $resolved->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold " id="exampleModalLabel">Resolved Report
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Add your appointment details here --}}
                        <p><b>Name:</b> {{ $resolved->name }}</p>
                        <p><b>Report Type:</b> {{ $resolved->subject_type }}</p>
                        <p><b>Location:</b> {{ $resolved->location }}</p>
                        <p><b>Description:</b> {{ $resolved->description }}</p>
                        <p><b>Image:</b>
                            @if ($resolved->image)
                                <img src="{{ asset('image/' . $resolved->image) }}" class="rounded-3 border"
                                    width="200" height="200" alt="Report Image">
                            @endif
                        </p>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal --}}
    @foreach ($pending as $pendings)
        <div class="modal fade" id="exampleModal{{ $pendings->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold " id="exampleModalLabel">Pending Report
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Add your appointment details here --}}
                        <p><b>Name:</b> {{ $pendings->name }}</p>
                        <p><b>Report Type:</b> {{ $pendings->subject_type }}</p>
                        <p><b>Location:</b> {{ $pendings->location }}</p>
                        <p><b>Description:</b> {{ $pendings->description }}</p>
                        <p><b>Image:</b>
                            @if ($pendings->image)
                                <img src="{{ asset('image/' . $pendings->image) }}" class="rounded-3 border"
                                    width="200" height="200" alt="Report Image">
                            @endif
                        </p>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal --}}
    @foreach ($recent as $recents)
        <div class="modal fade" id="exampleModal{{ $recents->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold " id="exampleModalLabel">Recent Reports</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Add your appointment details here --}}
                        <p><b>Name:</b> {{ $recents->name }}</p>
                        <p><b>Report Type:</b> {{ $recents->subject_type }}</p>
                        <p><b>Location:</b> {{ $recents->location }}</p>
                        <p><b>Description:</b> {{ $recents->description }}</p>
                        <p><b>Image:</b>
                            @if ($recents->image)
                                <img src="{{ asset('image/' . $recents->image) }}" class="rounded-3 border"
                                    width="200" height="200" alt="Report Image">
                            @endif
                        </p>

                    </div>
                    <div class="modal-footer py-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
