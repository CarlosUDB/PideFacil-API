<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_id',
        'major_order_id',
        'quantity'
    ];

    //Relations
    public function major_order(): BelongsTo
    {
        return $this->belongsTo(MajorOrder::class);
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
