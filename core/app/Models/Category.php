<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['title', 'desc'];

    protected static function booted()
    {
        static::creating(function ($category) {
            if (!$category->id) {
                $category->id = (string) Str::uuid();
            }
        });
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories', 'category_uuid', 'post_uuid');
    }
}
