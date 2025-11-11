<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function username()
    {
        return 'phone';
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        // 2. Tentar autenticar (o padrão do Laravel usa 'email')
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            // 3. Falha na autenticação
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // 4. Sucesso na autenticação
        $request->session()->regenerate();

        // 5. Retorna o usuário autenticado
        return response()->json(Auth::user());
    }

    public function logout(Request $request)
    {
        // Usa o guard 'web' pois o Sanctum (cookie) se baseia nele
        Auth::guard('web')->logout();

        // Invalida a sessão
        $request->session()->invalidate();

        // Regenera o token CSRF
        $request->session()->regenerateToken();

        // Retorna uma resposta vazia (204 No Content)
        return response()->noContent();
    }
}
