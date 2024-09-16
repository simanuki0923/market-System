<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'name', 'description', 'price', 'category_id', 'condition', 'image_url'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsSoldAttribute()
    {
        return $this->purchases()->exists();
    }
}