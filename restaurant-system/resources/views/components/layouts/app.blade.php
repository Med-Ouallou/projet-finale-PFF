<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Resto Manager' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-heading { font-family: 'Outfit', sans-serif; }
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 50%, #fff7ed 100%);
        }
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="bg-white antialiased">
    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>
