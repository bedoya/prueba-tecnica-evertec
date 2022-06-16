<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? __('Prueba técnica Andrés Bedoya') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <livewire:styles />
</head>

<body>
    @include('includes.navbar')
    <div class="container">
        @include('includes.message')
        <!-- Add your site or application content here -->
        {{ $slot }}
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <livewire:scripts />
</body>

</html>
