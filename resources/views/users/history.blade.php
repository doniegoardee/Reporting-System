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
                        <h5>Incident History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Incident Name</th>
                                        <th>Location</th>
                                        <th>Details</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="incidentTable">
                                    @include('users.history-data', ['history' => $history])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
