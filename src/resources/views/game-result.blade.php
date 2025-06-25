<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Game Result</h4>
        </div>
        <div class="card-body">
            <p><strong>Result:</strong> {{ ucfirst($result->winnerStatus) }}</p>
            <p><strong>Win Amount:</strong> {{ number_format($result->winAmount, 2) }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('magic.link', ['token' => request()->route('token')]) }}" class="btn btn-outline-secondary">← Back</a>
        </div>
    </div>
</div>

</body>
</html>
