<x-app-layout>
    <div class="content">
        <div class="container-fluid">

            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Seminar</h2>
                    <hr class="mt-0">
                </div>
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Desription</th>
                        <th>Location</th>
                        <th>Date</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seminar as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->location }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->date)->format('F d, Y') }}</td>
                            {{-- <td></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
