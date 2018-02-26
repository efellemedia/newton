<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Newton</title>

        {{-- Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" v-cloak>
            @include('partials._header')
            
            <div class="container">
                @yield('content')
            </div>
            
            <flash message="{{ session('flash.message') }}" level="{{ session('flash.level') ?? 'success' }}"></flash>
        </div>
        
        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontawesome.js') }}"></script>
    </body>
</html>
