<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PenjualController extends Controller
{
    public function warung()
    {

        $penjual = Penjual::with('province')->where("id", Auth::user()->id)->get();
        return view("penjual.dashboard");
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
