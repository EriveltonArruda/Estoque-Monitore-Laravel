<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockExit extends Model {

    protected $fillable = ['type', 'document', 'responsible', 'total_value', 'exit_date', 'user_id'];

    // Uma saída tem muitos itens
    public function items(): HasMany {
        return $this->hasMany(StockExitItem::class);
    }
}
