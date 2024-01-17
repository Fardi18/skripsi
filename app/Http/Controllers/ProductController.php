<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // warung id
        $penjual_id = Auth::id();
        $warung_id = Warung::where("penjual_id", $penjual_id)->first()->id;

        $products = Product::where("warung_id", $warung_id)->get();
        return view("penjual.product.index", ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("penjual.product.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "required|string|max:65535",
            "price" => "required|integer",
            "stock" => "required|integer",
            "image" => "mimes:jpg, jpeg, png|max:10240",
        ]);

        // menyimpan file image ke dalam storage
        $saveImage['image'] = Storage::putFile('public/image', $request->file('image'));

        // generate code product
        $productCode = 'PRD-' . mt_rand(000, 999);

        // warung id
        $penjual_id = Auth::id();
        $warung_id = Warung::where("penjual_id", $penjual_id)->first()->id;

        // menyimpan data product
        Product::create([
            'code' => $productCode,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $saveImage['image'],
            'warung_id' => $warung_id,
        ]);

        return redirect('/penjual/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return view("penjual.product.show", ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view("penjual.product.edit", ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // validasi form
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "required|string|max:65535",
            "price" => "required|integer",
            "stock" => "required|integer",
            "image" => "mimes:jpg, jpeg, png|max:10240",
        ]);

        // Cek apakah ada unggahan gambar baru
        if ($request->hasFile('image')) {
            // Hapus foto yang lama
            Storage::delete($product->image);

            // Simpan foto yang baru
            $newImage = ['image' => Storage::putFile('public/image', $request->file('image'))];
        } else {
            // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
            $newImage = ['image' => $product->image];
        }

        // Update data di database
        $product->update([
            "name" => $validated["name"],
            "description" => $validated["description"],
            "price" => $validated["price"],
            "stock" => $validated["stock"],
            'image' => $newImage['image']
        ]);

        return redirect('/penjual/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect('/penjual/product');
    }
}
