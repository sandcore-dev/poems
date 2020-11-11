<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>

        <script defer src="{{ mix('/js/app.js') }}"></script>
    </head>
    <body>

    <div class="centered-content">
        <div>
            @include('poem')
        </div>
    </div>

    <nav>
        @guest
            <a href="{{ route('login') }}">
                @lang('Login')
            </a>
        @else
            <a href="{{ route('dashboard') }}">
                @lang('Dashboard')
            </a>
        @endguest
    </nav>

    </body>
</html>
