<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;


class AnimalsController extends Controller
{
    public function getAnimals(): Response
    {
        $animals = Animal::all();

        return Inertia::render('HomePage', [
            'animals' => $animals
        ]);
    }
    public function getFilterOptions(Request $request)  {
         $filter = $request->query('filter');
         $sortOption = $request->query('sort_option');
         $query = Animal::query();
        //  /filter-options?filter=price&sort_option=100-200
         switch($filter) {
            case 'price':
                [$minPrice, $maxPrice] = explode('-', $sortOption);
                $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
                break;
         }

         if ($filter) {
            $query->orderBy($filter);
        }

        $sortedAnimals = $query->get();

        return Inertia::render('HomePage', [
            'animals' => $sortedAnimals
        ]);

    }
}
