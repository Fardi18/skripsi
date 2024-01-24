<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Warung;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        return view('penjual.laporan.index');
    }

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

        $laporanPenjualan = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('warung_id', [$warung_id])
            ->where('transaction_status', 'lunas')
            ->with('warung')
            ->get();


        if ($laporanPenjualan->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data penjualan dalam rentang tanggal yang diminta']);
        }

        // Ubah format tanggal menggunakan Carbon
        $laporanPenjualan = $laporanPenjualan->map(function ($transaction) {
            $transaction['formatted_created_at'] = Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY');
            // Kurangi total dengan pajak
            $transaction['total'] -= $transaction->pajak;
            return $transaction;
        });

        return response()->json($laporanPenjualan);
    }

    public function exportPdf(Request $request)
    {
        $penjual_id = Auth::user()->id;
        $warung = Warung::where('penjual_id', $penjual_id)->get();
        $laporanPenjualan = $this->getData($request)->original;
        $pdf = PDF::loadView('penjual.laporan.pdf', ['laporanPenjualan' => $laporanPenjualan, 'warungs' => $warung]);
        return $pdf->download('laporan_penjualan.pdf');
    }

    public function showTopProducts()
    {
        $topProducts = $this->getTopProducts(); // Panggil fungsi getTopProducts()
        return view('penjual.laporan.topproduct', compact('topProducts'));
    }

    public function getTopProducts()
    {
        $penjual_id = Auth::user()->id;
        $warung_id = Warung::where('penjual_id', $penjual_id)->pluck('id')->first();

        $topProducts = Transaction::where('warung_id', $warung_id)
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

        if ($topProducts->isEmpty()) {
            return collect([]); // Mengembalikan koleksi kosong jika tidak ada data
        }

        return $topProducts;
    }
}
