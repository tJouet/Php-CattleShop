<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Animals extends Controller
{
    public function getAnimals(): View
    {
        $animals = DB::table('animals')->get();

        return view('user.index', ['animals' => $animals]);
    }
}
