<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSearch($query) {
        if ($key = request()->key) {
            $query = $query->where('name','like', "%$key%");            
        }
        return $query;
    }
}
