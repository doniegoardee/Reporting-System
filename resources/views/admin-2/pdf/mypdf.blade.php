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
            table-layout: fixed; /* Fixed table layout */
            margin-left: 20px; /* Move the table to the left */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            word-wrap: break-word; /* Allow wrapping for long words */
            overflow: hidden; /* Prevent overflow */
            text-overflow: ellipsis; /* Display ellipsis for overflowed text */
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
                margin-left: 10px; /* Reduce margin on smaller screens */
            }

            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>

    <div class="title">Incident Reports</div>

    <table>
        <thead>
            <tr>
                <th>Subject Type</th>
                <th>Location</th>
                <th>Status</th>
                <th>Description</th>
                <th>Severity</th>
                <th>Number Affected</th>
                <th>Needs</th>
                <th>Responding Agency</th>
                <th>Resolved Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->subject_type }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ $report->severity }}</td>
                    <td>{{ $report->num_affected }}</td>
                    <td>{{ $report->needs }}</td>
                    <td>{{ $report->responding_agency }}</td>
                    <td>{{ $report->resolved_time ? $report->resolved_time->format('F j, Y, g:i a') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
