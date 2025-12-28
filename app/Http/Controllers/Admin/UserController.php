<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Update Role User (Hanya bisa diakses Admin)
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi agar tidak bisa mengubah role diri sendiri jadi User (Berbahaya, nanti terkunci)
        if ($user->idUser == auth()->user()->idUser) {
            return back()->with('error', 'Anda tidak bisa mengubah role Anda sendiri di menu ini.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role user berhasil diubah.');
    }

    // Hapus User (untuk admin ingin banned user)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->idUser == auth()->user()->idUser) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
