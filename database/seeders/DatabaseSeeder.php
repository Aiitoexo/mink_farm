<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\AnimalBreed;
use App\Models\AnimalPhoto;
use App\Models\AnimalType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Mink Farmer',
             'email' => 'mink@farm.com',
         ]);

         $types = [
             'Chien',
             'Cheval',
             'Mouton',
             'Cochon',
         ];

         $breeds = [
            'Chien' => [
                'Berger allemand',
                'Labrador',
                'Bouledogue français',
                'Caniche',
                'Chihuahua',
            ],
            'Cheval' => [
                'Pur-sang',
                'Arabe',
                'Selle français',
                'Trait breton',
                'Poney shetland',
            ],
            'Mouton' => [
                'Mérinos',
                'Suffolk',
                'Rouge de l\'Ouest',
                'Romane',
                'Charollais',
            ],
            'Cochon' => [
                'Duroc',
                'Landrace',
                'Large white',
                'Piétrain',
                'Hampshire',
            ],
         ];

        foreach ($types as $type) {
            AnimalType::create([
                'name' => $type,
            ]);
            foreach ($breeds[$type] as $breed) {
                AnimalBreed::create([
                    'name' => $breed,
                    'animal_type_id' => AnimalType::where('name', $type)->first()->id,
                ]);
            }
        }

        $photosStorage = [
            1 => Storage::url('photos/chien.jpg'),
            2 => Storage::url('photos/cheval.jpg'),
            3 => Storage::url('photos/mouton.jpg'),
            4 => Storage::url('photos/cochon.jpg'),
        ];

        Animal::factory(50)->create()->each(function (Animal $animal) use ($photosStorage): void {
            for ($i = 0; $i < random_int(2, 5); $i++) {
                AnimalPhoto::create([
                    'animal_id' => $animal->id,
                    'path' => $photosStorage[$animal->animal_type_id],
                ]);
            }

            $animal->photos->first()->update(['is_main' => true]);
        });
    }
}
