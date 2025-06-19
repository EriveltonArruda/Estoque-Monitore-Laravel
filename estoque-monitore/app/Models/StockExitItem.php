<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockExitItem extends Model {
    protected $fillable = ['stock_exit_id', 'product_id', 'quantity', 'sale_price'];
}
