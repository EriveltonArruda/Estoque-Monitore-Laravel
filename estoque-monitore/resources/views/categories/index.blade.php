@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista de Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nova Categoria</a>
  </div>

  <hr>

  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <a href="{{ route('categorias.edit', $category) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('categorias.destroy', $category) }}" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center">Nenhuma categoria cadastrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div>
    {{ $categories->links() }}
  </div>
@endsection
