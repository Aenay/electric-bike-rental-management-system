<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'issue',
        'repair_date',
        'status',
    ];

    protected $casts = [
        'repair_date' => 'date',
    ];

    public function bike(): BelongsTo
    {
        return $this->belongsTo(Bike::class);
    }
}
