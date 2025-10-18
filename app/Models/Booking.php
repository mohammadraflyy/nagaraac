<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_pelanggan',
        'nomor_whatsapp',
        'merk_mobil',
        'nomor_polisi',
        'keluhan',
        'sumber_informasi',
        'tanggal_booking',
        'jam_booking',
        'riwayat_service'
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (!$booking->id) {
                $booking->id = (string) Str::uuid();
            }
        });
    }
}
