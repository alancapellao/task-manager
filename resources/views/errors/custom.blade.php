<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/errors/custom.css') }}">

    <title>{{ __('pagination.error') }} {{ $error }}</title>
</head>

<body>
    <div class="fof">
        <h1>{{ __('pagination.error') }} {{ $error }}</h1>
    </div>
</body>

</html>