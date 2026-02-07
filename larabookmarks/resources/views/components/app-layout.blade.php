<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LaraBookmarks') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased p-6">
    <!-- Header simple -->
    <header class="mb-6">
        <nav class="flex justify-between items-center">
            <h1 class="text-xl font-bold">{{ config('app.name', 'LaraBookmarks') }}</h1>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                </form>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>
