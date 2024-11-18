<?php

namespace App\Http\Controllers;

use App\Models\AnimalType;
use App\Services\AnimalService;
use Illuminate\Http\Client\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(AnimalService $service): Response
    {
        $animals = $service->getAnimalsAvailable();

        $types = AnimalType::all()->select('name', 'id');

        $auth = (bool)auth()->user();

        return Inertia::render('Guest/Index', [
            'animals' => $animals,
            'types' => $types,
            'auth' => $auth,
        ]);
    }
}
