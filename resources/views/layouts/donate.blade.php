<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @include('shared.meta_tag')

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')

</head>
<body class="bg-gray-300">
    <header class="fixed w-full bg-green-500 shadow z-40">
        <div class="w-full container max-w-md mx-auto p-4 h-16 flex items-center justify-between text-white">
            <a href="javascript: history.go(-1)" class="h-10 w-10 rounded-full hover:bg-green-600 flex -ml-2">
                <svg class="fill-current h-6 w-6 m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
            </a>
            <div>
                <img src="/images/logo-lazisnu-kalsel-white.png" class="h-12">   
            </div>
            <div class="w-10 -mr-2">&nbsp;</div>
        </div>
    </header>
    @yield('content')

    @stack('prepend-scripts')
    <script src="{{ asset('js/donate.js') }}"></script>
    @stack('scripts')
</body>
</html>