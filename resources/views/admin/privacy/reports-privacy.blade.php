<x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4">Manage Reports Privacy</h2>

        <!-- Filter Section -->
        <div class="mb-3 row">
            <!-- Privacy Filter -->
            <div class="col-md-4">
                <label for="privacyFilter" class="form-label"><strong>Filter by Privacy:</strong></label>
                <select id="privacyFilter" class="form-select">
                    <option value="all">All</option>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <!-- Subject Type Filter -->
            <div class="col-md-4">
                <label for="subjectFilter" class="form-label"><strong>Filter by Subject:</strong></label>
                <select id="subjectFilter" class="form-select">
                    <option value="all">All</option>
                    @foreach ($privacy->pluck('subject_type')->unique() as $subject)
                        <option value="{{ $subject }}">{{ ucfirst($subject) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Location Filter -->
            <div class="col-md-4">
                <label for="locationFilter" class="form-label"><strong>Filter by Location:</strong></label>
                <select id="locationFilter" class="form-select">
                    <option value="all">All</option>
                    @foreach ($privacy->pluck('location')->unique() as $location)
                        <option value="{{ $location }}">{{ ucfirst($location) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Location</th>
                        <th>Privacy</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($privacy as $index => $report)
                        <tr class="text-center report-row"
                            data-privacy="{{ $report->privacy }}"
                            data-subject="{{ $report->subject_type }}"
                            data-location="{{ $report->location }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->subject_type }}</td>
                            <td>{{ $report->location }}</td>
                            <td>
                                <span class="badge bg-{{ $report->privacy == 'public' ? 'primary' : 'secondary' }}">
                                    {{ ucfirst($report->privacy) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary toggle-privacy"
                                        data-id="{{ $report->id }}"
                                        data-privacy="{{ $report->privacy }}">
                                    Toggle Privacy
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for filtering and AJAX Privacy Toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const privacyFilter = document.getElementById("privacyFilter");
            const subjectFilter = document.getElementById("subjectFilter");
            const locationFilter = document.getElementById("locationFilter");

            // Function to filter rows
            function filterRows() {
                const selectedPrivacy = privacyFilter.value;
                const selectedSubject = subjectFilter.value;
                const selectedLocation = locationFilter.value;

                document.querySelectorAll(".report-row").forEach(row => {
                    const reportPrivacy = row.getAttribute("data-privacy");
                    const reportSubject = row.getAttribute("data-subject");
                    const reportLocation = row.getAttribute("data-location");

                    const privacyMatch = selectedPrivacy === "all" || reportPrivacy === selectedPrivacy;
                    const subjectMatch = selectedSubject === "all" || reportSubject === selectedSubject;
                    const locationMatch = selectedLocation === "all" || reportLocation === selectedLocation;

                    row.style.display = (privacyMatch && subjectMatch && locationMatch) ? "" : "none";
                });
            }

            // Event listeners for filters
            privacyFilter.addEventListener("change", filterRows);
            subjectFilter.addEventListener("change", filterRows);
            locationFilter.addEventListener("change", filterRows);

            // AJAX Toggle Privacy
            document.querySelectorAll(".toggle-privacy").forEach(button => {
                button.addEventListener("click", function () {
                    let reportId = this.getAttribute("data-id");
                    let currentPrivacy = this.getAttribute("data-privacy");
                    let newPrivacy = currentPrivacy === "public" ? "private" : "public";

                    fetch("{{ route('admin.reports.togglePrivacy') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id: reportId, privacy: newPrivacy })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Refresh page to update privacy status
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
