<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function preload(): Response
    {
        $users = User::all(['id', 'name']);
        $animals = Animal::with('owner')->get();
        $animalsTable = Schema::getColumnListing('animals');

        return Inertia::render('HomePage', [
            'animalsSearchOptions' => $animalsTable,
            'users' => $users,
            'animals' => $animals,
        ]);
    }
}
