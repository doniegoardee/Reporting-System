<!-- resources/views/errors/404.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-page {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .error-page h1 {
            font-size: 100px;
            font-weight: 700;
            color: #d9534f;
            margin-bottom: 10px;
        }

        .error-page h3 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .error-page p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .error-page a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
        }

        .error-page a:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="error-page">
        <h1 class="text-danger">404</h1>
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
        <p>
            We could not find the page you were looking for.
        </p>
        {{-- <a href="{{ url('/') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Home</a> --}}
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
