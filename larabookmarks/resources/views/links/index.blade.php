<x-app-layout>

<x-slot name="header">
    <h2 class="text-3xl font-bold text-red-700">Mes liens</h2>
    <p class="text-gray-500">Recherche, filtre et gestion</p>
</x-slot>

<!-- Search -->
<form method="GET" action="{{ route('links.search') }}" class="mb-6">
    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Rechercher..."
        class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-600 focus:outline-none"
    />
</form>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
<table class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="p-4 text-left text-gray-500">Titre</th>
            <th class="p-4 text-left text-gray-500">Catégorie</th>
            <th class="p-4 text-left text-gray-500">Tags</th>
            <th class="p-4 text-right text-gray-500">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($links as $link)
        <tr class="border-t hover:bg-gray-50">
            <td class="p-4 max-w-sm break-words">{{ $link->title }}</td>
            <td class="p-4">{{ $link->category->name }}</td>

            <td class="p-4">
                <div class="flex flex-wrap gap-2">
                    @foreach($link->tags as $tag)
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </td>

            <td class="p-4 text-right space-x-2 whitespace-nowrap">
                <a href="{{ route('links.edit',$link) }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                   Modifier
                </a>

                <form action="{{ route('links.destroy',$link) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

</x-app-layout>
