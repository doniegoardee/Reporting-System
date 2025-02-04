<x-app-layout>
    <div class="container mt-5">
        <a href="{{ route('admin.reports.byIncident', ['subject_type' => $report->subject_type]) }}" class="btn btn-outline-primary mb-4">
            ← Back to Reports
        </a>

        <div class="card shadow-lg rounded-lg">
            <div class="card-body">
                <h5 class="card-title mb-3">{{ $report->subject_type }} Report</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Location:</strong> {{ $report->location }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-{{ $report->status == 'resolved' ? 'success' : ($report->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($report->status) }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Reported By:</strong> {{ $report->name }}</p>
                        <p><strong>Date:</strong> {{ $report->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5 class="mb-3">Additional Information</h5>
            @foreach ($report->reportInfo as $info)
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <!-- Left side: Form with text area and buttons -->
                            <div class="col-md-5">
                                <form method="POST" action="{{ route('admin.reports.info.update', $info->id) }}" class="d-flex flex-column">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="details" class="form-control" required>{{ $info->details }}</textarea>
                                    <button type="submit" class="btn btn-outline-success btn-sm mt-2">Update</button>
                                </form>
                            </div>
                            <!-- Right side: Text content -->
                            <div class="col-md-7">
                                <p>{{ $info->details }}</p>
                            </div>
                        </div>

                        <!-- Row for Delete Form -->
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <form action="{{ route('admin.reports.info.delete', $info->id) }}" method="POST" class="d-inline w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm w-100">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <form method="POST" action="{{ route('admin.reports.info.store', $report->id) }}" class="mt-4">
                @csrf
                <textarea name="details" class="form-control" rows="3" placeholder="Add information..." required></textarea>
                <button type="submit" class="btn btn-primary mt-3">Add Information</button>
            </form>
        </div>
    </div>
</x-app-layout>
