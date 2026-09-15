<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang;

class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::all();
        return view('admin.cabang.index', compact('cabangs'));
    }

    public function create()
    {
        return view('admin.cabang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        Cabang::create($validated);

        return redirect()->route('cabang.index')->with('success', 'Data cabang berhasil ditambahkan!');
    }
}
