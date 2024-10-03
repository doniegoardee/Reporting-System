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

        <div class="page-content">
            <div class="container mt-5">
                <div class="card shadow-sm rounded">
                    <div class="card-header">
                        <h1 class="h4 mb-0">Create New Report</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="subject_type" value="{{ $subject_type }}">

                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <select class="form-select" name="location" id="location" required>
                                    <option value="" disabled selected>Select a location</option>
                                    @foreach ($barangay as $barangay)
                                        <option value="{{ $barangay->barangay }}">{{ $barangay->barangay }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="severity" class="form-label">Severity</label>
                                    <select class="form-select" name="severity" id="severity" required>
                                        <option value="" disabled selected>Select severity</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="affected_people" class="form-label">Number of People Affected</label>
                                    <input type="number" class="form-control" id="affected_people" name="num_affected"
                                        min="0">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea class="form-control" name="details" id="details" cols="30" rows="5" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="urgent_needs" class="form-label">Urgent Needs</label>
                                <textarea class="form-control" id="urgent_needs" name="needs" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input" id="addAsterisk" name="addAsterisk"
                                        value="1">
                                    <label class="form-check-label" for="addAsterisk">Hide information</label>
                                </div>

                                <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation end-->
        @include('users.contents.footer')
    </div>
</body>

</html>
