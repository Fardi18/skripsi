<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Warung;
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
            ->with('warung')
            ->get();


        if ($laporanPenjualan->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data penjualan dalam rentang tanggal yang diminta']);
        }

        // Ubah format tanggal menggunakan Carbon
        $laporanPenjualan = $laporanPenjualan->map(function ($transaction) {
            $transaction['formatted_created_at'] = Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY HH:mm:ss');
            return $transaction;
        });

        return response()->json($laporanPenjualan);
    }
}
