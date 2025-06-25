<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="alert alert-danger text-center shadow-lg">
        <h2 class="mb-3">Oops! Something went wrong.</h2>
        <p>{{ $message ?? 'An unknown error occurred. Please try again later.' }}</p>
        <a href="{{ route('register.form') }}" class="btn btn-outline-secondary mt-3">← Back to registration</a>
    </div>
</div>

</body>
</html>
