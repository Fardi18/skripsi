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
        Schema::create('warungs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->longText('description');
            $table->string('address');
            $table->string('location')->nullable(true);
            $table->foreignId('penjual_id');
            $table->foreign('penjual_id')->references('id')->on('penjuals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warungs');
    }
};
