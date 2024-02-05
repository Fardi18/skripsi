<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\Warung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualTransactionController extends Controller
{
    public function index()
    {
        $penjual_id = Auth::id();

        $warung = Warung::where("penjual_id", $penjual_id)->first();

        if ($warung) {
            $warung_id = $warung->id;
            $transactions = Transaction::with('user.province', 'user.regency')
                ->where('warung_id', $warung_id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view("penjual.transaction.index", compact("transactions"));
        } else {
            // Handle jika tidak ada warung yang cocok
            $transactions = []; // Atur variabel $transactions ke nilai default yang sesuai
            return view("penjual.transaction.index", compact("transactions"));
        }
    }


    public function show(Transaction $transaction)
    {
        $details = $transaction->detail_transactions()->with('product')->get();
        // dd($details);
        return view("penjual.transaction.show", compact("transaction", "details"));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrfail($id);
        return view("penjual.transaction.edit", compact("transaction"));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrfail($id);
        $validated = $request->validate([
            "shipping_status" => "required",
            "nama_pengirim" => "string|required",
        ]);

        Transaction::where("id", $id)->update([
            "shipping_status" => $validated["shipping_status"],
            "nama_pengirim" => $validated["nama_pengirim"],
        ]);

        return redirect("/penjual/transaction")->with('success', 'Transaksi berhasil diperbarui!');
    }
}
