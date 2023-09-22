<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo'
    ];

    protected $guarded = ['id'];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
