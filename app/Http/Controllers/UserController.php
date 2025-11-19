<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // relasi bookmark + history
        $bookmarks = $user->bookmarks()->with('comic')->get();
        // Some tables (like read_histories) may not have timestamps.
        // Use `latest('id')` to order by primary key instead of `created_at`.
        $history   = $user->histories()->with('comic')->latest('id')->get();

        return view('profile.index', compact('user', 'bookmarks', 'history'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:3',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // update name
        $user->name = $request->name;

        // update profile image jika ada
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profiles'), $filename);

            $user->profile_image = 'profiles/' . $filename;
        }

        $user->save();

        return back();
    }
}
