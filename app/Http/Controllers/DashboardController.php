<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Types\AnimalType;
use Illuminate\Http\Request;
use Inertia\Inertia;
class DashboardController extends Controller
{

    public function index(Request $request) {

        return Inertia::render('Dashboard',[
            'userAnimals' => Animal::where('owner_id',$request->user()->id)->get()
        ]);
    }
    public function editAnimal($id) {
        $animal = Animal::findOrFail($id);
        return Inertia::render('DashboardEditor',[
            'animal' => $animal
        ]);
    }

    public function updateAnimal(Request $request, $id) {
        $animal = Animal::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'required|integer',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|string',

        ]);

        $animal->update($data);

        return redirect()->route('dashboard');
    }

    public function putDownAnimal ($id) {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return redirect()->route('dashboard');
    }

    public function displayCreateForm () {
        $animalTypes = collect(AnimalType::cases())->map(fn($type) => $type->value);
        return Inertia::render('DashboardCreate',[
            "animalTypes" => $animalTypes
        ]);
    }
    public function createAnimal (Request $request) {
        $userId = $request->user()->id;
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'race' => 'required|string|max:50',
            'type' => 'required|string|max:50',
        ]);

        $data['owner_id']=$userId;

        Animal::create($data);

        return Inertia::render('Dashboard',[
            'userAnimals' => Animal::where('owner_id',$userId)->get()
        ]);
    }
}
