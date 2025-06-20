@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
  <h1>Meu Perfil</h1>
  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      @if (session('status') === 'profile-updated')
        Informações do perfil salvas com sucesso!
      @elseif (session('status') === 'password-updated')
        Senha alterada com sucesso!
      @endif
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <hr>

  {{-- Formulário para atualizar informações do perfil --}}
  <div class="card mb-4">
    <div class="card-header">
      Informações do Perfil
    </div>
    <div class="card-body">
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
            required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control"
            value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
      </form>
    </div>
  </div>

  {{-- Formulário para atualizar a senha --}}
  <div class="card">
    <div class="card-header">
      Alterar Senha
    </div>
    <div class="card-body">
      <form action="{{ route('profile.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="current_password" class="form-label">Senha Atual</label>
          <input type="password" name="current_password" id="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Nova Senha</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Alterar Senha</button>
      </form>
    </div>
  </div>
@endsection
