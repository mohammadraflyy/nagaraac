<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['title', 'desc'];

    protected static function booted()
    {
        static::creating(function ($tag) {
            if (!$tag->id) {
                $tag->id = (string) Str::uuid();
            }
        });
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_uuid', 'post_uuid');
    }
}
