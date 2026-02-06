<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Bienvenue, {{ auth()->user()->name }} !</h1>

    <div class="space-x-4">
        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">Mes Catégories</a>
        <a href="{{ route('links.index') }}" class="text-blue-600 hover:underline">Mes Liens</a>
    </div>
</x-app-layout>
