<?php

namespace App\Livewire\Bookings;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Booking as BookingModel;
use Illuminate\Support\Str;

class Booking extends Component
{
    public $nama_pelanggan;
    public $nomor_whatsapp;
    public $merk_mobil;
    public $nomor_polisi;
    public $keluhan;
    public $sumber_informasi;
    public $tanggal_booking;
    public $jam_booking;
    public $riwayat_service;

    protected $rules = [
        'nama_pelanggan' => 'required|string|max:255',
        'nomor_whatsapp' => 'required|string|max:255',
        'merk_mobil' => 'required|string|max:255',
        'nomor_polisi' => 'required|string|max:255',
        'keluhan' => 'required|string',
        'sumber_informasi' => 'required|in:langganan,teman/saudara,google_maps,media_sosial',
        'tanggal_booking' => 'required|date',
        'jam_booking' => 'required',
        'riwayat_service' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        BookingModel::create([
            'id' => Str::uuid(),
            'nama_pelanggan' => $this->nama_pelanggan,
            'nomor_whatsapp' => $this->nomor_whatsapp,
            'merk_mobil' => $this->merk_mobil,
            'nomor_polisi' => $this->nomor_polisi,
            'keluhan' => $this->keluhan,
            'sumber_informasi' => $this->sumber_informasi,
            'tanggal_booking' => $this->tanggal_booking,
            'jam_booking' => $this->jam_booking,
            'riwayat_service' => $this->riwayat_service,
        ]);

        $this->reset();
        $this->dispatch('booking-success', 'Booking berhasil dikirim. silahkan tunggu 1x24 jam konfirmasi dari admin!');
    }

    #[Layout('components.layouts.blog')]
    public function render()
    {
        return view('livewire.bookings.booking');
    }
}
