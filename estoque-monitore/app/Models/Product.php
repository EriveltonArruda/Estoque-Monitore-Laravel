<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'reference',
        'description',
        'unit',
        'sale_price',
        'stock_quantity',
        'minimum_stock_quantity',
        'category_id',
        'user_id',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
