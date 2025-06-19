<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Novo Produto</title>
</head>

<body>
  <h1>Novo Produto</h1>

  @if ($errors->any())
    <div style="color: red;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('produtos.store') }}" method="POST">
    @csrf
    <div>
      <label for="reference">Referência:</label><br>
      <input type="text" name="reference" value="{{ old('reference') }}">
    </div>
    <br>
    <div>
      <label for="name">Nome:*</label><br>
      <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <br>
    <div>
      <label for="description">Descrição:</label><br>
      <textarea name="description" rows="3" style="width: 400px;">{{ old('description') }}</textarea>
    </div>
    <br>
    <div style="display: flex; gap: 20px;">
      <div>
        <label for="category_id">Categoria:*</label><br>
        <select name="category_id" required>
          <option value="">Selecione uma Categoria</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div>
        <label for="unit">Unidade:*</label><br>
        <input type="text" name="unit" value="{{ old('unit', 'UN') }}" required>
      </div>
    </div>
    <br>
    <div style="display: flex; gap: 20px;">
      <div>
        <label for="minimum_stock_quantity">Estoque Mínimo:*</label><br>
        <input type="number" name="minimum_stock_quantity" value="{{ old('minimum_stock_quantity', 0) }}" required>
      </div>
      <div>
        <label for="sale_price">Preço Compra:*</label><br>
        <input type="text" name="sale_price" value="{{ old('sale_price', '0.00') }}" required>
      </div>
    </div>
    <br>
    <button type="submit">Gravar Produto</button>
    <a href="{{ route('produtos.index') }}">Cancelar</a>
  </form>
</body>

</html>
