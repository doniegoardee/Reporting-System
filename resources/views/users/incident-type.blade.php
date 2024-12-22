@extends('layouts.user-layout')

@section('content')
    @include('layouts.navigation')
    <style>
        .incident-card {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            padding: 10px;
        }

        .incident-title {
            font-size: 1.1rem;
            margin-top: 15px;
        }

        .incident-image {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .no-data-message {
            text-align: center;
            color: #6c757d;
            font-size: 1.2rem;
            margin-top: 50px;
            font-weight: bold;
        }
    </style>
    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">
        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom text-center fw-600"></h2>
                </div>
            </div>

            <div class="container mt-4">
                @if ($incidentTypes->isEmpty())
                    <div class="no-data-message">
                        <p>No incident types have been created yet.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach ($incidentTypes as $incident)
                            <div class="col-md-3 mb-4">
                                <a href="{{ route('user.create', ['subject_type' => $incident->name]) }}"
                                    class="incident-box" style="text-decoration: none;">
                                    <div class="card incident-card text-center"
                                        style="background-color: {{ $incident->color }}; color: #fff;">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5  style="color:white;  class="incident-title">{{ $incident->name }}</h5>
                                            @if (!empty($incident->image))
                                                <img src="{{ asset('images/' . $incident->image) }}"
                                                    alt="{{ $incident->name }}" class="img-fluid incident-image">
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @include('users.contents.footer')
        </div>
    </section><!-- /Hero Section -->
@endsection
