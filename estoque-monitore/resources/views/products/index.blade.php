<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Produtos</title>
</head>

<body>
  <h1>Lista de Produtos</h1>
  <a href="{{ route('produtos.create') }}">Novo Produto</a>
  <hr>

  @if (session('success'))
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 1rem;">
      {{ session('success') }}
    </div>
  @endif

  <table border="1" style="width:100%;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ref.</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Estoque</th>
        <th>Preço Compra</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->reference }}</td>
          <td>{{ $product->name }}</td>
          {{-- Aqui usamos a relação que criamos para pegar o nome da categoria --}}
          <td>{{ $product->category->name ?? 'Sem Categoria' }}</td>
          <td>{{ $product->stock_quantity }}</td>
          <td>R$ {{ number_format($product->sale_price, 2, ',', '.') }}</td>
          <td>
            <a href="{{ route('produtos.edit', $product) }}">Editar</a>
            <form action="{{ route('produtos.destroy', $product) }}" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza que deseja apagar este produto? Esta ação não pode ser desfeita.');">
              @csrf
              @method('DELETE')
              <button type="submit">Apagar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" style="text-align:center;">Nenhum produto cadastrado.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top: 1rem;">
    {{ $products->links() }}
  </div>
</body>

</html>
