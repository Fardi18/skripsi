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
        Schema::create('pencairans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjual_id');
            $table->foreign('penjual_id')->references('id')->on('penjuals')->onDelete('cascade');
            $table->foreignId('warung_id');
            $table->foreign('warung_id')->references('id')->on('warungs')->onDelete('cascade');
            $table->foreignId('rekening_id');
            $table->foreign('rekening_id')->references('id')->on('rekenings')->onDelete('cascade');
            $table->string('status'); //Sukses/Pending
            $table->string('image');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencairans');
    }
};
