<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BurgerDash Admin Pro')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('styles')
</head>
<body class="bg-gray-50 font-sans transition-colors duration-300" style="background: #ffeedd !important;">
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('partials.header')
            <main class="flex-1 overflow-y-auto p-6 bg-gradient-to-br from-gray-50 to-gray-100">
            @yield('content')
        </main>
        </div>
    </div>
    <button class="floating-btn bg-primary-500 hover:bg-primary-600 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-xl">
        <i class="fas fa-plus text-2xl"></i>
    </button>
    @yield('scripts')
</body>
</html>
