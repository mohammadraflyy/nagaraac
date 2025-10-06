<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostTag extends Model
{
    use HasFactory;

    protected $table = 'post_tags';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['post_uuid', 'tag_uuid'];

    protected static function booted()
    {
        static::creating(function ($pivot) {
            if (!$pivot->id) {
                $pivot->id = (string) Str::uuid();
            }
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_uuid');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_uuid');
    }
}
