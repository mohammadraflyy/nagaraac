<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'client_name',
        'hash_name',
        'file_size',
        'file_format',
        'media_type',
    ];

    protected static function booted()
    {
        static::creating(function ($media) {
            if (!$media->id) {
                $media->id = (string) Str::uuid();
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'featured_media');
    }
}
