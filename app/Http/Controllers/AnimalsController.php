<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Inertia\Inertia;
use Inertia\Response;

class AnimalsController extends Controller
{
    public function getAnimals(): Response
    {
        $animals = Animal::all();

        return Inertia::render('HomePage', [
            'animals' => $animals
        ]);
    }
    public function filterByOwner() : Response {
        $animals = Animal::all();

        return Inertia::render('HomePage', [
            'animals' => $animals
        ]);
    }
}
