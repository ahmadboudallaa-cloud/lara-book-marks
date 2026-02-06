<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id', Auth::id())
            ->with(['category', 'tags'])
            ->latest()
            ->get();

        $categories = Category::where('user_id', Auth::id())->get();

        return view('dashboard', compact('links', 'categories'));
    }
}
