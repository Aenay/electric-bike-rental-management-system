<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];

    public function bikes(): HasMany
    {
        return $this->hasMany(Bike::class);
    }
}


