<!DOCTYPE html>
<html>

<head>
    <title>PDF Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #007bff;
            /* Bootstrap primary color */
            text-align: center;
            margin-bottom: 20px;
        }

        th {
            background-color: #f8f9fa;
            /* Bootstrap table header background color */
        }

        .table td,
        .table th {
            vertical-align: middle;
            /* Align table cells vertically centered */
        }
    </style>
</head>

<body>
    <h1>User Report</h1>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Issue</th>
                <th>Location</th>
                <th>Details</th>
                <!-- Add other headers as necessary -->
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report['id'] }}</td>
                    <td>{{ $report['name'] }}</td>
                    <td>{{ $report['email'] }}</td>
                    <td>{{ $report['subject_type'] }}</td>
                    <td>{{ $report['location'] }}</td>
                    <td>{{ $report['description'] }}</td>
                    <!-- Add other data fields as necessary -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
