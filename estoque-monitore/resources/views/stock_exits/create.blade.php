@extends('layouts.app')

@section('title', 'Nova Saída de Estoque')

@section('content')
  <h1>Nova Saída no Estoque</h1>
  <hr>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Opa! Verifique os erros abaixo:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('saidas.store') }}" method="POST">
    @csrf
    <div class="card mb-3">
      <div class="card-header">Dados da Saída</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="type" class="form-label">Tipo de Saída:*</label>
            <select name="type" class="form-select" required>
              <option value="">Selecione um tipo</option>
              <option value="Avaria" {{ old('type') == 'Avaria' ? 'selected' : '' }}>Avaria</option>
              <option value="Empréstimo" {{ old('type') == 'Empréstimo' ? 'selected' : '' }}>Empréstimo</option>
              <option value="Perda" {{ old('type') == 'Perda' ? 'selected' : '' }}>Perda</option>
              <option value="Uso Interno" {{ old('type') == 'Uso Interno' ? 'selected' : '' }}>Uso Interno</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label for="responsible" class="form-label">Responsável:*</label>
            <input type="text" name="responsible" class="form-control" value="{{ old('responsible') }}" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="exit_date" class="form-label">Data da Saída:*</label>
            <input type="date" name="exit_date" class="form-control" value="{{ date('Y-m-d') }}" required>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Itens da Saída</div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Produto*</th>
              <th>Quantidade*</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="items-table-body"></tbody>
        </table>
        <button type="button" id="add-item-btn" class="btn btn-secondary mt-2">Adicionar Produto</button>
      </div>
    </div>

    <hr>
    <button type="submit" class="btn btn-success">Registrar Saída</button>
    <a href="{{ route('saidas.index') }}" class="btn btn-light">Cancelar</a>
  </form>

  <template id="item-row-template">
    <tr>
      <td>
        <select name="product_ids[]" class="form-select product-select" required>
          <option value="">Selecione um Produto</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} (Estoque: {{ $product->stock_quantity }})</option>
          @endforeach
        </select>
      </td>
      <td><input type="number" name="quantities[]" class="form-control item-quantity" value="1" min="1"
          required></td>
      <td><button type="button" class="btn btn-danger btn-sm remove-item-btn">Remover</button></td>
    </tr>
  </template>

  <script>
    // O JavaScript continua o mesmo
    document.addEventListener('DOMContentLoaded', function() {
      const addItemBtn = document.getElementById('add-item-btn');
      const itemsTableBody = document.getElementById('items-table-body');
      const itemRowTemplate = document.getElementById('item-row-template');

      function addNewItemRow() {
        const newRow = itemRowTemplate.content.cloneNode(true);
        itemsTableBody.appendChild(newRow);
      }

      addNewItemRow();

      addItemBtn.addEventListener('click', addNewItemRow);

      itemsTableBody.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item-btn')) {
          e.target.closest('tr').remove();
        }
      });
    });
  </script>
@endsection
