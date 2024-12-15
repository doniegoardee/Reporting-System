@extends('layouts.user-layout')

@section('content')
    @include('layouts.navigation')

    <style>
        .disabled-link {
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
}

    </style>

    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">
        <div class="page-content flex-grow-1 scrollable-content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h6>My Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Issue Type</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $report)
                                        <tr>
                                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                                            <td>{{ $report->subject_type }}</td>
                                            <td>{{ $report->location }}</td>
                                            <td>{{ ucfirst($report->status) }}</td>

                                            <td>

                                                <a class="btn btn-sm btn-primary {{ $report->status === 'resolved' ? 'disabled-link' : '' }}"
                                                    href="{{ $report->status === 'pending' ? route('reports.edit', $report->id) : '#' }}">
                                                    Edit
                                                </a>


                                                <a class="btn btn-sm btn-info" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewReportModal{{ $report->id }}">
                                                    View
                                                </a>

                                            </td>
                                        </tr>

                                        <!-- Modal for Viewing Report -->
                                        <div class="modal fade" id="viewReportModal{{ $report->id }}" tabindex="-1"
                                            aria-labelledby="viewReportModalLabel{{ $report->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="viewReportModalLabel{{ $report->id }}">
                                                            Report Details
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Subject Type:</strong> {{ $report->subject_type }}
                                                        </p>
                                                        <p><strong>Location:</strong> {{ $report->location }}</p>
                                                        <p><strong>Status:</strong> {{ ucfirst($report->status) }}</p>
                                                        <p><strong>Severity:</strong> {{ $report->severity }}</p>
                                                        <p><strong>Number Affected:</strong>
                                                            {{ $report->num_affected }}
                                                        </p>
                                                        @if ($report->image)
                                                            <p><strong>Image:</strong>
                                                                <img src="{{ asset('image/' . $report->image) }}"
                                                                    alt="Report Image" class="img-fluid rounded"
                                                                    style="max-width: 200px;">
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No reports found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $data->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->
@endsection
