<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akuns = Akun::orderBy('kode_akun', 'asc')->get();
        return view('admin.akun.index', compact('akuns'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_akun' => 'required|string|unique:akuns,kode_akun',
            'nama_akun' => 'required|string|max:255',
            'tipe_akun' => 'required|string',
        ]);

        Akun::create($validated);
        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        return view('admin.akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);
        
        $validated = $request->validate([
            'kode_akun' => 'required|string|unique:akuns,kode_akun,' . $akun->id,
            'nama_akun' => 'required|string|max:255',
            'tipe_akun' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $akun->update($validated);
        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus!');
    }
}