<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Nova Saída de Estoque</title>
</head>

<body>
  <h1>Nova Saída no Estoque</h1>

  @if ($errors->any())
    <div style="color: red;">
      <strong>Opa! Verifique os erros abaixo:</strong><br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('saidas.store') }}" method="POST">
    @csrf
    {{-- CABEÇALHO DA SAÍDA --}}
    <fieldset>
      <legend>Dados da Saída</legend>
      <div>
        <label for="type">Tipo de Saída:*</label><br>
        <select name="type" required>
          <option value="">Selecione um tipo</option>
          <option value="Avaria">Avaria</option>
          <option value="Empréstimo">Empréstimo</option>
          <option value="Perda">Perda</option>
          <option value="Uso Interno">Uso Interno</option>
        </select>
      </div>
      <br>
      <div>
        <label for="responsible">Responsável:*</label><br>
        <input type="text" name="responsible" value="{{ old('responsible') }}" required>
      </div>
      <br>
      <div>
        <label for="exit_date">Data da Saída:*</label><br>
        <input type="date" name="exit_date" value="{{ date('Y-m-d') }}" required>
      </div>
    </fieldset>

    <br>

    {{-- ITENS DA SAÍDA --}}
    <fieldset>
      <legend>Itens da Saída</legend>
      <table border="1" style="width:100%;">
        <thead>
          <tr>
            <th>Produto*</th>
            <th>Quantidade*</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody id="items-table-body">
          {{-- As linhas de produto serão adicionadas aqui via JavaScript --}}
        </tbody>
      </table>
      <br>
      <button type="button" id="add-item-btn">Adicionar Produto</button>
    </fieldset>

    <hr>
    <button type="submit">Registrar Saída</button>
    <a href="{{ route('saidas.index') }}">Cancelar</a>
  </form>

  {{-- TEMPLATE PARA A LINHA DE PRODUTO --}}
  <template id="item-row-template">
    <tr>
      <td>
        <select name="product_ids[]" class="product-select" required>
          <option value="">Selecione um Produto</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} (Estoque: {{ $product->stock_quantity }})</option>
          @endforeach
        </select>
      </td>
      <td>
        <input type="number" name="quantities[]" class="item-quantity" value="1" min="1" required
          style="width: 80px;">
      </td>
      <td>
        <button type="button" class="remove-item-btn">Remover</button>
      </td>
    </tr>
  </template>

  {{-- SCRIPT (exatamente o mesmo de antes, mas sem cálculo de valor) --}}
  <script>
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
</body>

</html>
