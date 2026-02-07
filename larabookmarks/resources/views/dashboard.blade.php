<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-red-700">
            Tableau de bord
        </h2>
        <p class="text-gray-500 mt-1">
            Gestion de vos liens, catégories et tags
        </p>
    </x-slot>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Liens</h3>
            <p class="text-4xl font-bold text-red-700 mt-2">
                {{ $linksCount ?? 0 }}
            </p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Catégories</h3>
            <p class="text-4xl font-bold text-red-700 mt-2">
                {{ $categoriesCount ?? 0 }}
            </p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Tags</h3>
            <p class="text-4xl font-bold text-red-700 mt-2">
                {{ $tagsCount ?? 0 }}
            </p>
        </div>

    </div>

    <!-- Actions rapides -->
    <div class="mt-10">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            Actions rapides
        </h3>

        <div class="flex flex-wrap gap-4">
            <a href="{{ route('links.index') }}"
               class="bg-red-700 hover:bg-red-600 text-white px-5 py-3 rounded-lg shadow transition">
                 Voir les liens
            </a>

            <a href="{{ route('links.create') }}"
               class="bg-white border border-red-700 text-red-700 hover:bg-red-50 px-5 py-3 rounded-lg transition">
                 Ajouter un lien
            </a>

            <a href="{{ route('categories.index') }}"
               class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-5 py-3 rounded-lg transition">
                 Catégories
            </a>
        </div>
    </div>

    <!-- Derniers liens -->
    <div class="mt-10 bg-white border border-gray-200 rounded-xl shadow-sm p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            Derniers liens ajoutés
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-4 text-gray-500">Titre</th>
                        <th class="text-left py-3 px-4 text-gray-500">Catégorie</th>
                        <th class="text-left py-3 px-4 text-gray-500">Tags</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentLinks ?? [] as $link)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-800 break-words max-w-sm">
                                {{ $link->title }}
                            </td>
                            <td class="py-3 px-4 text-gray-600">
                                {{ $link->category->name ?? '-' }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($link->tags as $tag)
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-400">
                                Aucun lien disponible
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
