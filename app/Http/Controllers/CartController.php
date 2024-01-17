<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Product $product)
    {
        $carts = Cart::where("user_id", Auth::user()->id)->with("product")->get();

        // Buat array untuk menampung produk berdasarkan toko
        $groupedProducts = [];

        // Loop melalui keranjang belanja
        foreach ($carts as $cart) {
            $warungName = $cart->product->warung->name;

            // Jika toko belum ada di dalam array, tambahkan
            if (!isset($groupedProducts[$warungName])) {
                $groupedProducts[$warungName] = [
                    'warung' => $cart->product->warung,
                    'products' => [],
                ];
            }

            // Tambahkan produk ke dalam toko yang sesuai
            $groupedProducts[$warungName]['products'][] = $cart->product;
        }

        // dd($groupedProducts);
        return view("pembeli.cart.index", ["carts" => $carts, "groupedProducts" => $groupedProducts]);
    }

    public function addToCart(Product $product, Request $request)
    {
        $product_id = $product->id;
        $user_id = Auth::user()->id;
        $warung_id = $product->warung_id;
        $existing_cart = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existing_cart == null) {

            // validasi request
            $request->validate([
                'qty' => 'required|gte:1|lte:' . $product->stock
            ]);

            // create cart
            Cart::create([
                'product_id' => $product_id,
                'warung_id' => $warung_id,
                'user_id' => $user_id,
                'qty' => $request->qty
            ]);
        } else {
            // validasi agar kuantitas pada cart tidak melebihi stock produk
            $request->validate([
                'qty' => 'required|gte:1|lte:' . ($product->stock - $existing_cart->qty)
            ]);

            $existing_cart->update([
                'qty' => $existing_cart->qty + $request->qty
            ]);
        }

        return redirect('/cart');
    }

    public function update_cart(Cart $cart, Request $request)
    {
        // validasi request
        $request->validate([
            'qty' => 'required|gte:1|lte:' . $cart->product->stock
        ]);

        $cart->update([
            'qty' => $request->qty
        ]);

        return redirect('/cart');
    }

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart');
    }
}
