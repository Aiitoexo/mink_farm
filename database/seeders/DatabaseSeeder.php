<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\AnimalBreed;
use App\Models\AnimalPhoto;
use App\Models\AnimalType;
use App\Models\User;
use Illuminate\Database\Seeder;

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
             'dog',
             'horse',
             'sheep',
             'pig',
         ];

         $breeds = [
             'dog' => [
                 'labrador',
                 'frisian',
                 'bulldog',
                 'poodle',
                 'beagle',
                 'rottweiler',
             ],
             'horse' => [
                 'thoroughbred',
                 'mustang',
                 'clydesdale',
                 'shetland',
                 'appaloosa',
             ],
             'sheep' => [
                 'merino',
                 'dorper',
                 'suffolk',
                 'romney',
             ],
             'pig' => [
                 'berkshire',
                 'duroc',
                 'hampshire',
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

        Animal::factory(50)->create()->each(function (Animal $animal): void {
           $photos = AnimalPhoto::factory(random_int(2, 5))->create([
               'animal_id' => $animal->id,
           ]);

           $photos->first()->update([
               'is_main' => true,
           ]);
        });
    }
}
