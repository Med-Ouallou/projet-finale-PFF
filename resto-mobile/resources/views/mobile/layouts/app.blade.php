<!DOCTYPE html>
<html lang="fr" class="bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'RestoManager')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    @stack('styles')
</head>

<body class="@yield('body-class', 'bg-gray-50/50') min-h-screen pb-28">

    @yield('content')

    @include('mobile.components.bottom-nav', ['activePage' => $activePage ?? 'accueil'])

</body>

</html>
