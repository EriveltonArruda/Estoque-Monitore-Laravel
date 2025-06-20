<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller {
    /**
     * Mostra o formulário de edição do perfil do usuário.
     */
    public function edit(Request $request) {
        return view('profiles.edit', [
            // Pega o usuário autenticado diretamente do objeto Request
            'user' => $request->user(),
        ]);
    }

    /**
     * Atualiza as informações de nome e email do usuário.
     */
    public function update(Request $request) {
        // Pega o usuário autenticado
        $user = $request->user();

        // Valida os dados, com uma regra especial para o email
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        // Atualiza os dados do usuário com os dados validados
        $user->update($validatedData);

        // Redireciona de volta para a página de perfil com uma mensagem de status
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Atualiza a senha do usuário.
     */
    public function updatePassword(Request $request) {
        // Valida os dados, incluindo a verificação da senha atual
        $validatedData = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Atualiza a senha do usuário com a nova senha criptografada
        $request->user()->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redireciona de volta com uma mensagem de status
        return redirect()->route('profile.edit')->with('status', 'password-updated');
    }
}
