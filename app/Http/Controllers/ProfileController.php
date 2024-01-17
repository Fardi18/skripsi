<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $profile = User::with(['province', 'regency', 'transactions' => function ($query) {
            $query->with('detail_transactions')->orderBy('created_at', 'desc');
        }])->findOrFail(Auth::user()->id);

        return view("pembeli.profile.index", compact("profile"));
    }


    public function detailTransaction(Transaction $transaction)
    {
        $details = $transaction->detail_transactions()->with('product')->get();
        return view("pembeli.profile.detailtransaction", compact("transaction", "details"));
    }
}
