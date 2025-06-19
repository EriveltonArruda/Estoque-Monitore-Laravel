<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model {
    use HasFactory;

    protected $fillable = [
        'fantasy_name',
        'corporate_name',
        'document',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'notes',
    ];
}
