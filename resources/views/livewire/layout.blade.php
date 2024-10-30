<!DOCTYPE html>
<html class="smooth-scroll" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>{{ config('app.name') }} {{ $page->meta_title ? ' | '.$page->meta_title : '' }}</title>

    @if(config('app.env') != 'production')
        <meta name="robots" content="noindex, nofollow, nosnippet">
        <meta name="googlebot" content="noindex"/>
        <meta name="googlebot-news" content="noindex"/>
        <meta name="googlebot-news" content="nosnippet">
    @endif

    {{-- Meta --}}
    <meta name="title" content="{{ $page->meta_title ? $page->meta_title : $page->title }}">
    <meta name="description" content="{{  $page->meta_description ? $page->meta_description : $page->excerpt }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/').$page->slug }}">
    <meta property="og:title" content="{{ $page->meta_title ? $page->meta_title : $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ? $page->meta_description : $page->excerpt }}">
    @if(request()->routeIs('fe.article'))
        <meta property="og:image"
              content="{{ $media ?  $media->media_path : __('img/meta-image.jpg') }}">
    @else
        <meta property="og:image"
              content="{{ asset('img/meta-image.svg') }}">
    @endif

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/').$page->slug }}">
    <meta property="twitter:title" content="{{ $page->meta_title ? $page->meta_title : $page->title }}">
    <meta property="twitter:description"
          content="{{ $page->meta_description ? $page->meta_description : $page->excerpt }}">
    @if(request()->routeIs('fe.article'))
        <meta property="twitter:image"
              content="{{ $media ?  $media->media_path : __('img/meta-image.jpg') }}">
    @else
        <meta property="twitter:image"
              content="{{ asset('img/meta-image.png') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.svg') }}"/>
    <link rel="icon" href="{{ url('favicon.svg') }}" sizes="192x192"/>
    <link rel="apple-touch-icon" href="{{ url('favicon.svg') }}" sizes="180x180"/>

    @vite(['resources/scss/fe/app.scss','resources/js/app.js'])
    @stack('top.script')
</head>

<body class="body-{{ $page->template }} font-sans antialiased" id="body">
<livewire:partials.header/>
<div>
    {{ $slot }}
</div>
<livewire:partials.footer/>

@stack('bottom.script')

</body>
</html>
