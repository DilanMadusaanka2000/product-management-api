<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'rating',
        'image',
        'user_id',
    ];
    protected $casts = [
        'price'  => 'decimal:2',
        'rating' => 'decimal:1',
        'stock'  => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
