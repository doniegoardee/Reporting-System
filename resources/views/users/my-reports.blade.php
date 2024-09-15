<!DOCTYPE html>
<html>

<head>
    @include('users.contents.css')
</head>

<body>
    @include('users.contents.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('users.contents.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content flex-grow-1 scrollable-content">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h1>My Reports</h1>
                    </div>
                    <div class="card-body">
                        @forelse ($data as $report)
                            <div class="report-item mb-4 p-3 border rounded">
                                @if ($report->image)
                                    <div class="mb-3">
                                        <img src="{{ url('/image', $report->image) }}" class="img-fluid"
                                            style="max-width: 150px;" alt="Report Image">
                                    </div>
                                @endif
                                <div>
                                    <h5>Issue Type: {{ $report->subject_type }}</h5>
                                    <p><strong>Status:</strong> {{ $report->status }}</p>
                                    <p><strong>Description:</strong> {{ $report->description }}</p>

                                    @if ($report->status !== 'closed')
                                        <a class="btn btn-primary {{ $report->status === 'resolved' ? 'disabled-link' : '' }}"
                                            href="{{ $report->status === 'pending' || $report->status === 'resolved' ? route('reports.edit', $report->id) : '#' }}">
                                            Edit
                                        </a>
                                    @endif

                                    @if ($report->status === 'closed')
                                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                            data-bs-target="#viewReportModal">
                                            View
                                        </a>
                                    @endif

                                    <!-- Modal Structure -->
                                    <div class="modal fade" id="viewReportModal" tabindex="-1"
                                        aria-labelledby="viewReportModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewReportModalLabel">Report Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
                                                    <p><strong>Location:</strong> {{ $report->location }}</p>
                                                    <p><strong>Status:</strong> {{ $report->status }}</p>
                                                    <p><strong>Description:</strong> {{ $report->description }}</p>
                                                    <p><strong>Severity:</strong> {{ $report->severity }}</p>
                                                    <p><strong>Number Affected:</strong> {{ $report->num_affected }}
                                                    </p>
                                                    @if ($report->image)
                                                        <p><strong>Image:</strong> <img
                                                                src="{{ asset('storage/' . $report->image) }}"
                                                                alt="Report Image" class="img-fluid"></p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .disabled-link {
                                            pointer-events: none;
                                            cursor: not-allowed;
                                            opacity: 0.6;
                                        }
                                    </style>



                                </div>
                            </div>
                        @empty
                            <p>No reports found.</p>
                        @endforelse
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $data->onEachSide(1)->links() }}
                </div>
            </div>

            @include('users.contents.footer')
        </div>
    </div>
</body>

</html>
