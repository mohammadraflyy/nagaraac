<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_polisi',
        'pelayanan',
        'durasi',
        'kesan',
        'saran'
    ];

    protected static function booted()
    {
        static::creating(function ($testimonial) {
            if (!$testimonial->id) {
                $testimonial->id = (string) Str::uuid();
            }
        });
    }
}
