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
            'type'=> 'required|string',
            'race'=> 'required|string',
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
        return Inertia::render('DashboardCreate',[]);
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data['owner_id']=$userId;

        $animal = Animal::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/images', $filename);

                $animal->images()->create([
                    'url' => $filename,
                ]);
            }
        }

        return Inertia::render('Dashboard',[
            'userAnimals' => Animal::where('owner_id',$userId)->get()
        ]);
    }
}
