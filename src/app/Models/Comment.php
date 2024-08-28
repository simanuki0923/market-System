<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Define the table name if different from the default
    protected $table = 'comments';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'product_id',
        'user_id',
        'content'
    ];

    // Define relationships if needed
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
