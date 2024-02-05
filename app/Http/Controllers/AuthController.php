<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Penjual;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login()
    {
        // mmebuka page login
        return view('auth.login');
    }

    public function pembeliregister()
    {
        // membuka page register untuk pembeli
        return view('auth.pembeliregister');
    }

    public function penjualregister()
    {
        return view('auth.penjualregister');
    }

    public function dopembeliregister(Request $request)
    {
        // validasi inputan/request dari user
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required'],
            'address' => ['required', 'string', 'max:65535'],
            'provinces_id' => ['required'],
            'regencies_id' => ['required'],
        ]);

        // menyimpan data pembeli
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'provinces_id' => $request->provinces_id,
            'regencies_id' => $request->regencies_id,
        ]);

        Auth::login($user);

        return redirect('/login');
    }

    public function dopenjualregister(Request $request)
    {
        // validasi inputan/request dari user
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . Penjual::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:65535'],
            'phone_number' => ['required'],
            'provinces_id' => ['required'],
            'regencies_id' => ['required'],
        ]);

        // menyimpan data penjual
        $penjual = Penjual::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'provinces_id' => $request->provinces_id,
            'regencies_id' => $request->regencies_id,
        ]);

        Auth::login($penjual);

        return redirect('/login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard');
        }

        if (Auth::guard('penjual')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/penjual/dashboard");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
