<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SEO extends Model
{
    use HasFactory;

    protected $table = 'seo';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'post_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
    ];

    protected static function booted()
    {
        static::creating(function ($seo) {
            if (!$seo->id) {
                $seo->id = (string) Str::uuid();
            }
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
