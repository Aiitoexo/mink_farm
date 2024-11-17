<?php

namespace App\Services;

use App\Models\Animal;

class GetAnimalService
{
    public function getAnimalsAvailable()
    {
        return $this->format(
            Animal::with('type:name,id', 'breed:name,id', 'photos')
                ->where('status', 'available')
                ->get()
        );
    }

    public function getAnimals()
    {
        return $this->format(
            Animal::with('type:name,id', 'breed:name,id', 'photos')->get()
        );
    }

    private function format($animals)
    {
        return $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'type' => [
                    'id' => $animal->type->id,
                    'name' => $animal->type->name,
                ],
                'breed' => [
                    'id' => $animal->breed->id,
                    'name' => $animal->breed->name,
                ],
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
