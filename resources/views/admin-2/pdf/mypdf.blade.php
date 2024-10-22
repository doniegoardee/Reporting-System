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

        .field {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>

    @foreach ($reports as $report)
        <div class="title">Incident Report</div>

        <div class="field">
            <span class="label">Subject Type: </span> {{ $report->subject_type }}
        </div>
        <div class="field">
            <span class="label">Location: </span> {{ $report->location }}
        </div>
        <div class="field">
            <span class="label">Status: </span> {{ $report->status }}
        </div>
        <div class="field">
            <span class="label">Description: </span> {{ $report->description }}
        </div>
        <div class="field">
            <span class="label">Severity: </span> {{ $report->severity }}
        </div>
        <div class="field">
            <span class="label">Number Affected: </span> {{ $report->num_affected }}
        </div>
        <div class="field">
            <span class="label">Needs: </span> {{ $report->needs }}
        </div>
        <div class="field">
            <span class="label">Responding Agency: </span> {{ $report->responding_agency }}
        </div>
        <div class="field">
            <span class="label">Resolved Time: </span>
            {{ $report->resolved_time ? $report->resolved_time->format('F j, Y, g:i a') : 'N/A' }}
        </div>
    @endforeach
</body>

</html>
