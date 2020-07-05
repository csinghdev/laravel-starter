<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function updateProfile() {
        $attributes = request()->validate(['name' => 'nullable|string']);

        auth()->user()->update($attributes);

        return $this->respondWithMessage("User successfully updated");
    }
}
