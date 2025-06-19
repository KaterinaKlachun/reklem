<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' http https: 'unsafe-inline' 'unsafe-eval'; style-src 'self' http: https: 'unsafe-inline'; script-src 'self' http: https: 'unsafe-inline' 'unsafe-eval'; img-src 'self' http: https: data:; font-src 'self' http: https: data:; connect-src 'self' http: https:; style-src-elem 'self' http: https: 'unsafe-inline'; script-src-elem 'self' http: https: 'unsafe-inline' 'unsafe-eval';">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="force-https" content="true">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Meta-теги для SEO и соцсетей --}}
    <meta name="description" content="Reklem — сервис для создания и размещения рекламы быстро и просто.">
    <meta property="og:title" content="Reklem — Рекламный сайт">
    <meta property="og:description" content="Создай и управляй рекламой онлайн.">
    <meta property="og:image" content="{{ asset('preview.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js'])
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
