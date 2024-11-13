<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials = $request->only(['email','password']);
        if (Auth::attempt($credentials)) {
            return [
                'message' => 'ok',
                'user' => auth()->user(),
            ];
        }
        return [
            'message' => 'Login or email is not valid.',
        ];
    }

    public function currentUser() {
        return [
            'user' => \auth()->user(),
        ];
    }

    public function logout() {
        auth()->logout();
        return [
            'message' => 'ok'
        ];
    }
}
