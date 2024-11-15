<?php

namespace App\Services;

use App\Models\Animal;

class GetAnimalService
{
    public function getAnimalAvailable()
    {
        return $this->format(Animal::with('type', 'breed')->where('status', 'available')->get());
    }

    private function format($animals)
    {
        return $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'type' => $animal->type->name,
                'breed' => $animal->breed->name,
                'photos' => $animal->photos->map(function ($photo) {
                    return [
                        'id' => $photo->id,
                        'url' => $photo->url,
                        'is_main' => $photo->is_main,
                    ];
                }),
                'price' => $animal->price_ttc / 100,
            ];
        });
    }
}
