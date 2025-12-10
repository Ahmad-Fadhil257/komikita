<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'password' => 'nullable|min:6'
        ]);

        // Update nama
        $user->name = $request->name;

        // Update foto profil
        if ($request->hasFile('profile_image')) {

            // Hapus foto lama jika ada
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            $file = $request->file('profile_image');
            $path = $file->store('profile_images', 'public');

            $user->profile_image = 'storage/' . $path;
        }

        // Update password jika diisi
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
