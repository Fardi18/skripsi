<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil id penjual
        $penjual_id = Auth::id();

        $rekenings = Rekening::where("penjual_id", $penjual_id)->get();
        return view("penjual.rekening.index", compact("rekenings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("penjual.rekening.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $penjual_id = Auth::id();
        $validated = $request->validate([
            "name" => "required|string",
            "bank_name" => "required|string",
            "bank_number" => "required|string",
        ]);

        Rekening::create([
            "name" => $validated["name"],
            "bank_name" => $validated["bank_name"],
            "bank_number" => $validated["bank_number"],
            "penjual_id" => $penjual_id
        ]);

        return redirect('penjual/rekening');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        return view('penjual.rekening.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        return view('penjual.rekening.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penjual_id = Auth::id();
        $rekening = Rekening::findOrFail($id);
        $validated = $request->validate([
            'name' => 'string',
            'bank_name' => 'string',
            'bank_number' => 'string',
        ]);

        Rekening::where('id', $id)->update([
            'name' => $validated['name'],
            'bank_name' => $validated['bank_name'],
            'bank_number' => $validated['bank_number'],
            "penjual_id" => $penjual_id
        ]);

        return redirect("/penjual/rekening");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Rekening::destroy($id);
        return redirect('/penjual/rekening');
    }
}
