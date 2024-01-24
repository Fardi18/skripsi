<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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

    public function editProfile()
    {
        $user = User::findOrfail(Auth::user()->id);

        return view("pembeli.profile.edit", compact("user"));
    }

    public function updateProfile(Request $request, $id)
    {
        // Mendapatkan data user
        $user = User::findOrFail($id);

        // Validasi data yang diterima dari formulir
        $validated = $request->validate([
            'name' => ['string', 'max:100'],
            'email' => ['string', 'max:100', 'email', Rule::unique('users')->ignore($id)],
            // 'password' => ['confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'phone_number' => ['string'],
            'address' => ['string', 'max:65535'],
        ]);

        try {
            // Update data pada database berdasarkan id
            $user->update([
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
