<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @empty($title)
            {{ config('app.name') }}
        @else
            {{ $title }} | {{ config('app.name') }}
        @endempty
    </title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>

    <script defer src="{{ mix('/js/app.js') }}"></script>
</head>
<body>

<div class="flex flex-col w-full h-full">
    <div class="flex-initial">
        @guest
            <x-nav-bar></x-nav-bar>
        @else
            <x-nav-bar show :search-form-autofocus="$autofocus ?? false"></x-nav-bar>
        @endguest
    </div>
    <div class="flex-grow">
        @yield('content')
    </div>
</div>

</body>
</html>
