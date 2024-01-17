<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Penjual;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function warung()
    {

        $penjual = Penjual::with('province')->where("id", Auth::user()->id)->get();
        return view("penjual.dashboard");
    }
}
