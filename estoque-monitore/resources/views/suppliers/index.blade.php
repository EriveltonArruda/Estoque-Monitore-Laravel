@extends('layouts.app')

@section('title', 'Fornecedores')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista de Fornecedores</h1>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">Novo Fornecedor</a>
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
        <th>Nome Fantasia</th>
        <th>Cidade/Estado</th>
        <th>CPF/CNPJ</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($suppliers as $supplier)
        <tr>
          <td>{{ $supplier->id }}</td>
          <td>{{ $supplier->fantasy_name }}</td>
          <td>{{ $supplier->city }} / {{ $supplier->state }}</td>
          <td>{{ $supplier->document }}</td>
          <td>
            <a href="{{ route('fornecedores.edit', $supplier) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('fornecedores.destroy', $supplier) }}" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center">Nenhum fornecedor cadastrado.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div>
    {{ $suppliers->links() }}
  </div>
@endsection
