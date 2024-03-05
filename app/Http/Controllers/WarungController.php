<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Warung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WarungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil id penjual
        $penjual_id = Auth::id();

        $warungs = Warung::where("penjual_id", $penjual_id)->get();

        return view("penjual.warung.index", ["warungs" => $warungs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("penjual.warung.add");
    }

    public function store(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "location" => "string",
            "description" => "required|string|max:65535",
            "address" => "required|string",
            "image" => "required|mimes:jpg,jpeg,png|max:5120",
        ]);

        // menyimpan file image ke dalam storage
        $saveImage['image'] = Storage::putFile('public/image', $request->file('image'));

        // mengambil id penjual
        $penjual_id = Auth::id();

        try {
            // mencoba menyimpan data warung
            Warung::create([
                'name' => $validated['name'],
                'location' => $validated['location'],
                'description' => $validated['description'],
                'address' => $validated['address'],
                'image' => $saveImage['image'],
                'penjual_id' => $penjual_id,
            ]);

            return redirect('/penjual/warung')->with('success', 'Warung berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan kesalahan pada halaman yang sama
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Periksa kembali data yang dimasukkan.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warung = Warung::with('penjual')->findOrFail($id);
        return view('penjual.warung.show', ['warung' => $warung]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warung = Warung::findOrFail($id);
        return view('penjual.warung.edit', ['warung' => $warung]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warung = Warung::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string|max:255',
            'location' => 'string',
            'description' => 'string|max:65535',
            'address' => 'string',
            'image' => 'mimes:jpg,jpeg,png|max:5120',
        ]);

        // Cek apakah ada unggahan gambar baru
        if ($request->hasFile('image')) {
            // Hapus foto yang lama
            Storage::delete($warung->image);

            // Simpan foto yang baru
            $newImage = ['image' => Storage::putFile('public/image', $request->file('image'))];
        } else {
            // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
            $newImage = ['image' => $warung->image];
        }

        // mengambil id penjual
        $penjual_id = Auth::id();

        // Update data di database
        try {
            Warung::where('id', $id)->update([
                "name" => $validated["name"],
                "location" => $validated["location"],
                "description" => $validated["description"],
                "address" => $validated["address"],
                "penjual_id" => $penjual_id,
                'image' => $newImage['image']
            ]);

            return redirect('/penjual/warung')->with('success', 'Warung berhasil diperbarui!');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan kesalahan pada halaman yang sama
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Periksa kembali data yang dimasukkan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Warung::destroy($id);
        return redirect('/penjual/warung')->with('success', 'Warung berhasil dihapus!');
    }
}
