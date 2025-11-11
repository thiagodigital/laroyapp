<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;                // <-- Para buscar o usuário (User::where...)
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $request->validated();
            if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate(); // Regenera a sessão por segurança
            return response()->noContent(); // Resposta 204 (OK, sem conteúdo)
        }

        return response()->json([
            'message' => 'As credenciais fornecidas estão incorretas.',
        ], 401); // 401 Unauthorized
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent(); // Resposta 204
    }
}
