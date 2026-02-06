<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->categories;
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        Auth::user()->categories()->create($request->only('name'));
        return redirect()->route('categories.index')->with('success','Catégorie ajoutée');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name'=>'required']);
        $category->update($request->only('name'));
        return redirect()->route('categories.index')->with('success','Catégorie modifiée');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Catégorie supprimée');
    }
}
