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
        <div class="page-content">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Report</h1>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('reports.update', $report->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="issue">Incident/Disaster Type</label>
                                    <select class="form-select" name="issue" id="issue" required>
                                        <option class="dropdown-item" value="flood"
                                            {{ $report->issue == 'flood' ? 'selected' : '' }}>Flood</option>
                                        <option class="dropdown-item" value="typhoon"
                                            {{ $report->issue == 'typhoon' ? 'selected' : '' }}>Typhoon</option>
                                        <option class="dropdown-item" value="earthquake"
                                            {{ $report->issue == 'earthquake' ? 'selected' : '' }}>Earthquake</option>
                                        <option class="dropdown-item" value="fire"
                                            {{ $report->issue == 'fire' ? 'selected' : '' }}>Fire</option>
                                        <option class="dropdown-item" value="medical"
                                            {{ $report->issue == 'medical' ? 'selected' : '' }}>Medical Emergency
                                        </option>
                                        <option class="dropdown-item" value="infrastructure"
                                            {{ $report->issue == 'infrastructure' ? 'selected' : '' }}>Infrastructure
                                            Damage</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <select class="form-select" name="location" id="location" required>
                                        <option class="dropdown-item" value="Centro"
                                            {{ $report->location == 'Centro' ? 'selected' : '' }}>Centro</option>
                                        <option class="dropdown-item" value="Centro West"
                                            {{ $report->location == 'Centro West' ? 'selected' : '' }}>Centro West
                                        </option>
                                        <option class="dropdown-item" value="Cabaritan"
                                            {{ $report->location == 'Cabaritan' ? 'selected' : '' }}>Cabaritan</option>
                                        <option class="dropdown-item" value="Santa Maria"
                                            {{ $report->location == 'Santa Maria' ? 'selected' : '' }}>Santa Maria
                                        </option>
                                        <option class="dropdown-item" value="Leron"
                                            {{ $report->location == 'Leron' ? 'selected' : '' }}>Leron</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="severity">Severity</label>
                                    <select class="form-select" name="severity" id="severity" required>
                                        <option class="dropdown-item" value="low"
                                            {{ $report->severity == 'low' ? 'selected' : '' }}>Low</option>
                                        <option class="dropdown-item" value="medium"
                                            {{ $report->severity == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option class="dropdown-item" value="high"
                                            {{ $report->severity == 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="affected_people">Number of People Affected</label>
                                    <input type="number" class="form-control" id="affected_people" name="num_affected"
                                        min="0" value="{{ $report->num_affected }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Details</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5" required>{{ $report->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="urgent_needs">Urgent Needs</label>
                                <textarea class="form-control" id="urgent_needs" name="needs" rows="3">{{ $report->needs }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                @if ($report->image)
                                    <div class="mb-3">
                                        <img src="{{ url('/image', $report->image) }}" class="img-fluid"
                                            style="max-width: 150px;" alt="Report Image">
                                    </div>
                                @endif
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Report</button>
                        </form>
                    </div>
                </div>
            </div>

            @include('users.contents.footer')

</body>

</html>
