@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
  <h1>Editar Categoria</h1>
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

  <form action="{{ route('categorias.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="name" class="form-label">Nome:</label>
      <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Descrição:</label>
      <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar Alterações</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
@endsection
