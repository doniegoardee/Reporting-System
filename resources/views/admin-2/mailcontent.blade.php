{{-- resources/views/admin-2/reportMailContent.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Report Details</title>
</head>
<body>
    <h1>Report Details</h1>
    <p><strong>Subject Type:</strong> {{ $report->subject_type }}</p>
    <p><strong>Location:</strong> {{ $report->location }}</p>
    <p><strong>Created At:</strong> {{ $report->created_at->format('d M Y, h:i A') }}</p>
    <p><strong>Description:</strong> {{ $report->description }}</p>
    <!-- Add any other report details as needed -->
</body>
</html>
