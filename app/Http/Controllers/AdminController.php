<?php

namespace App\Http\Controllers;

use App\Models\AnimalType;
use App\Services\GetAnimalService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(GetAnimalService $service)
    {
        $animals = $service->getAnimals();

        $types = AnimalType::all()->select('name', 'id');

        return Inertia::render('Auth/Index', [
            'auth' => true,
            'page' => 'admin',
            'animals' => $animals,
            'types' => $types,
        ]);
    }

    public function create()
    {

    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }

    public function logout()
    {

    }
}
