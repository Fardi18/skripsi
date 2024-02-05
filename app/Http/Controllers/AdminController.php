<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Warung;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $penjuals = Penjual::count();
        $transactions = Transaction::count();
        $products = Product::count();
        $warungs = Warung::count();
        return view("admin.dashboard", compact("users", "penjuals", "transactions", "products", "warungs"));
    }

    // PENJUAL
    public function penjual()
    {
        $penjuals = Penjual::orderBy("created_at", "desc")->get();
        return view("admin.penjual.index", compact("penjuals"));
    }

    public function showPenjual($id)
    {
        $penjual = Penjual::with(['province', 'regency', 'warung', 'rekening'])->findOrFail($id);
        return view("admin.penjual.show", compact("penjual"));
    }

    // PEMBELI
    public function pembeli()
    {
        $pembelis = User::orderBy("created_at", "desc")->get();
        return view("admin.pembeli.index", compact("pembelis"));
    }

    public function showPembeli($id)
    {
        $pembeli = User::with(['province', 'regency'])->findOrFail($id);
        return view("admin.pembeli.show", compact("pembeli"));
    }

    // WARUNG
    public function warung()
    {
        $warungs = Warung::orderBy("created_at", "desc")->get();
        return view("admin.warung.index", compact("warungs"));
    }

    public function showWarung($id)
    {
        $warung = Warung::with(['penjual', 'penjual.province', 'penjual.regency', 'products'])->findOrFail($id);
        return view("admin.warung.show", compact("warung"));
    }

    public function showProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return view("admin.warung.productdetail", compact("product"));
    }

    public function editWarung($id)
    {
        $warung = Warung::findOrFail($id);
        return view("admin.warung.edit", compact("warung"));
    }

    public function updateWarung(Request $request, $id)
    {
        $warung = Warung::with(['penjual'])->findOrFail($id);

        $validated = $request->validate([
            'name' => 'string',
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
        $penjual_id = $warung->penjual->id;

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

            return redirect('admin/warung')->with('success', 'Warung berhasil diperbarui!');
        } catch (Exception $e) {
            // Tangani error dan tampilkan pesan kesalahan pada halaman yang sama
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Periksa kembali data yang dimasukkan.']);
        }
    }

    // TRANSACTION
    public function transaction()
    {
        $transactions = Transaction::with('warung.penjual')->orderBy("created_at", "desc")->get();
        return view("admin.transaction.index", compact("transactions"));
    }

    public function showTransaction(Transaction $transaction)
    {
        $details = $transaction->detail_transactions()->with('product')->get();
        // dd($details);
        return view("admin.transaction.transactiondetail", compact("transaction", "details"));
    }
}
