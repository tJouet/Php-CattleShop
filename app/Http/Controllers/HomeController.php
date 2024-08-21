<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        $users = User::all(['id', 'name','phone']);

        return Inertia::render('HomePage', [
            'users' => $users,
            'animals' => HomeController::getAnimalsFromQuery($request),
            'canLogin' => Route::has('login'),
        ]);
    }

    public function getAnimalsFromQuery(Request $request)  {
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
               $query -> where('owner_id',$sortOption);
               break;
        }

        if ($filter) {
           $query->orderBy($filter);
        }

       return $query->with('owner')->get();
   }
}
