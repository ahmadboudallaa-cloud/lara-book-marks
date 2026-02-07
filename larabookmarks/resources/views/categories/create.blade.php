<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Ajouter une catégorie</h1>

    <form method="POST" action="{{ route('categories.store') }}" class="space-y-2">
        @csrf
        <input type="text" name="name" placeholder="Nom de la catégorie" class="border p-2 w-full" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
    </form>
</x-app-layout>
