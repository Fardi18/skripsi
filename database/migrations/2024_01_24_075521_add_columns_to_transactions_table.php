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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('nama_pengirim')->nullable(); // Menambahkan kolom 'nama_pengirim' dengan tipe data string
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('nama_pengirim'); // Menghapus kolom 'nama_pengirim'
            $table->dropColumn('total'); // Menghapus kolom 'total'
        });
    }
};
