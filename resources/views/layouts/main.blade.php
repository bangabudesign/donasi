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
<body>
    @include('shared.header_primary')
    <div class="pt-16 md:pt-20">            
        @yield('content')
    </div>
    <footer class="w-full border-t bg-white py-12">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
                <a href="#" class="uppercase px-3">About Us</a>
                <a href="#" class="uppercase px-3">Privacy Policy</a>
                <a href="#" class="uppercase px-3">Terms &amp; Conditions</a>
                <a href="#" class="uppercase px-3">Contact Us</a>
            </div>
            <div class="pb-2">Copyright © 2021 www.lazismualmukhlisin.com</div>
            <div class="pb-6 text-gray-500 text-xs leading-none"><p>Developed By <a href="https://bmkstudio.id" target="blank">bmkstudio.id</a></p></div>
        </div>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>