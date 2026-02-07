<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Modifier la catégorie</h1>

    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-2">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $category->name }}" class="border p-2 w-full" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Modifier</button>
    </form>
</x-app-layout>
