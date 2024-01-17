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
        // warung id
        $penjual_id = Auth::id();
        $warung_id = Warung::where("penjual_id", $penjual_id)->first()->id;

        // $transactions = Transaction::where('warung_id', $warung_id)->get();
        $transactions = Transaction::with('user.province', 'user.regency')->where('warung_id', $warung_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view("penjual.transaction.index", compact("transactions"));
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
        ]);

        Transaction::where("id", $id)->update([
            "shipping_status" => $validated["shipping_status"],
        ]);

        return redirect("/penjual/transaction");
    }
}
