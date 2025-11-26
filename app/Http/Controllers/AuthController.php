<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

                if (\App\Models\User::where('email', $data['email'])->exists()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['email' => ['The email has already been taken.']],
            ], 422);
        }

        $result = $this->authService->register($data);
        return response()->json($result, 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Wrong credentials'], 401);
        }

return response()->json([
    'access_token' => $token,
    'token_type' => 'bearer',
    'user' => auth()->user()
]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
