<?php

namespace App\Http\Controllers;

use App\ApiCode;
use App\User;
use Illuminate\Http\Request;

class VerificationController extends Controller {

    public function __construct() {
        $this->middleware('auth:api')->except(['verify']);
    }

    /**
     * Verify email
     *
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function verify($user_id, Request $request) {
        if (! $request->hasValidSignature()) {
            return $this->respondUnAuthorizedRequest(ApiCode::INVALID_EMAIL_VERIFICATION_URL);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->to('/');
    }

    /**
     * Resend email verification link
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resend() {
        if (auth()->user()->hasVerifiedEmail()) {
            return $this->respondBadRequest(ApiCode::EMAIL_ALREADY_VERIFIED);
        }

        auth()->user()->sendEmailVerificationNotification();

        return $this->respondWithMessage("Email verification link sent on your email id");
    }
}
