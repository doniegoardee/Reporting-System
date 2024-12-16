<!DOCTYPE html>
<html>

<head>
    <title>Incident Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
            margin-left: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media screen and (max-width: 768px) {
            table {
                font-size: 14px;
                margin-left: 10px;
            }

            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>

<h1 style="text-align: center"><b>MUNICIPALITY OF BUGUEY</b></h1>

    <div class="title">Incident Reports</div>

    <table>
        <thead>
            <tr>
                <th>Subject Type</th>
                <th>Location</th>
                <th>Zone</th>
                <th>Status</th>
                <th>Severity</th>
                <th>Number Household Affected</th>
                <th>Responding Agency</th>
                <th>Resolved Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->subject_type }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->zone }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->severity }}</td>
                    <td>{{ $report->num_affected }}</td>
                    <td>{{ $report->responding_agency }}</td>
                    <td>{{ $report->resolved_time ? $report->resolved_time->format('F j, Y, g:i a') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
