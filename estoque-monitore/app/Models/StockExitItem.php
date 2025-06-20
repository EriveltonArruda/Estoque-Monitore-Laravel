<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockExitItem extends Model {
    use HasFactory;

    protected $fillable = ['stock_exit_id', 'product_id', 'quantity', 'sale_price'];

    /**
     * Define a relação: um item de saída "pertence a" um produto.
     */
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
