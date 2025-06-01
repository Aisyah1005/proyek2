<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;


class CartController extends Controller
{
public function addToCart(Request $request)
{
    //Ambil ID user yang sedang login dan ID produk dari form
    $userId = auth()->id();
    $productId = $request->product_id;

    //Cek apakah produk itu sudah ada di keranjang user.
    $cartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => 1
        ]);
    }

    return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
}
//menampilkan isi keranjang user
public function showCart()
{
    $userId = auth()->id();
    $cartItems = Cart::with('product')->where('user_id', $userId)->get();
    return view('cart.cart', compact('cartItems'));
}

    //menghapus satu produk dari keranjang
    public function removeFromCart($id)
    {
        $userId = auth()->id();
        $cartKey = 'cart_' . $userId;

        $cart = session()->get($cartKey, []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put($cartKey, $cart);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
