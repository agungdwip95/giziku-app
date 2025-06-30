<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'no_hp'    => 'nullable|string|max:20',
            'alamat'   => 'nullable|string|max:255',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Proses upload foto ke folder public/img/foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/foto'), $fileName);
            $fotoPath = 'img/foto/' . $fileName;
        }

        $user->nama = $request->nama;
        $user->foto = $fotoPath;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
