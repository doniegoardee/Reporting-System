@extends('layouts.user-layout')

@section('content')
    @include('layouts.navigation')

    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">

        <div class="page-content">
            <div class="container mt-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Edit Report</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('reports.update', $report->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="subject_type">Incident/Disaster Type</label>
                                    <select class="form-select" name="subject_type" id="subject_type" required>
                                        @foreach ($incidentTypes as $incident)
                                            <option value="{{ $incident->name }}"
                                                {{ $report->subject_type == $incident->name ? 'selected' : '' }}>
                                                {{ $incident->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <select class="form-select" name="location" id="location" required>
                                        @foreach ($barangay as $barangay)
                                            <option value="{{ $barangay->barangay }}"
                                                {{ $report->location == $barangay->barangay ? 'selected' : '' }}>
                                                {{ $barangay->barangay }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="severity">Severity</label>
                                    <select class="form-select" name="severity" id="severity" required>
                                        <option value="low" {{ $report->severity == 'low' ? 'selected' : '' }}>Low
                                        </option>
                                        <option value="medium" {{ $report->severity == 'medium' ? 'selected' : '' }}>
                                            Medium</option>
                                        <option value="high" {{ $report->severity == 'high' ? 'selected' : '' }}>High
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="affected_people">Number of People Affected</label>
                                    <input type="number" class="form-control" id="affected_people" name="num_affected"
                                        min="0" value="{{ $report->num_affected }}">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Details</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5" required>{{ $report->description }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="urgent_needs">Urgent Needs</label>
                                <textarea class="form-control" id="urgent_needs" name="needs" rows="3">{{ $report->needs }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="image">Image</label>
                                @if ($report->image)
                                    <div class="mb-3">
                                        <img src="{{ url('/image', $report->image) }}" class="img-fluid img-thumbnail"
                                            style="max-width: 150px;" alt="Report Image">
                                    </div>
                                @endif
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-block">Update Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->
@endsection
