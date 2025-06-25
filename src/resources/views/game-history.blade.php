<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Last 3 Attempts History</h4>
        </div>
        <div class="card-body">
            @forelse ($history as $entry)
                <div class="mb-3">
                    <strong>Result:</strong> {{ ucfirst($entry->result) }}<br>
                    <strong>Win Amount:</strong> {{ $entry->win_amount }}
                </div>
                <hr>
            @empty
                <p class="text-muted">No history available.</p>
            @endforelse
        </div>
        <div class="card-footer text-end">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Back</a>
        </div>
    </div>
</div>

</body>
</html>
