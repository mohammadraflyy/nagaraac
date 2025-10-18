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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pelanggan');
            $table->string('nomor_whatsapp');
            $table->string('merk_mobil');
            $table->string('nomor_polisi');
            $table->longText('keluhan');
            $table->enum('sumber_informasi', ['langganan', 'teman/saudara', 'google_maps', 'media_sosial']);
            $table->string('tanggal_booking');
            $table->string('jam_booking');
            $table->longText('riwayat_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
