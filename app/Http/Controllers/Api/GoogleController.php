<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;

class GoogleController extends Controller
{
    public function login(Request $request)
    {
        $jwt = $request->input('credential');

        if (!$jwt) {
            return response()->json(['error' => 'Token manquant'], 400);
        }

        $googleKeys = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v3/certs'), true);
        $decoded = JWT::decode($jwt, JWK::parseKeySet($googleKeys));

        $user = User::firstOrCreate(
            ['email' => $decoded->email],
            [
                'name' => $decoded->name,
                'password' => bcrypt(uniqid()),
                'email_verified_at' => now(),
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login réussi',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
