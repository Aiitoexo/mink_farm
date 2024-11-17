<?php

namespace App\Services;

use App\Models\Animal;

class GetAnimalService
{
    public function getAnimalAvailable()
    {
        return $this->format(
            Animal::with('type:name,id', 'breed:name,id', 'photos')
                ->where('status', 'available')
                ->get()
        );
    }

    private function format($animals)
    {
        return $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'type' => $animal->type->name,
                'breed' => $animal->breed->name,
                'description' => $animal->description,
                'age' => $animal->age,
                'status' => $animal->status,
                'photos' => $animal->photos->map(function ($photo) {
                    return [
                        'id' => $photo->id,
                        'url' => $photo->path,
                        'is_main' => $photo->is_main,
                    ];
                }),
                'price' => $animal->price_ttc / 100,
            ];
        });
    }
}
