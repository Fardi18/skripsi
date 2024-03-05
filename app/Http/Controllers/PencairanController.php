<?php

namespace App\Http\Controllers;

use App\Models\Pencairan;
use App\Models\Transaction;
use App\Models\Warung;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PencairanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pencairans = Pencairan::with('penjual', 'warung', 'rekening')->get();
        // Mengambil semua data warung dengan relasi penjual, rekening penjual, transaksi, dan detail transaksi
        $warungs = Warung::with('penjual', 'penjual.rekening', 'transactions', 'transactions.detail_transactions')->get();

        // Inisialisasi variabel untuk menyimpan total pendapatan dari semua warung pada hari ini
        $total_pendapatan_hari_ini = 0;

        // Melakukan perulangan untuk setiap warung
        foreach ($warungs as $warung) {
            // Menghitung total pendapatan warung hanya untuk hari ini
            $pendapatan_warung_hari_ini = Transaction::where("warung_id", $warung->id)
                ->where('transaction_status', 'lunas')
                ->whereDate('created_at', Carbon::today())
                ->sum('total') - Transaction::where("warung_id", $warung->id)
                ->where('transaction_status', 'lunas')
                ->whereDate('created_at', Carbon::today())
                ->sum('pajak');

            // Menambahkan total pendapatan warung pada hari ini ke total pendapatan semua warung
            $total_pendapatan_hari_ini += $pendapatan_warung_hari_ini;

            // Menambahkan data total pendapatan warung pada hari ini ke dalam objek warung
            $warung->total_pendapatan_hari_ini = $pendapatan_warung_hari_ini;
        }

        // Mengirim data total pendapatan semua warung pada hari ini ke tampilan
        return view('admin.pencairan.index', compact('warungs', 'total_pendapatan_hari_ini', 'pencairans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $now = Carbon::now()->format('H:i');

        $warung = Warung::with('penjual', 'penjual.rekening', 'transactions', 'transactions.detail_transactions')->findOrFail($id);

        // Inisialisasi variabel untuk menyimpan total pendapatan dari semua warung pada hari ini
        $total_pendapatan_hari_ini = 0;

        // Menghitung total pendapatan warung hanya untuk hari ini
        $pendapatan_warung_hari_ini = Transaction::where("warung_id", $id)
            ->where('transaction_status', 'lunas')
            ->whereDate('created_at', Carbon::today())
            ->sum('total') - Transaction::where("warung_id", $warung->id)
            ->where('transaction_status', 'lunas')
            ->whereDate('created_at', Carbon::today())
            ->sum('pajak');

        // Menambahkan total pendapatan warung pada hari ini ke total pendapatan semua warung
        $total_pendapatan_hari_ini += $pendapatan_warung_hari_ini;

        // Menambahkan data total pendapatan warung pada hari ini ke dalam objek warung
        $warung->total_pendapatan_hari_ini = $pendapatan_warung_hari_ini;


        return view('admin.pencairan.add', compact('warung', 'total_pendapatan_hari_ini', 'now'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            "penjual_id" => "required",
            "warung_id" => "string",
            "rekening_id" => "required",
            "status" => "required",
            "total" => "required",
            "image" => "required|mimes:jpg,jpeg,png|max:5120",
        ]);

        // menyimpan file image ke dalam storage
        $saveImage['image'] = Storage::putFile('public/image', $request->file('image'));

        try {
            // mencoba menyimpan data warung
            Pencairan::create([
                'penjual_id' => $validated['penjual_id'],
                'warung_id' => $validated['warung_id'],
                'rekening_id' => $validated['rekening_id'],
                'status' => $validated['status'],
                'total' => $validated['total'],
                'image' => $saveImage['image'],
            ]);

            return redirect('/admin/pencairan')->with('success', 'Pencairan Pendapatan berhasil dibuat!');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan kesalahan pada halaman yang sama
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Periksa kembali data yang dimasukkan.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pencairan = Pencairan::with('penjual', 'warung', 'rekening')->findOrFail($id);
        return view('admin.pencairan.show', compact('pencairan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pencairan = Pencairan::with('penjual', 'warung', 'rekening')->findOrFail($id);
        return view('admin.pencairan.edit', compact('pencairan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pencairan = Pencairan::with('penjual', 'warung', 'rekening')->findOrFail($id);
        // validasi form
        $validated = $request->validate([
            "status" => "required",
            "image" => "required|mimes:jpg,jpeg,png|max:5120",
        ]);

        // Cek apakah ada unggahan gambar baru
        if ($request->hasFile('image')) {
            // Hapus foto yang lama
            Storage::delete($pencairan->image);

            // Simpan foto yang baru
            $newImage = ['image' => Storage::putFile('public/image', $request->file('image'))];
        } else {
            // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
            $newImage = ['image' => $pencairan->image];
        }

        // Update data di database
        try {
            $pencairan->update([
                'status' => $validated['status'],
                'image' => $newImage['image'],
            ]);

            return redirect('/admin/pencairan')->with('success', 'Pencairan pendapatan berhasil diperbarui!');
        } catch (Exception $e) {
            // Tangani error dan tampilkan pesan kesalahan pada halaman yang sama
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Periksa kembali data yang dimasukkan']);
        }
    }
}
