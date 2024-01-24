<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Warung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PenjualController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan penjual yang sedang login
        $penjual = Auth::user();

        // Memeriksa apakah penjual memiliki warung
        if ($penjual->warung) {
            // Jika memiliki warung, dapatkan warung_id
            $warung_id = $penjual->warung->id;
            $total_products = Product::where("warung_id", $warung_id)->count();
            $total_transactions = Transaction::where("warung_id", $warung_id)
                ->where('transaction_status', 'lunas')
                ->count();

            // Menghitung total pendapatan setelah dikurangi pajak
            $transactions = Transaction::where("warung_id", $warung_id)
                ->where('transaction_status', 'lunas')
                ->get();
            $total_pendapatan = 0;
            foreach ($transactions as $transaction) {
                $total_pendapatan += $transaction->total - $transaction->pajak;
            }

            return view("penjual.dashboard", compact("total_products", "total_transactions", "total_pendapatan"));
        } else {
            $total_products = 0;
            $total_transactions = 0;
            $total_pendapatan = 0;
            return view("penjual.dashboard", compact("total_products", "total_transactions", "total_pendapatan"));
        }
    }

    public function penjualProfile()
    {
        $profile = Penjual::with(['province', 'regency', 'warung'])->findOrFail(Auth::user()->id);

        return view("penjual.profile.index", compact("profile"));
    }

    public function penjualUpdate(Request $request, $id)
    {
        // Mendapatkan data user
        $penjual = Penjual::findOrFail($id);

        // Validasi data yang diterima dari formulir
        $validated = $request->validate([
            'name' => ['string', 'max:100'],
            'email' => ['string', 'max:100', 'email', Rule::unique('penjuals')->ignore($id)],
            // 'password' => ['confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'phone_number' => ['string'],
            'address' => ['string', 'max:65535'],
        ]);

        try {
            // Update data pada database berdasarkan id
            $penjual->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'address' => $validated['address'],
            ]);

            // Notifikasi session jika berhasil
            return redirect()->back()->with('success', 'Profile Berhasil Diubah!');
        } catch (\Exception $e) {
            // Notifikasi session jika gagal
            return redirect()->back()->with('error', 'Gagal mengubah profile. Silakan coba lagi.');
        }
    }
}
