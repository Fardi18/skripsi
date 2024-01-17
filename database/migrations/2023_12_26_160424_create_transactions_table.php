<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('warung_id');
            $table->foreign('warung_id')->references('id')->on('warungs')->onDelete('cascade');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('total_price');
            $table->string('transaction_status'); //LUNAS/SUCCESS/CANCELED
            $table->string('shipping_status'); //DIBUNGKUS/DIKIRIM/SUKSES
            $table->integer('ongkir');
            $table->integer('pajak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
