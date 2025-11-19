<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\Comic;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'comic_id' => 'required|integer|exists:comics,id',
        ]);

        $userId = Auth::id();
        $comicId = $request->input('comic_id');

        $bookmark = Bookmark::firstOrCreate([
            'user_id' => $userId,
            'comic_id' => $comicId,
        ]);

        if ($bookmark->wasRecentlyCreated) {
            return back()->with('success', 'Berhasil menambahkan bookmark.');
        }

        return back()->with('info', 'Komik sudah ada di bookmark.');
    }
}
