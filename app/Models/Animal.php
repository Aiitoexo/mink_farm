<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class, 'animal_type_id');
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(AnimalBreed::class, 'animal_breed_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(AnimalPhoto::class);
    }

    public function getAnimalAvailable()
    {
        return $this->where('available', true)->get();
    }
}
