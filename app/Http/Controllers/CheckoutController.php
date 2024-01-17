<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{

    public function process(Request $request, Product $product)
    {
        try {
            // Save User Data
            $user = Auth::user();
            $user->update($request->except("total_price"));

            // Checkout Process
            $code = 'TRANS-' . mt_rand(000, 999);
            $carts = Cart::with(['product', 'user', 'warung'])
                ->where('user_id', Auth::user()->id)
                ->get();

            // Get Warung ID
            foreach ($carts as $cart) {
                $warung_id = $cart->warung_id;
            }
            // $warung_id = $request->input('warung_id');

            // Transaction Create
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'warung_id' => $warung_id,
                'code' => $code,
                'total_price' => $request->total_price,
                'transaction_status' => 'Pending',
                'shipping_status' => 'Pending',
                'ongkir' => 2000,
                'pajak' => $request->total_price * 0.02,
            ]);

            // Detail Transaction Create
            foreach ($carts as $cart) {
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product->id,
                    'qty' => $cart->qty,
                    'price' => $cart->product->price,
                ]);

                // Kurangi kuantitas barang hanya jika transaksi berhasil
                $product = Product::find($cart->product_id);

                $product->update([
                    'stock' => $product->stock - $cart->qty
                ]);

                // Add item details to the array
                $itemDetails[] = [
                    'id' => $cart->product->id,
                    'price' => $cart->product->price,
                    'quantity' => $cart->qty,
                    'name' => $cart->product->name,
                ];
            }

            // Delete Cart Data
            Cart::with(['product', 'user', 'warung'])
                ->where('user_id', Auth::user()->id)
                ->delete();

            // Midtrans Configuration
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            // $transaction->total_price = $transaction->total_price + $transaction->pajak + $transaction->ongkir;
            // $transaction->save();

            // Buat array untuk dikirim ke Midtrans
            $midtrans = [
                'transaction_details' => [
                    'order_id' => $transaction->id,
                    'gross_amount' => $transaction->total_price,
                ],
                // 'item_details' => $itemDetails,
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'phone' => Auth::user()->phone_number,
                    'email' => Auth::user()->email,
                    'address' => Auth::user()->address,
                ],
                'enabled_payments' => [
                    'gopay', 'permata_va', 'bank_transfer'
                ],
                'vtweb' => []
            ];

            // dd($midtrans);

            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Commit the transaction and decrement stock only if it was successful
            DB::commit();
            // dd($paymentUrl);


            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollback();

            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Instance notifikasi Midtrans
        $notification = new Notification();

        // Assign ke variabel untuk memudahkan penulisan kode
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle status notifikasi
        if ($status == 'capture') {
            if ($type == 'credit_cart') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'PENDING';
                    $transaction->update(['transaction_status' => 'Pending']);
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                    $transaction->update(['transaction_status' => 'Lunas']);
                }
            }
        } else if ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
            $transaction->update(['transaction_status' => 'Lunas']);
        } else if ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
            $transaction->update(['transaction_status' => 'Pending']);
        } else if ($status == 'deny') {
            $transaction->transaction_status = 'CANCELLED';
            $transaction->update(['transaction_status' => 'Cancelled']);
        } else if ($status == 'expire') {
            $transaction->transaction_status = 'CANCELLED';
            $transaction->update(['transaction_status' => 'Cancelled']);
        } else if ($status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
            $transaction->update(['transaction_status' => 'Cancelled']);
        }

        // Simpan transaksi
        $transaction->save();
    }
}
