<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'status',
        'users_id',
        'featured_media',
        'content',
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            if (!$post->id) {
                $post->id = (string) Str::uuid();
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_media');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_uuid', 'category_uuid');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_uuid', 'tag_uuid');
    }

    public function seo()
    {
        return $this->hasOne(Seo::class, 'post_id');
    }
}
