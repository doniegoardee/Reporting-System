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
                        <td> @if($report->status === 'resolved' || $report->status === 'closed')
                            Completed
                        @else
                            {{ ucfirst($report->status) }}
                        @endif</td>
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
                                    <p><strong>Status:</strong>
                                        @if($report->status === 'resolved' || $report->status === 'closed')
                                            Completed
                                        @else
                                            {{ ucfirst($report->status) }}
                                        @endif
                                    </p>
                                    <p><strong>Contact:</strong> {{ $report->contact }}</p>
                                    <p><strong>Email:</strong> {{ $report->email }}</p>
                                    @if ($report->image)
                                    <p><strong>Image:</strong>
                                        <img src="{{ asset('images/' . $report->image) }}"
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
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    @endif

</x-agency-layout>
