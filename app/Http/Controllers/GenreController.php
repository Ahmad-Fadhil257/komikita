<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Genre::create(['name' => $request->name]);

        return back()->with('success', 'Genre berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        Genre::findOrFail($id)->update(['name' => $request->name]);

        return back()->with('success', 'Genre berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Genre::findOrFail($id)->delete();

        return back()->with('success', 'Genre berhasil dihapus!');
    }
}
