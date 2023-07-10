<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;
    protected $table = 'purchase_product';
    protected $guarded = ["id"];
    // public function position(): BelongsTo
    // {
    //     return $this->belongsTo(Position::class);
    // }
}
