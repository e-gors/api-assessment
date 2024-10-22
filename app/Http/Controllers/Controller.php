<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ]);
        }

        $user = auth()->user();
        $token = $user->createToken('APP_URL')->accessToken;

        return response()->json([
            'status' => 200,
            'message' => "Logged in successfully!",
            'token' => $token,
            'user' => $user
        ]);
    }
}
