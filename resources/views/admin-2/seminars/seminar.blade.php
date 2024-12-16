<x-app-layout>
    <h1>Seminar</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Desription</th>
                <th>Location</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seminar as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->location }}</td>
                    <td>{{ $data->date }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
