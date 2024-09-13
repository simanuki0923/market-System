<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'status',
        'purchase_date',
    ];

    // Automatically cast purchase_date to a Carbon instance
    protected $casts = [
        'purchase_date' => 'datetime',
    ];

    // Define status constants (optional)
    const STATUS_COMPLETED = 'completed';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';

    /**
     * Relationship: Purchase belongs to a Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Purchase belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}