<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraBookmarks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans min-h-screen">

<header class="bg-gray-900 border-b border-red-800 px-6 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-red-600">LaraBookmarks</h1>
    <nav class="flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="hover:text-red-600">Dashboard</a>
        <a href="{{ route('links.index') }}" class="hover:text-red-600">Liens</a>
        <a href="{{ route('categories.index') }}" class="hover:text-red-600">Catégories</a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="hover:text-red-600">Déconnexion</button>
        </form>
    </nav>
</header>

<main class="p-6">
    {{ $slot }}
</main>

</body>
</html>
