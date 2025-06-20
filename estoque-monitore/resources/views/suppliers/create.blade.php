@extends('layouts.app')

@section('title', 'Novo Fornecedor')

@section('content')
  <h1>Novo Fornecedor</h1>
  <hr>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('fornecedores.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="fantasy_name" class="form-label">Nome Fantasia:*</label>
        <input type="text" class="form-control" name="fantasy_name" value="{{ old('fantasy_name') }}" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="corporate_name" class="form-label">Razão Social:*</label>
        <input type="text" class="form-control" name="corporate_name" value="{{ old('corporate_name') }}" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="document" class="form-label">CPF/CNPJ:*</label>
        <input type="text" class="form-control" name="document" value="{{ old('document') }}" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="phone" class="form-label">Telefone:</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
      </div>
      <div class="col-md-6 mb-3">
        <label for="address" class="form-label">Endereço:</label>
        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
      </div>
    </div>
    <div class="row">
      <div class="col-md-10 mb-3">
        <label for="city" class="form-label">Cidade:*</label>
        <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
      </div>
      <div class="col-md-2 mb-3">
        <label for="state" class="form-label">Estado:*</label>
        <input type="text" class="form-control" name="state" maxlength="2" value="{{ old('state') }}" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="notes" class="form-label">Informações Adicionais:</label>
      <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Gravar Dados</button>
    <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
@endsection
