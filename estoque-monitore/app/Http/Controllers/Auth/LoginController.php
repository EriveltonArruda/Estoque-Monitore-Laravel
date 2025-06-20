<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        // 1. Validação dos dados do formulário
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tenta autenticar o usuário
        if (Auth::attempt($credentials)) {
            // 3a. Se a autenticação for bem-sucedida...

            // Regenera a sessão para segurança contra "session fixation"
            $request->session()->regenerate();

            // Redireciona para a página que o usuário tentou acessar antes,
            // ou para o dashboard como padrão.
            return redirect()->intended(route('dashboard'));
        }

        // 3b. Se a autenticação falhar...
        // Volta para a página anterior (o form de login) com uma mensagem de erro.
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    /**
     * Faz o logout do usuário autenticado.
     */
    public function destroy(Request $request) {
        // Usa o guardião 'web' para fazer o logout
        Auth::guard('web')->logout();

        // Invalida a sessão do usuário
        $request->session()->invalidate();

        // Gera um novo token CSRF para a próxima sessão (por segurança)
        $request->session()->regenerateToken();

        // Redireciona o usuário para a página de login
        return redirect('/login');
    }
}
