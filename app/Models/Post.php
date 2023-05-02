<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'cover-image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // public function image(): HasOne
    // {
    //     return $this->hasOne(Image::class);
    // }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearch($query) {
        if ($key = request()->key) {
            $query = $query->where('title','like', "%$key%");            
        }
        return $query;
    }
}
