<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="w-full container mx-zuto p-6" style="background-color: rgb(120, 180, 240)">
                <div class="w-full flex items-center justify-between">
                    <h1>guest.blade.php</h1>
                    <a href="{{route('toppage')}}">
                        <img src="{{asset('logo/フクロウ博士_本好き.png')}}" style="max-height: 80px;">
                    </a>
                </div>
            </div>
            {{ $slot }}
        </div>
    </body>
</html>
