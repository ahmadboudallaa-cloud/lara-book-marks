<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-red-600">Mes liens</h2>
    </x-slot>

    <!-- Recherche + Ajouter -->
    <div class="mb-6 flex flex-wrap justify-between items-center gap-4">
        <form action="{{ route('links.search') }}" method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Rechercher..."
                class="border border-red-800 p-2 rounded text-black w-64" />
            <button type="submit" class="bg-red-800 px-4 py-2 rounded hover:bg-red-600">Rechercher</button>
            <a href="{{ route('links.index') }}" class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">Tout afficher</a>
        </form>

        <a href="{{ route('links.create') }}" class="bg-red-800 px-4 py-2 rounded hover:bg-red-600">Ajouter un lien</a>
    </div>

    <!-- Table liens -->
    <div class="overflow-x-auto bg-gray-900 rounded-lg shadow">
        <table class="min-w-full divide-y divide-red-800 table-auto">
            <thead class="bg-black">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-red-600">Titre</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-red-600">URL</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-red-600">Catégorie</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-red-600">Tags</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-red-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($links as $link)
                    <tr class="hover:bg-gray-800">
                        <td class="px-6 py-4 break-words max-w-xs">{{ $link->title }}</td>
                        <td class="px-6 py-4 break-words max-w-xs">
                            <a href="{{ $link->url }}" target="_blank" class="text-red-600 underline break-all">{{ $link->url }}</a>
                        </td>
                        <td class="px-6 py-4">{{ $link->category->name ?? '-' }}</td>
                        <td class="px-6 py-4 flex flex-wrap gap-1">
                            @foreach($link->tags as $tag)
                                <span class="bg-red-800 text-white px-2 py-1 rounded text-sm">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 flex flex-wrap gap-2">
                            <a href="{{ route('links.edit', $link) }}" class="bg-yellow-600 px-3 py-1 rounded hover:bg-yellow-500">Modifier</a>
                            <form action="{{ route('links.destroy', $link) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce lien ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-700 px-3 py-1 rounded hover:bg-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">Aucun lien trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
