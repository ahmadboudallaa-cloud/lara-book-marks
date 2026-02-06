<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::with(['category', 'tags'])->where('user_id', Auth::id())->get();
        return view('links.index', compact('links'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('links.create', compact('categories', 'tags'));
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'url' => 'required|url|max:255',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Création du lien
$link = Link::create([
    'title' => $request->title,
    'url' => $request->url,
    'category_id' => $request->category_id,
    'user_id' => Auth::id(),
]);

// Gestion des tags texte
if ($request->tags_text) {
    $tags = collect(explode(',', $request->tags_text))->map(fn($t) => trim($t))->filter()->unique();
    $tagIds = [];
    foreach ($tags as $tagName) {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $tagIds[] = $tag->id;
    }
    $link->tags()->sync($tagIds);
}
    return redirect()->route('links.index')->with('success', 'Lien ajouté avec succès.');
}


    public function edit(Link $link)
    {
        // $this->authorize('update', $link); // facultatif si tu veux sécuriser

        $categories = Category::all();
        $tags = Tag::all();
        $link->load('tags');
        return view('links.create', compact('link', 'categories', 'tags'));
    }

   public function update(Request $request, Link $link)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'url' => 'required|url|max:255',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Mise à jour du lien
$link->update([
    'title' => $request->title,
    'url' => $request->url,
    'category_id' => $request->category_id,
]);

// Mise à jour des tags
if ($request->tags_text) {
    $tags = collect(explode(',', $request->tags_text))->map(fn($t) => trim($t))->filter()->unique();
    $tagIds = [];
    foreach ($tags as $tagName) {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $tagIds[] = $tag->id;
    }
    $link->tags()->sync($tagIds);
} else {
    $link->tags()->sync([]); // aucun tag
}


    return redirect()->route('links.index')->with('success', 'Lien modifié avec succès.');
}


    public function destroy(Link $link)
    {
        $link->tags()->detach();
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Lien supprimé avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $links = Link::with(['category', 'tags'])
            ->where('user_id', Auth::id())
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhereHas('category', fn($q2) => $q2->where('name', 'like', "%{$query}%"))
                  ->orWhereHas('tags', fn($q3) => $q3->where('name', 'like', "%{$query}%"));
            })
            ->get();

        return view('links.index', compact('links'));
    }
}
