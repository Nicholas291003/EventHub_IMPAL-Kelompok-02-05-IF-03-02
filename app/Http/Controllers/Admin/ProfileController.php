<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        // Mengarah ke view khusus Admin
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:100|unique:users,username,'.$user->idUser.',idUser',
            'email' => 'required|email|unique:users,email,'.$user->idUser.',idUser',
            'avatar' => 'nullable|image|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update Data
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path('images/profiles/' . $user->avatar))) {
                unlink(public_path('images/profiles/' . $user->avatar));
            }
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profiles'), $name);
            $user->avatar = $name;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil Admin berhasil diperbarui!');
    }
}
