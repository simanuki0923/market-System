<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table name if different from the default
    protected $table = 'products';

    // Define the primary key if different from 'id'
    protected $primaryKey = 'id';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url'
    ];

    // Define relationships if needed
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }

}
