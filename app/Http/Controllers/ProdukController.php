<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Tampilkan semua data produk
     */
    public function index()
    {
        $data = Produk::latest()->get();
        return view('index', compact('data'));
    }

    /**
     * Tampilkan form tambah data
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Simpan data produk baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fotoName);
        }

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoName,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit($id)
    {
        $item = Produk::findOrFail($id);
        return view('produk.edit', compact('item'));
    }

    /**
     * Update data produk di database
     */
    public function update(Request $request, $id)
    {
        $item = Produk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($item->foto && File::exists(public_path('uploads/' . $item->foto))) {
                File::delete(public_path('uploads/' . $item->foto));
            }

            $file = $request->file('foto');
            $fotoName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fotoName);
            $item->foto = $fotoName;
        }

        $item->nama = $request->nama;
        $item->harga = $request->harga;
        $item->deskripsi = $request->deskripsi;
        $item->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk dari database
     */
    public function destroy($id)
    {
        $item = Produk::findOrFail($id);

        // Hapus foto dari folder uploads
        if ($item->foto && File::exists(public_path('uploads/' . $item->foto))) {
            File::delete(public_path('uploads/' . $item->foto));
        }

        $item->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
