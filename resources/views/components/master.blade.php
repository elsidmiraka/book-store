<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>book store</title>
    
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.svg')}}">

   @include('sources.css')
    
</head>
<body>
    <div class="w-full">
        @include('components.navbar')

        <main class="py-4">
            @yield('content')
        </main>

        @include('components.footer')
    </div>

    @include('sources.js')

</body>
</html>