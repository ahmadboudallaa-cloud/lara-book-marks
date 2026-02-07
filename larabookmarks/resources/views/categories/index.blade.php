<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Mes Catégories</h1>

    <a href="{{ route('categories.create') }}" class="text-green-600 hover:underline mb-4 inline-block">Ajouter une catégorie</a>

    @if($categories->count())
        <ul class="space-y-2">
        @foreach($categories as $category)
            <li class="border p-2 flex justify-between items-center">
                {{ $category->name }}
                <div class="space-x-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
        </ul>
    @else
        <p>Aucune catégorie.</p>
    @endif
</x-app-layout>
