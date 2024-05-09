<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Database Connection Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light Gray Background */
            color: #343a40; /* Dark Gray Text */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff; /* White Container Background */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            padding: 30px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .connection-status {
            list-style: none;
            padding: 0;
        }

        .connection-status li {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .status-label {
            font-weight: bold;
        }

        .connected {
            color: #28a745; /* Green for Connected */
        }

        .not-connected {
            color: #dc3545; /* Red for Not Connected */
        }

        .not-implemented {
            color: #6c757d; /* Gray for Not Implemented */
        }
    </style>
</head>
<body>
@include('navbar')
<div class="container">
    <img src="https://raw.githubusercontent.com/laravel/art/master/laravel-logo.png" alt="Laravel Logo" style="width: 100px; height: 100px;">
    <h1 class="mt-4">Laravel Database Connection Status</h1>

    <ul class="connection-status">
        <li>
            <span class="status-label">MySQL:</span> <span class="@if(DB::connection('mysql')->getPdo()) connected @else not-connected @endif">
                    @if(DB::connection('mysql')->getPdo()) Connected @else Not Connected @endif
                </span>
        </li>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
