@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista de Produtos</h1>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo Produto</a>
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
        <th>Ref.</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Estoque</th>
        <th>Preço Venda</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->reference }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->category->name ?? 'Sem Categoria' }}</td>
          <td>{{ $product->stock_quantity }}</td>
          <td>R$ {{ number_format($product->sale_price, 2, ',', '.') }}</td>
          <td>
            <a href="{{ route('produtos.edit', $product) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('produtos.destroy', $product) }}" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center">Nenhum produto cadastrado.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div>
    {{ $products->links() }}
  </div>
@endsection
