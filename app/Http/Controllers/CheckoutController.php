<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('user.produk.index')->with('error', 'Keranjang kosong. Tambahkan produk terlebih dahulu.');
        }

        $total = collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);
        return view('user.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('user.produk.index')->with('error', 'Keranjang kosong.');
        }

        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'nullable|email|max:255',
            'no_hp'  => 'nullable|string|max:50',
            'alamat' => 'required|string',
        ]);

        $total = collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'nama'   => $request->nama,
                'email'  => $request->email,
                'no_hp'  => $request->no_hp,
                'alamat' => $request->alamat,
                'total'  => $total,
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'nama_produk'  => $item['nama'],
                    'harga'        => $item['harga'],
                    'qty'          => $item['qty'],
                    'subtotal'     => $item['harga'] * $item['qty'],
                ]);
            }

            DB::commit();

            session()->forget('cart');
            return redirect()->route('checkout.success', $order->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Checkout error: '.$e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
        }
    }

    public function success($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('user.checkout_succes', compact('order'));
    }
}
