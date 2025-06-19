<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Nova Entrada de Estoque</title>
</head>

<body>
  <h1>Nova Entrada no Estoque</h1>

  @if ($errors->any())
    <div style="color: red;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('entradas.store') }}" method="POST">
    @csrf
    {{-- CABEÇALHO DA ENTRADA --}}
    <fieldset>
      <legend>Dados da Entrada</legend>
      <div>
        <label for="supplier_id">Fornecedor:*</label><br>
        <select name="supplier_id" required>
          <option value="">Selecione um Fornecedor</option>
          @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->id }}">{{ $supplier->fantasy_name }}</option>
          @endforeach
        </select>
      </div>
      <br>
      <div>
        <label for="note_number">Número da Nota:</label><br>
        <input type="text" name="note_number">
      </div>
      <br>
      <div>
        <label for="entry_date">Data da Entrada:*</label><br>
        <input type="date" name="entry_date" value="{{ date('Y-m-d') }}" required>
      </div>
      <br>
      <div>
        <label for="emission_date">Data de Emissão (Nota):*</label><br>
        <input type="date" name="emission_date" value="{{ date('Y-m-d') }}" required>
      </div>
      <br>
      <div>
        <label for="entry_date">Data da Entrada (Estoque):*</label><br>
        <input type="date" name="entry_date" value="{{ date('Y-m-d') }}" required>
      </div>
    </fieldset>

    <br>

    {{-- ITENS DA ENTRADA --}}
    <fieldset>
      <legend>Itens da Entrada</legend>
      <table border="1" style="width:100%;">
        <thead>
          <tr>
            <th>Produto*</th>
            <th>Quantidade*</th>
            <th>Preço de Custo (un.)*</th>
            <th>Subtotal</th>
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

    <br>

    <h3>Valor Total da Entrada: <span id="total-value">R$ 0,00</span></h3>

    <hr>
    <button type="submit">Salvar Entrada</button>
    <a href="{{ route('entradas.index') }}">Cancelar</a>
  </form>

  {{-- TEMPLATE PARA A LINHA DE PRODUTO --}}
  {{-- Este bloco fica escondido e serve de modelo para o JavaScript --}}
  <template id="item-row-template">
    <tr>
      <td>
        <select name="product_ids[]" class="product-select" required>
          <option value="">Selecione um Produto</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
          @endforeach
        </select>
      </td>
      <td>
        <input type="number" name="quantities[]" class="item-quantity" value="1" min="1" required
          style="width: 80px;">
      </td>
      <td>
        <input type="text" name="purchase_prices[]" class="item-price" value="0.00" required style="width: 100px;">
      </td>
      <td>
        <span class="item-subtotal">R$ 0,00</span>
      </td>
      <td>
        <button type="button" class="remove-item-btn">Remover</button>
      </td>
    </tr>
  </template>

  {{-- SCRIPT PARA A MÁGICA ACONTECER --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addItemBtn = document.getElementById('add-item-btn');
      const itemsTableBody = document.getElementById('items-table-body');
      const itemRowTemplate = document.getElementById('item-row-template');
      const totalValueSpan = document.getElementById('total-value');

      // Função para adicionar uma nova linha de item
      function addNewItemRow() {
        const newRow = itemRowTemplate.content.cloneNode(true);
        itemsTableBody.appendChild(newRow);
      }

      // Adiciona a primeira linha ao carregar a página
      addNewItemRow();

      // Adiciona uma nova linha ao clicar no botão
      addItemBtn.addEventListener('click', addNewItemRow);

      // Função para remover uma linha de item
      itemsTableBody.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item-btn')) {
          e.target.closest('tr').remove();
          updateTotalValue();
        }
      });

      // Função para calcular totais
      function updateTotalValue() {
        let total = 0;
        itemsTableBody.querySelectorAll('tr').forEach(function(row) {
          const quantity = parseFloat(row.querySelector('.item-quantity').value) || 0;
          const price = parseFloat(row.querySelector('.item-price').value) || 0;
          const subtotal = quantity * price;
          row.querySelector('.item-subtotal').textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');
          total += subtotal;
        });
        totalValueSpan.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
      }

      // Atualiza os totais sempre que a quantidade ou o preço mudar
      itemsTableBody.addEventListener('input', function(e) {
        if (e.target && (e.target.classList.contains('item-quantity') || e.target.classList.contains(
            'item-price'))) {
          updateTotalValue();
        }
      });
    });
  </script>
</body>

</html>
