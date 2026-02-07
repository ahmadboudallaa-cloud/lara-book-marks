<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-red-600">{{ isset($link) ? 'Modifier le lien' : 'Ajouter un lien' }}</h2>
    </x-slot>

    <form action="{{ isset($link) ? route('links.update', $link) : route('links.store') }}" method="POST" class="bg-gray-900 p-6 rounded shadow space-y-4">
        @csrf
        @if(isset($link)) @method('PUT') @endif

        <div>
            <label class="block mb-1">Titre</label>
            <input type="text" name="title" value="{{ old('title', $link->title ?? '') }}" required
                class="w-full p-2 rounded border border-red-800 text-black" />
        </div>

        <div>
            <label class="block mb-1">URL</label>
            <input type="url" name="url" value="{{ old('url', $link->url ?? '') }}" required
                class="w-full p-2 rounded border border-red-800 text-black break-words" />
        </div>

        <div>
            <label class="block mb-1">Catégorie</label>
            <select name="category_id" required class="w-full p-2 rounded border border-red-800 text-black">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ isset($link) && $link->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

      <div>
    <label class="block mb-1 text-gray-600">Tags</label>
    <input type="text" name="tags_text"
        class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-600"
        placeholder="Laravel, PHP, JS"
        value="{{ old('tags_text', isset($link) ? $link->tags->pluck('name')->implode(',') : '') }}">
</div>



        <button type="submit" class="bg-red-800 px-4 py-2 rounded hover:bg-red-600">
            {{ isset($link) ? 'Modifier le lien' : 'Ajouter le lien' }}
        </button>
    </form>
</x-app-layout>
