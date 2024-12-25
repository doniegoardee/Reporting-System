<x-agency-layout>

    @if ($reports->isEmpty())
        <p>No reports found for this agency.</p>
    @else
        <table class="table text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Incident Type</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date</th>
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
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>

                        <td>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewReportModal-{{ $report->id }}">
                                View
                            </button>
                            {{-- <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#resolveModal{{ $report->id }}" style="flex: 1; text-align: center;">
                                Mark as Resolved
                            </a> --}}
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

                    {{-- <div class="modal fade" id="resolveModal{{ $report->id }}" tabindex="-1"
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
                                    <p><strong>Date & Time:</strong> {{ $report->created_at->format('d M Y, h:i A') }}
                                    </p>

                                    <div class="mb-3">
                                        <label for="resolved-time{{ $report->id }}" class="form-label">Resolved
                                            Time</label>
                                        <input type="datetime-local" class="form-control"
                                            id="resolved-time{{ $report->id }}" name="resolved_time" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form id="resolve-form{{ $report->id }}"
                                        action="{{ route('mark', ['id' => $report->id, 'status' => 'resolved']) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="responding_agency"
                                            id="hidden-responding-agency{{ $report->id }}">
                                        <input type="hidden" name="resolved_time"
                                            id="hidden-resolved-time{{ $report->id }}">
                                    </form>

                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitResolveForm({{ $report->id }})">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    @endif

    <script>
        function submitResolveForm(reportId) {
            const resolvedTimeInput = document.getElementById('resolved-time' + reportId);

            document.getElementById('hidden-resolved-time' + reportId).value = resolvedTimeInput.value;

            document.getElementById('resolve-form' + reportId).submit();
        }
    </script>

</x-agency-layout>
