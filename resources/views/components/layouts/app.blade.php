<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>

    <meta name="application-name" content="{{ config('app.name') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" type="image/x-icon" href="{{ url('favicon.png') }}"/>
    <link rel="icon" href="{{ url('favicon-192x192.png') }}" sizes="192x192"/>
    <link rel="apple-touch-icon" href="{{ url('favicon-180x180.png') }}" sizes="180x180"/>

    <title>{{ config('app.name') }}</title>

    @filamentStyles
    @vite('resources/scss/app.scss')
</head>

<body class="antialiased">
<livewire:partials.header/>
<div class="max-w-full overflow-hidden">
    {{ $slot }}
</div>
<livewire:partials.footer/>

@livewire('notifications')

@filamentScripts
@vite('resources/js/app.js')
</body>
</html>
