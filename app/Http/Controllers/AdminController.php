<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Warung;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function showWarung(Request $request, $id)
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

    // LAPORAN
    public function laporanAdmin()
    {
        $warungs = Warung::all();
        return view('admin.laporan.index', compact('warungs'));
    }

    // public function getLaporanAdmin(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $warung_id = $request->input('warung_id');

    //     // Validasi tanggal
    //     if ($startDate > $endDate) {
    //         return response()->json(['error' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir'], 400);
    //     }

    //     // Get transactions within the specified range
    //     $laporanPenjualan = Transaction::whereBetween('created_at', [$startDate, $endDate])
    //         ->where('warung_id', $warung_id)
    //         ->where('transaction_status', 'lunas')
    //         ->get();

    //     // Create an empty array to store dates with transactions
    //     $datesWithTransactions = [];

    //     // Iterate through transactions to find dates with transactions
    //     foreach ($laporanPenjualan as $transaction) {
    //         $transactionDate = Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY');
    //         $datesWithTransactions[$transactionDate] = true;
    //     }

    //     // Generate a list of all dates within the specified range
    //     $dateRange = Carbon::parse($startDate)->toPeriod($endDate)->toArray();

    //     // Filter out dates without transactions from the date range
    //     $dateRangeWithTransactions = array_filter($dateRange, function ($date) use ($datesWithTransactions) {
    //         return isset($datesWithTransactions[Carbon::parse($date)->isoFormat('D MMMM YYYY')]);
    //     });

    //     // Group transactions by formatted date
    //     $groupedTransactions = $laporanPenjualan->groupBy(function ($transaction) {
    //         return Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY');
    //     });

    //     // Merge the generated date range with the actual transactions
    //     $mergedData = Collection::make($dateRangeWithTransactions)->map(function ($date) use ($groupedTransactions) {
    //         $formattedDate = Carbon::parse($date)->isoFormat('D MMMM YYYY');
    //         $transactions = $groupedTransactions[$formattedDate] ?? collect();

    //         $total = $transactions->sum('total') - $transactions->sum('pajak');

    //         return [
    //             'date' => $formattedDate,
    //             'total' => $total,
    //             'transactions' => $transactions,
    //         ];
    //     });

    //     return response()->json($mergedData->values());
    // }
    public function getLaporanAdmin(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $warung_id = $request->input('warung_id');

        // Validasi tanggal
        if ($startDate > $endDate) {
            return response()->json(['error' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir'], 400);
        }

        // Get transactions within the specified range
        $laporanPenjualan = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->where('warung_id', $warung_id)
            ->where('transaction_status', 'lunas')
            ->get();

        // Group transactions by formatted date
        $groupedTransactions = $laporanPenjualan->groupBy(function ($transaction) {
            return Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY');
        });

        // Merge the generated date range with the actual transactions
        $mergedData = $groupedTransactions->map(function ($transactions, $date) {
            $total = $transactions->sum('total') - $transactions->sum('pajak');

            return [
                'date' => $date,
                'total' => $total,
                'transactions' => $transactions,
            ];
        });

        return response()->json($mergedData->values());
    }

    public function showTopProductsAdmin(Request $request)
    {
        $warungs = Warung::all();
        $getTopProductsAdmin = $this->getTopProductsAdmin($request); // Fungsi untuk mendapatkan top produk dengan periode

        return view('admin.laporan.topproduct', compact('getTopProductsAdmin', 'warungs'));
    }

    public function getTopProductsAdmin(Request $request)
    {
        $warung_id = $request->input('warung_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Validasi tanggal
        if ($startDate > $endDate) {
            return response()->json(['error' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir'], 400);
        }

        // Get transactions within the specified range
        $transactions = Transaction::where('warung_id', $warung_id)
            ->where('transaction_status', 'lunas')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with(['detail_transactions.product'])
            ->get();

        // Create an empty array to store products with quantity sold
        $productsWithQuantity = [];

        // Iterate through transactions to find products with quantity sold
        foreach ($transactions as $transaction) {
            foreach ($transaction->detail_transactions as $detailTransaction) {
                $product_id = $detailTransaction->product_id;
                $quantity_sold = $detailTransaction->qty;

                if (!isset($productsWithQuantity[$product_id])) {
                    $productsWithQuantity[$product_id] = [
                        'product_id' => $product_id,
                        'product_name' => $detailTransaction->product->name,
                        'total_quantity_sold' => 0,
                    ];
                }

                $productsWithQuantity[$product_id]['total_quantity_sold'] += $quantity_sold;
            }
        }

        // Sort products by total quantity sold
        usort($productsWithQuantity, function ($a, $b) {
            return $b['total_quantity_sold'] - $a['total_quantity_sold'];
        });

        // Return the top products
        return response()->json(array_slice($productsWithQuantity, 0, 10));
    }
}
