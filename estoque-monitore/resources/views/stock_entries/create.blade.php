@extends('layouts.app')

@section('title', 'Nova Entrada de Estoque')

@section('content')
  <h1>Nova Entrada no Estoque</h1>
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

  <form action="{{ route('entradas.store') }}" method="POST">
    @csrf
    <div class="card mb-3">
      <div class="card-header">Dados da Entrada</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="supplier_id" class="form-label">Fornecedor:*</label>
            <select name="supplier_id" class="form-select" required>
              <option value="">Selecione um Fornecedor</option>
              @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->fantasy_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="note_number" class="form-label">Número da Nota:</label>
            <input type="text" name="note_number" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="emission_date" class="form-label">Data de Emissão (Nota):*</label>
            <input type="date" name="emission_date" class="form-control" value="{{ date('Y-m-d') }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="entry_date" class="form-label">Data da Entrada (Estoque):*</label>
            <input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Itens da Entrada</div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Produto*</th>
              <th>Quantidade*</th>
              <th>Preço de Custo (un.)*</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="items-table-body"></tbody>
        </table>
        <button type="button" id="add-item-btn" class="btn btn-secondary mt-2">Adicionar Produto</button>
      </div>
    </div>

    <hr>
    <button type="submit" class="btn btn-success">Salvar Entrada</button>
    <a href="{{ route('entradas.index') }}" class="btn btn-light">Cancelar</a>
  </form>

  <template id="item-row-template">
    <tr>
      <td>
        <select name="product_ids[]" class="form-select product-select" required>
          <option value="">Selecione um Produto</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
          @endforeach
        </select>
      </td>
      <td><input type="number" name="quantities[]" class="form-control item-quantity" value="1" min="1"
          required></td>
      <td><input type="text" name="purchase_prices[]" class="form-control item-price" value="0.00" required></td>
      <td><button type="button" class="btn btn-danger btn-sm remove-item-btn">Remover</button></td>
    </tr>
  </template>

  <script>
    // O JavaScript continua o mesmo, não precisa alterar
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
