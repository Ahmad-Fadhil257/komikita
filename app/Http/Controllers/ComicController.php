<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comics;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $comics = Comics::when($search, function($query) use ($search) {
            $query->where('title_original', 'like', "%$search%");
        })->get();

        return view('dashboard.index', compact('comics'));
    }

    public function show($id)
    {
        $comic = Comics::with('genre')->findOrFail($id);

        return view('comics.show', compact('comic'));
    }
}
