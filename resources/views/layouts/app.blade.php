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
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Navbar -->
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            <div class="container">
                @yield('body')
            </div>
        </main>
    </div>

    @include('layouts.footer')

    <!-- Scripts -->
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
