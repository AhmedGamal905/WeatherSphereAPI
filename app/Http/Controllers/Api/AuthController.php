<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users', 'email'],
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'token' => $user->createToken('API TOKEN')->plainTextToken,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:users', 'email'],
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials',
            ]);
        }

        return response()->json([
            'token' => $user->createToken('API TOKEN')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
