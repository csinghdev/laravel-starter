<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\User;

class RegistrationController extends Controller
{
    /**
     * Register User
     *
     * @param RegistrationRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegistrationRequest $request) {
        User::create($request->getAttributes())->sendEmailVerificationNotification();

        return $this->respondWithMessage('User successfully created');
    }
}
