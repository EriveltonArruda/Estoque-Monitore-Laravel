@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
  <h1>Editar Produto</h1>
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

  <form action="{{ route('produtos.update', $product) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-8 mb-3">
        <label for="name" class="form-label">Nome:*</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="reference" class="form-label">Referência:</label>
        <input type="text" name="reference" class="form-control" value="{{ old('reference', $product->reference) }}">
      </div>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Descrição:</label>
      <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">Categoria:*</label>
        <select name="category_id" class="form-select" required>
          <option value="">Selecione uma Categoria</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"
              {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="unit" class="form-label">Unidade:*</label>
        <input type="text" name="unit" class="form-control" value="{{ old('unit', $product->unit) }}" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="sale_price" class="form-label">Preço Venda:*</label>
        <input type="text" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}"
          required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="minimum_stock_quantity" class="form-label">Estoque Mínimo:*</label>
        <input type="number" name="minimum_stock_quantity" class="form-control"
          value="{{ old('minimum_stock_quantity', $product->minimum_stock_quantity) }}" required>
      </div>
    </div>

    <button type="submit" class="btn btn-success">Salvar Alterações</button>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
@endsection
