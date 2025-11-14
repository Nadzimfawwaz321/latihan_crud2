<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class UserProdukController extends Controller
{
    public function index()
    {
        $data = Produk::latest()->paginate(8);
        return view('user.index', compact('data'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('user.show', compact('produk'));
    }
}
