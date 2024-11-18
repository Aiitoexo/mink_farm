<?php

namespace App\Services;

use App\Models\Animal;

class AnimalService
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

    public function getAnimal(Animal $animal)
    {
        return $this->format(
            Animal::with('type:name,id', 'breed:name,id', 'photos')->where('id', $animal->id)->get()
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

    public function updateAnimal(Animal $animal, $data)
    {
        $photos = $data['photos'];

        $photoIdsFromRequest = collect($photos)->filter(function ($photo) {
            return isset($photo['id']);
        })->pluck('id')->toArray();

        $animal->photos()->whereNotIn('id', $photoIdsFromRequest)->delete();

        foreach ($photos as $photo) {
            if (isset($photo['id'])) {
                $existingPhoto = $animal->photos()->find($photo['id']);
                if ($existingPhoto) {
                    $existingPhoto->update([
                        'is_main' => $photo['is_main'],
                    ]);
                }
            } else {
                $file = $photo['file'];
                $uniqueName = date('YmdHis') . '_' . hash('sha256', $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('photos', $uniqueName);

                $animal->photos()->create([
                    'path' => $filePath,
                    'is_main' => $photo['is_main'] ?? false,
                ]);
            }
        }

        $animal->update([
            'name' => $data['name'],
            'animal_type_id' => $data['type'],
            'animal_breed_id' => $data['breed'],
            'description' => $data['description'],
            'age' => $data['age'],
            'status' => $data['status'],
            'price_ttc' => $data['price'] * 100,
        ]);

        return $this->getAnimal($animal);
    }

    public function deleteAnimal(Animal $animal)
    {
        $animal->photos()->delete();
        $animal->delete();

        return true;
    }
}
