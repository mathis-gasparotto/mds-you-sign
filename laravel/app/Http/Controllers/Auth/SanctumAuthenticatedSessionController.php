<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SanctumAuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $user = User::where('email', $request->email)->first();
        $payload['user'] = $user;
        $payload['token'] = explode("|",$user->createToken('auth_token')->plainTextToken)[1];
        return new JsonResponse($payload);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse

    {
        $user = $request->user();

        Auth::guard('api')->logout();
        $user->tokens()->delete();
        return new JsonResponse(['message' => 'Logged out']);
    }
}
