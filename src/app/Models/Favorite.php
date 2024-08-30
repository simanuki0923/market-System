<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Define the table name if different from the default
    protected $table = 'favorites';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'product_id',
        'user_id'
    ];

    // Productとのリレーションシップの定義
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Userとのリレーションシップの定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
