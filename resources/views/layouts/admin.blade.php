<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>

    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    @stack('styles')

</head>
<body>
    <div id="layout" class="w-full flex layout show">
        @include('shared.admin.topbar')
        @include('shared.admin.sidebar')
        <main id="mainContent" class="main-content bg-gray-200 pt-24 px-6 pb-6">
            @yield('content')
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>