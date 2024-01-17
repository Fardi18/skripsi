<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Warung;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function landingpage()
    {
        $warungs = Warung::all();
        return view("pembeli.landingpage", ["warungs" => $warungs]);
    }

    public function detailProduct($id)
    {
        $product = Product::with('warung')->findOrFail($id);
        // $carts = Cart::where("user_id", auth()->user()->id)->with("product")->get();
        return view("pembeli.detailproduct", ['product' => $product]);
    }

    public function getProductDetails($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }


    public function warung()
    {
        $warungs = Warung::all();

        return view("pembeli.warung", ["warungs" => $warungs]);
    }

    public function detailWarung($id)
    {
        $warung = Warung::with('products', 'penjual')->findOrFail($id);
        return view('pembeli.detailwarung', ['warung' => $warung]);
    }

    public function maps()
    {
        $warungs = Warung::all();
        return view('pembeli.map', ['warungs' => $warungs]);
    }

    public function getRoute($id)
    {
        /**
         * Menampilkan rute spot berdasarkan lokasi spot yang dipilih
         */
        $warungs = Warung::where('id', $id)->first();
        return view('pembeli.route', [
            'warungs' => $warungs,
        ]);
    }
}
