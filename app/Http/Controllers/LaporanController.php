<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Warung;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class LaporanController extends Controller
{
    public function index()
    {
        return view('penjual.laporan.index');
    }

    // public function getData(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $penjual_id = Auth::user()->id;
    //     $warung_id = Warung::where('penjual_id', $penjual_id)->pluck('id')->first();

    //     // Validasi tanggal
    //     if (
    //         $startDate > $endDate
    //     ) {
    //         return response()->json(['error' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir'], 400);
    //     }

    //     // Generate a list of all dates within the specified range
    //     $dateRange = Carbon::parse($startDate)->toPeriod($endDate)->toArray();

    //     // Get transactions within the specified range
    //     $laporanPenjualan = Transaction::whereBetween('created_at', [$startDate, $endDate])
    //         ->whereIn('warung_id', [$warung_id])
    //         ->where('transaction_status', 'lunas')
    //         ->with('warung')
    //         ->get();

    //     // Group transactions by formatted date
    //     $groupedTransactions = $laporanPenjualan->groupBy(function ($transaction) {
    //         return Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY');
    //     });

    //     // Merge the generated date range with the actual transactions
    //     $mergedData = Collection::make($dateRange)->map(function ($date) use ($groupedTransactions) {
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
    public function getData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $penjual_id = Auth::user()->id;
        $warung_id = Warung::where('penjual_id', $penjual_id)->pluck('id')->first();

        // Validasi tanggal
        if ($startDate > $endDate) {
            return response()->json(['error' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir'], 400);
        }

        // Generate a list of all dates within the specified range
        $dateRange = Carbon::parse($startDate)->toPeriod($endDate)->toArray();

        // Get transactions within the specified range
        $laporanPenjualan = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('warung_id', [$warung_id])
            ->where('transaction_status', 'lunas')
            ->with('warung')
            ->get();

        // Group transactions by formatted date
        $groupedTransactions = $laporanPenjualan->groupBy(function ($transaction) {
            return Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY');
        });

        // Initialize an empty array to store merged data
        $mergedData = [];

        // Iterate through the date range
        foreach ($dateRange as $date) {
            $formattedDate = Carbon::parse($date)->isoFormat('D MMMM YYYY');
            $transactions = $groupedTransactions[$formattedDate] ?? collect();

            // Check if transactions exist for the date
            if ($transactions->isNotEmpty()) {
                $total = $transactions->sum('total') - $transactions->sum('pajak');

                $mergedData[] = [
                    'date' => $formattedDate,
                    'total' => $total,
                    'transactions' => $transactions,
                ];
            }
        }

        return response()->json($mergedData);
    }


    public function exportPdf(Request $request)
    {
        $penjual_id = Auth::user()->id;
        $warung = Warung::where('penjual_id', $penjual_id)->get();
        $laporanPenjualan = $this->getData($request)->original;
        $pdf = PDF::loadView('penjual.laporan.pdf', ['laporanPenjualan' => $laporanPenjualan, 'warungs' => $warung]);
        return $pdf->download('laporan_penjualan.pdf');
    }

    public function showTopProducts(Request $request)
    {
        $allTimeTopProducts = $this->getAllTimeTopProducts(); // Fungsi untuk mendapatkan top produk sepanjang masa
        $periodicTopProducts = $this->getTopProducts($request); // Fungsi untuk mendapatkan top produk dengan periode

        return view('penjual.laporan.topproduct', compact('allTimeTopProducts', 'periodicTopProducts'));
    }

    public function getAllTimeTopProducts()
    {
        // Fungsi untuk mendapatkan top produk sepanjang masa
        $penjual_id = Auth::user()->id;
        $warung_id = Warung::where('penjual_id', $penjual_id)->pluck('id')->first();

        $allTimeTopProducts = Transaction::where('warung_id', $warung_id)
            ->where('transaction_status', 'lunas')
            ->with(['detail_transactions.product'])
            ->get()
            ->flatMap(function ($transaction) {
                return $transaction->detail_transactions;
            })
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'product_id' => $items->first()->product_id,
                    'product_name' => $items->first()->product->name,
                    'total_quantity_sold' => $items->sum('qty'),
                ];
            })
            ->sortByDesc('total_quantity_sold')
            ->values();

        return $allTimeTopProducts;
    }

    public function getTopProducts(Request $request)
    {
        $penjual_id = Auth::user()->id;
        $warung_id = Warung::where('penjual_id', $penjual_id)->pluck('id')->first();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $topProducts = Transaction::where('warung_id', $warung_id)
            ->where('transaction_status', 'lunas')
            ->whereBetween('created_at', [$startDate, $endDate]) // Filter berdasarkan rentang waktu
            ->with(['detail_transactions.product'])
            ->get()
            ->flatMap(function ($transaction) {
                return $transaction->detail_transactions;
            })
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'product_id' => $items->first()->product_id,
                    'product_name' => $items->first()->product->name,
                    'total_quantity_sold' => $items->sum('qty'),
                ];
            })
            ->sortByDesc('total_quantity_sold')
            ->values();

        if ($topProducts->isEmpty()) {
            return collect([]); // Mengembalikan koleksi kosong jika tidak ada data
        }

        return $topProducts;
    }
}
