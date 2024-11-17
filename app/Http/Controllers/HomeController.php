<?php

namespace App\Http\Controllers;

use App\Models\AnimalType;
use App\Services\GetAnimalService;
use Illuminate\Http\Client\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(GetAnimalService $service): Response
    {
        $animals = $service->getAnimalAvailable();

        $types = AnimalType::all()->select('name', 'id');

        return Inertia::render('Guest/Index', [
            'animals' => $animals,
            'types' => $types,
        ]);
    }
}
