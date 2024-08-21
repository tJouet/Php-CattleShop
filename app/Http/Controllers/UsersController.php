<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;



class UsersController extends Controller {
    public function getUsers(): Response {
        $users = User::all(['id', 'name']);

        return Inertia::render('HomePage', [
            'users' => $users
        ]);
    }
}
