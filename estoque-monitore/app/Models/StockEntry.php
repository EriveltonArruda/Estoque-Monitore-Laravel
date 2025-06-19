<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockEntry extends Model {
    use HasFactory;

    protected $fillable = ['supplier_id', 'note_number', 'entry_date', 'emission_date', 'total_value', 'user_id'];

    // Uma entrada pertence a um fornecedor
    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    // Uma entrada tem muitos itens
    public function items(): HasMany {
        return $this->hasMany(StockEntryItem::class);
    }
}
