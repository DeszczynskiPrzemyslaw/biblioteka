<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, Response::HTTP_CREATED);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::firstWhere('email', $fields['email']);
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Credentials does not match.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response([
            'user' => $user,
            'token' => $user->createToken('myapptoken')->plainTextToken
        ], Response::HTTP_CREATED);
    }

    public function logout()
    {
        auth()->user()->tokens()->where(['name' => 'myapptoken'])->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
