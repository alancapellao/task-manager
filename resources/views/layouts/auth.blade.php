<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="{{ asset('css/layouts/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/flaticon_app-to.css') }}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <title>@yield('title')</title>
</head>

<body>
        <main>
                <div class="container">
                        <img src="{{ asset('images/logo.svg') }}" alt="logo">
                </div>

                <div class="container">
                        @yield('content')
                </div>
        </main>
</body>

<script src="{{ asset('js/utilities/password-toggle.js') }}"></script>

</html>