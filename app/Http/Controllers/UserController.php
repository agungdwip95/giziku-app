<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:isAdmin');
    // }

    public function index()
    {
        $users = User::with('balitas')->get();
        return view('user.view', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'nullable|string',
            'role' => 'required|in:admin,ortu',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/foto'), $fileName);
            $data['foto'] = 'img/foto/' . $fileName; // simpan fotoPath ke DB
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan.');
    }

    // public function show($id)
    // {
    //     $user = User::with('balitas')->findOrFail($id);
    //     return view('user.show', compact('user'));
    // }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
            'alamat' => 'nullable|string',
            'role' => 'required|in:admin,ortu',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(public_path($user->foto))) {
                unlink(public_path($user->foto));
            }
            $file = $request->file('foto');
            $fileName = Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/foto'), $fileName);
            $data['foto'] = 'img/foto/' . $fileName;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->foto && file_exists(public_path($user->foto))) {
            unlink(public_path($user->foto));
        }
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }

    public function cetak_pdf()
    {
        $users = User::with('balitas')->get();
        $pdf = Pdf::loadView('user.user_pdf', compact('users'));
        return $pdf->download('laporan-user.pdf');
    }
}