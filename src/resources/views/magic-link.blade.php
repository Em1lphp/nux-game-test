<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Magic Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 class="card-title">Magic Link Page</h3>

            <p><strong>Token:</strong> {{ $link->token }}</p>
            <p><strong>Expires At:</strong> {{ $link->expires_at }}</p>

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if($errors->has('message'))
                <div class="alert alert-danger">{{ $errors->first('message') }}</div>
            @endif

            <div class="d-grid gap-2 mt-4">

                <form action="{{ route('magic.link.generate', ['token' => $link->token]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Generate New Link</button>
                </form>

                <form method="GET" action="{{ route('magic.link.deactivate', ['token' => $link->token]) }}">
                    <button type="submit" class="btn btn-warning">Deactivate Link</button>
                </form>

                <form method="POST" action="{{ route('game.start', ['token' => $link->token]) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">I'm Feeling Lucky</button>
                </form>

                <form method="GET" action="{{ route('game.history', ['token' => $link->token]) }}">
                    <button type="submit" class="btn btn-info">History</button>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
