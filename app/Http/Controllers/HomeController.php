<?php

namespace App\Http\Controllers;

use App\Services\GetAnimalService;
use Illuminate\Http\Client\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(GetAnimalService $service): Response
    {
        $animals = $service->getAnimalAvailable();

        return Inertia::render('Guest/Index', [
            'animals' => $animals,
        ]);
    }
}
