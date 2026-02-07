<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaraBookmarks</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 p-6 flex flex-col">

        <!-- Logo -->
        <h1 class="text-2xl font-bold text-red-700 mb-10">
            LaraBookmarks
        </h1>

        <!-- Navigation -->
        <nav class="space-y-3 flex-1">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-red-50 text-gray-700">
                Dashboard
            </a>

            <a href="{{ route('links.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-red-50 text-gray-700">
                Liens
            </a>

            <a href="{{ route('categories.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-red-50 text-gray-700">
                Catégories
            </a>

            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 rounded-lg hover:bg-red-50 text-gray-700">
                Profil
            </a>
        </nav>

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full mt-6 px-4 py-2 rounded-lg
                       bg-red-600 text-white
                       hover:bg-red-700 transition">
                Déconnexion
            </button>
        </form>

    </aside>

    <!-- CONTENU -->
    <main class="flex-1 p-8">

        @isset($header)
            <div class="mb-8">
                {{ $header }}
            </div>
        @endisset

        {{ $slot }}

    </main>

</div>

</body>
</html>
