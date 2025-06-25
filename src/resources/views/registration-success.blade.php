<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body text-center">
            <h2 class="card-title mb-3 text-success">Registration Successful!</h2>
            <p class="mb-4">Your unique link is valid for <strong>7 days</strong>:</p>

            <a href="{{ route('magic.link', ['token' => $token]) }}" class="btn btn-primary">
                {{ route('magic.link', ['token' => $token]) }}
            </a>
        </div>
    </div>
</div>

</body>
</html>
