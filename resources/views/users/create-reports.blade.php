@extends('layouts.user-layout')

@section('content')
    @include('layouts.navigation')

    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">
        <div class="page-content">
            <div class="container mt-5">
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

                <div class="card shadow-sm rounded">
                    <div class="card-header">
                        <h1 class="h4 mb-0">Report an Incident</h1>
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

<p>Additional Details</p>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="severity" class="form-label">Severity</label>
                                    <select class="form-select" name="severity" id="severity">
                                        <option value="" disabled selected>Select severity</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="affected_people" class="form-label">Number of Household Affected</label>
                                    <input type="number" class="form-control" id="affected_people" name="num_affected"
                                        min="0">
                                </div>
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

    </section><!-- /Hero Section -->
@endsection
