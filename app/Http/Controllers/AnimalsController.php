<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
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
         switch($filter) {
            case 'price':
                [$minPrice, $maxPrice] = explode('-', $sortOption);
                $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
                break;
            case 'age':
                [$minAge, $maxAge] = explode('-', $sortOption);
                $query->whereBetween('age', [(float)$minAge, (float)$maxAge]);
                break;
            case 'type':
                $query->where('type',$sortOption);
                break;
            case 'status':
                $query->where('status',$sortOption);
                break;
            case 'owner':
                $query->where('owner_id',$sortOption);
                break;
         }

         if ($filter) {
            $query->orderBy($filter);
        }

        $sortedAnimals = $query->with(['owner','images'])->get();
        //Send back users
        $users = User::all(['id', 'name']);
        return Inertia::render('HomePage', [
            'users' => $users,
            'animals' => $sortedAnimals
        ]);

    }
}
