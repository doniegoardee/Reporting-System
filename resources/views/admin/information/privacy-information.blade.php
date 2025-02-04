<x-app-layout>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header py-3">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Incident Categories</h2>
            </div>
        </div>

        <div class="container mt-4">
            @if ($list->isEmpty())
                <div class="no-data-message text-center py-4">
                    <p class="text-muted">No incident types have been created yet.</p>
                </div>
            @else
                <div class="row justify-content-center">
                    @foreach ($list as $incident)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <a href="{{ route('admin.reports.byIncident', ['subject_type' => $incident->name]) }}"
                               class="incident-box text-decoration-none">
                                <div class="card incident-card shadow-sm border-0"
                                     style="background-color: {{ $incident->color }}; color: #fff; border-radius: 10px; transition: transform 0.2s;">
                                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-between">
                                        <h5 class="incident-title mb-3" style="color: white; font-weight: bold;">
                                            {{ $incident->name }}
                                        </h5>
                                        @if (!empty($incident->image))
                                            <img src="{{ asset('images/' . $incident->image) }}"
                                                 alt="{{ $incident->name }}"
                                                 class="img-fluid incident-image rounded-circle"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        .incident-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
</x-app-layout>
