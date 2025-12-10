<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comics;
use App\Models\Genre;

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

        return view('comic.show', compact('comic'));
    }

    public function create()
{
    $genres = \App\Models\Genre::all(); // untuk dropdown genre
    return view('comic.create', compact('genres'));
}

public function store(Request $request)
{
    $validate = $request->validate([
        'title_original' => 'required|string',
        'title_indonesia' => 'required|string',
        'cover_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'genre_id' => 'required|integer',
        'type' => 'required|string',
        'story_concept' => 'required|string',
        'author' => 'required|string',
        'status' => 'required|string',
        'age_rating' => 'required|integer'
    ]);

    // Upload cover
    $path = $request->file('cover_image')->store('covers', 'public');

    $validate['cover_image'] = 'storage/' . $path;

    \App\Models\Comics::create($validate);

    return redirect('/')->with('success', 'Komik berhasil ditambahkan!');
}

 public function edit($id)
    {
        $comic = Comics::findOrFail($id);
        $genres = Genre::all();
        return view('comic.edit', compact('comic', 'genres'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $comic = Comics::findOrFail($id);

        $validate = $request->validate([
            'title_original' => 'required',
            'title_indonesia' => 'required',
            'genre_id' => 'required|integer',
            'type' => 'required',
            'story_concept' => 'required',
            'author' => 'required',
            'status' => 'required',
            'age_rating' => 'required|integer',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        // Update cover jika ada file baru
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $validate['cover_image'] = 'storage/' . $path;
        }

        $comic->update($validate);

        return redirect('/')->with('success', 'Komik berhasil diperbarui!');
    }

    // DELETE
    public function destroy($id)
    {
        $comic = Comics::findOrFail($id);
        $comic->delete();

        return redirect('/')->with('success', 'Komik berhasil dihapus!');
    }
}
