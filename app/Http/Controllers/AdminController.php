<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\AnimalBreed;
use App\Models\AnimalType;
use App\Services\AnimalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(AnimalService $service): Response
    {
        $animals = $service->getAnimals();

        $types = AnimalType::all()->select('name', 'id');
        $breeds = AnimalBreed::all()->select('name', 'id', 'animal_type_id');

        return Inertia::render('Auth/Index', [
            'auth' => true,
            'page' => 'admin',
            'animals' => $animals,
            'types' => $types,
            'breeds' => $breeds,
        ]);
    }

    public function updateOrCreate(AnimalRequest $request, Animal $animal, AnimalService $service): JsonResponse|RedirectResponse
    {
        $data = $request->validated();

        if ($animal->id) {
            $animal = $service->updateAnimal($animal, $data);
        } else {
            $animal = $service->createAnimal($data);
        }

        if ($animal) {
            return  redirect()->back();
        } else {
            return new JsonResponse(['error' => 'An error occurred'], 500);
        }
    }


    public function delete(Animal $animal, AnimalService $service): JsonResponse|RedirectResponse
    {
        $result = $service->deleteAnimal($animal);

        if ($result) {
            return redirect()->back();
        } else {
            return new JsonResponse(['error' => 'An error occurred'], 500);
        }
    }
}
