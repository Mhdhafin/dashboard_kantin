<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kantin Dharma Wanita | @yield('title')</title>
    @vite('resources/css/app.css')
    <script src="{{ asset('assets/js/darkmode.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- daisy --}}
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

</head>

<body class="bg-gray-50 dark:bg-gray-900 font-sans transition-colors duration-200">

    <div class="flex h-screen overflow-hidden">
        @if (!request()->is('login') && !request()->is('register'))
            @include('partials.sidebar')
        @endif

        <div class="flex flex-col flex-1 overflow-hidden">
            @if (!request()->is('login') && !request()->is('register'))
                @include('partials.header')
            @endif

            <main class="flex-1 overflow-y-auto">
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    @include('sweetalert::alert')

    @stack('custom_script')
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
</body>

</html>
