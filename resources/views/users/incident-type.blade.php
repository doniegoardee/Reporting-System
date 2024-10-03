<!DOCTYPE html>
<html>

<head>
    @include('users.contents.css')
    <style>
        .incident-card {
            width: 200px;
            /* You can keep or adjust this based on your preference */
            height: 200px;
            /* You can keep or adjust this based on your preference */
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
    </style>
</head>

<body>
    @include('users.contents.header')

    <div class="d-flex align-items-stretch">
        @include('users.contents.sidebar')

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Incident Types</h2>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row">
                    @foreach ($incidentTypes as $incident)
                        <div class="col-md-3 mb-4"> <!-- Changed from col-md-4 to col-md-3 -->
                            <a href="{{ route('user.create', ['subject_type' => $incident->name]) }}" class="incident-box"
                                style="text-decoration: none;">
                                <div class="card incident-card text-center"
                                    style="background-color: {{ $incident->color }}; color: #fff;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="incident-title">{{ $incident->name }}</h5>
                                        <img src="{{ asset('images/' . $incident->image) }}"
                                            alt="{{ $incident->name }} " class="img-fluid incident-image">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            @include('users.contents.footer')
        </div>
    </div>
</body>

</html>
