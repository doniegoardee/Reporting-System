<x-agency-layout>


    @if ($reports->isEmpty())
        <p>No reports found for this agency.</p>
    @else
        <table class="table text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Incident Type</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $index => $report)
                    <tr>
                        <td class="text-center">
                            {{ ($reports->currentPage() - 1) * $reports->perPage() + $index + 1 }}
                        </td>
                        <td>{{ $report->subject_type }}</td>
                        <td>{{ $report->location }}</td>
                        <td>{{ ucfirst($report->status) }}</td>
                        <td>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewReportModal-{{ $report->id }}">
                                View
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="viewReportModal-{{ $report->id }}" tabindex="-1"
                        aria-labelledby="viewReportModalLabel-{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewReportModalLabel-{{ $report->id }}">
                                        Report Details
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Incident Type:</strong> {{ $report->subject_type }}</p>
                                    <p><strong>Location:</strong> {{ $report->location }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($report->status) }}</p>
                                    <p><strong>Contact:</strong> {{ $report->contact }}</p>
                                    <p><strong>Email:</strong> {{ $report->email }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    @endif

</x-agency-layout>
