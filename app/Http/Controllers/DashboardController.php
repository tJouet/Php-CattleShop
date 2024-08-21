<?php

namespace App\Http\Controllers;

use App\Models\Animal;
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
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $animal->update($data);

        return redirect()->route('dashboard.edit', $animal->id)->with('success', 'Animal updated successfully!');
    }
}
