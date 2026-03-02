<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangCon extends Controller
{
    // Add product to cart (session-based)
    public function addToCart(Request $request)
    {
        $produk = DB::table('produks')->where('id', $request->produk_id)->first();

        if (!$produk) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }

        $cart = session()->get('cart', []);
        $id = $produk->id;

        if (isset($cart[$id])) {
            // Already in cart, increase qty (max stok)
            $newQty = $cart[$id]['qty'] + ($request->qty ?? 1);
            $cart[$id]['qty'] = min($newQty, $produk->stok);
        } else {
            $cart[$id] = [
                'nama'  => $produk->nama,
                'tipe'  => $produk->tipe,
                'harga' => $produk->harga,
                'image' => $produk->image,
                'stok'  => $produk->stok,
                'kode'  => $produk->kode,
                'qty'   => min($request->qty ?? 1, $produk->stok),
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success'    => true,
            'message'    => $produk->nama . ' ditambahkan ke keranjang!',
            'cartCount'  => $this->getCartCount(),
            'cartTotal'  => $this->getCartTotal(),
        ]);
    }

    // Update quantity of item in cart
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->produk_id;

        if (isset($cart[$id])) {
            $qty = max(1, min((int)$request->qty, $cart[$id]['stok']));
            $cart[$id]['qty'] = $qty;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success'   => true,
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'cart'      => $this->formatCart(),
        ]);
    }

    // Remove item from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Item dihapus dari keranjang',
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'cart'      => $this->formatCart(),
        ]);
    }

    // Get cart data as JSON
    public function getCart()
    {
        return response()->json([
            'cart'      => $this->formatCart(),
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
        ]);
    }

    // Checkout: insert all cart items to pembelians table
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Keranjang kosong!');
        }

        $userId = Auth::user()->id;
        $totalCount = DB::table('pembelians')->count();

        foreach ($cart as $produkId => $item) {
            $totalCount++;

            // Insert to pembelians
            DB::table('pembelians')->insert([
                'kode_pembelian' => 'P-' . $produkId . '-' . $userId . '-' . $totalCount,
                'produk_id'      => $produkId,
                'banyak'         => $item['qty'],
                'bayar'          => $item['harga'] * $item['qty'],
                'user_id'        => $userId,
                'status'         => 'Verifikasi',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Decrement stok
            DB::table('produks')
                ->where('id', $produkId)
                ->decrement('stok', $item['qty']);
        }

        // Clear cart
        session()->forget('cart');

        return redirect('/')->with('success', 'Checkout berhasil! Pesanan Anda sedang diverifikasi.');
    }

    // Helper: get total items count
    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'qty'));
    }

    // Helper: get total price
    private function getCartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }
        return $total;
    }

    // Helper: format cart for JSON response
    private function formatCart()
    {
        $cart = session()->get('cart', []);
        $items = [];
        foreach ($cart as $id => $item) {
            $items[] = [
                'id'       => $id,
                'nama'     => $item['nama'],
                'tipe'     => $item['tipe'],
                'harga'    => $item['harga'],
                'image'    => $item['image'],
                'qty'      => $item['qty'],
                'stok'     => $item['stok'],
                'subtotal' => $item['harga'] * $item['qty'],
            ];
        }
        return $items;
    }
}
