<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua user beserta data cabangnya (relasi)
        $users = User::with('cabang')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        // Mengambil cabang yang aktif saja untuk form pilihan
        $cabangs = Cabang::where('status', 'aktif')->get();
        return view('admin.user.create', compact('cabangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'cabang_id' => 'nullable|exists:cabangs,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'cabang_id' => $validated['cabang_id'],
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $cabangs = Cabang::where('status', 'aktif')->get();
        return view('admin.user.edit', compact('user', 'cabangs'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string',
            'cabang_id' => 'nullable|exists:cabangs,id',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'role' => $validated['role'],
            'cabang_id' => $validated['cabang_id'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil dihapus!');
    }
}