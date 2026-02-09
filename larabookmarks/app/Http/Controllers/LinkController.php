<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id', Auth::id())
            ->with(['category', 'tags'])
            ->latest()
            ->get();

        return view('links.index', compact('links'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('links.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $link = Link::create([
            'title' => $request->title,
            'url' => $request->url,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        // TAGS (texte)
        if ($request->filled('tags_text')) {
            $tags = collect(explode(',', $request->tags_text))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->unique();

            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }

            $link->tags()->sync($tagIds);
        }

        return redirect()->route('links.index');
    }

    public function edit(Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::where('user_id', Auth::id())->get();
        return view('links.edit', compact('link', 'categories'));
    }

    public function update(Request $request, Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $link->update([
            'title' => $request->title,
            'url' => $request->url,
            'category_id' => $request->category_id,
        ]);

        // TAGS
        if ($request->filled('tags_text')) {
            $tags = collect(explode(',', $request->tags_text))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->unique();

            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }

            $link->tags()->sync($tagIds);
        } else {
            $link->tags()->sync([]);
        }

        return redirect()->route('links.index');
    }

    public function destroy(Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $link->delete();
        return redirect()->route('links.index');
    }

    // 🔎 RECHERCHE (US-06)
    public function search(Request $request)
    {
        if (!$request->filled('q')) {
            return redirect()->route('links.index');
        }

        $q = $request->q;

        $links = Link::where('user_id', Auth::id())
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhereHas('category', function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('tags', function ($q3) use ($q) {
                        $q3->where('name', 'like', "%{$q}%");
                    });
            })
            ->with(['category', 'tags'])
            ->latest()
            ->get();

        return view('links.index', compact('links'));
    }
}
