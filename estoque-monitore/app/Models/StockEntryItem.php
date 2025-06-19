<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockEntryItem extends Model {
    use HasFactory;

    protected $fillable = ['stock_entry_id', 'product_id', 'quantity', 'purchase_price'];

    // Um item de entrada pertence a um produto
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
