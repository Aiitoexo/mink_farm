<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalPhoto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
