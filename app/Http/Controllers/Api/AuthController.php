<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('school_token')->plainTextToken;

        return response()->json([
            'message' => 'Registered Successfully',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credential are incorrect'],
            ]);
        }

        $token = $user->createToken('school_token')->plainTextToken;

        return response()->json([
            'message' => 'login Successful',
            'token' => $token,
            'user' => $user,
            'roles' => $user->getRoleNames(),
        ]);
    }

    public function user(Request $request)
    {
        return $request->user()->load('roles');
    }

    public function logout(Request $request)
    {
        return $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
