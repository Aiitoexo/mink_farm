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
