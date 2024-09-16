<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_method'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getPaymentMethodAttribute($value)
    {
        $validMethods = ['credit_card', 'convenience_store', 'bank_transfer'];
        return in_array($value, $validMethods) ? $value : 'credit_card';
    }
}
