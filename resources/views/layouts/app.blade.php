<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <meta content="{{ env('APP_URL') }}" name="app-url">

    <link rel="stylesheet" href="{{ asset('css/themes/theme-' . session('user.settings')->theme . '.css') }}"
        id="theme-link">
    <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon_app-to.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('js/components/lang.js') }}"></script>

    <title>{{ __('pagination.task_manager') }}</title>
</head>

<body>
    <main>
        <x-menu></x-menu>

        <div class="container">
            <x-header :title="$title" :id="$id">
                @isset($quantity)
                <div class="quantity-box">{{ $quantity }}</div>
                @endisset
            </x-header>

            <div class="content">
                @yield('content')
            </div>
        </div>

        <div class="form form-hidden"></div>
    </main>

    <div class="modal modal-hidden"></div>
</body>

<script src="{{ asset('js/components/alert.js') }}"></script>
<script src="{{ asset('js/components/dialog.js') }}"></script>
<script src="{{ asset('js/components/load.js') }}"></script>
<script src="{{ asset('js/components/form.js') }}"></script>
<script src="{{ asset('js/components/modal.js') }}"></script>
<script src="{{ asset('js/requests/ajaxComplete.js') }}"></script>

</html>