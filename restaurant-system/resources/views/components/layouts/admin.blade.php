<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - Resto Manager' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gray-50 h-full font-sans antialiased" x-data="adminLayout()">

    <x-admin.sidebar />

    <!-- Content wrapper -->
    <div class="lg:ps-[260px] min-h-screen flex flex-col">
        <x-admin.topbar :breadcrumb="$breadcrumb ?? ''">
            <x-slot:actions>{{ $actions ?? '' }}</x-slot:actions>
        </x-admin.topbar>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            {{ $slot }}
        </main>
    </div>

    {{ $modal ?? '' }}

    @stack('scripts')

    <script>
        function adminLayout() {
            return {
                sidebarOpen: false,
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                }
            }
        }
    </script>
</body>
</html>
