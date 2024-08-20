<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class AnimalsController extends Controller
{
    public function getAnimals(): Response
    {
        $animals = Animal::all();
        echo($animals);
        return Inertia::render('Welcome', [
            'animals' => $animals
        ]);
    }
}
