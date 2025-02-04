@extends('layouts.user-layout')

@section('content')
    @include('layouts.navigation')

    <section id="contact" class="contact section mt-5">
        <div class="page-content">
            <div class="container mt-5">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">
                    <div class="card-header text-center">
                        <h5>View Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Subject:</strong> {{ $view->subject_type }}</p>
                        <p><strong>Location:</strong> {{ $view->location }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge bg-{{ $view->status == 'resolved' ? 'success' : ($view->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($view->status) }}
                            </span>
                        </p>

                        <h5 class="mt-4">Additional Details</h5>
                        @forelse ($view->reportInfo as $info)
                            <div class="card mt-2">
                                <div class="card-body">
                                    <p>{{ $info->details }}</p>
                                    <p class="text-muted">Added on: {{ $info->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No additional details available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
