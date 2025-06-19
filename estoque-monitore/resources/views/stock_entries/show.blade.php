<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Detalhes da Entrada #{{ $entry->id }}</title>
</head>

<body>
  <h1>Detalhes da Entrada #{{ $entry->id }}</h1>

  <a href="{{ route('entradas.index') }}">Voltar para a Lista</a>
  <hr>

  <h3>Dados Gerais</h3>
  <p>
    <strong>Fornecedor:</strong> {{ $entry->supplier->fantasy_name }}<br>
    <strong>Número da Nota:</strong> {{ $entry->note_number ?? 'N/A' }}<br>
    <strong>Data de Emissão:</strong> {{ \Carbon\Carbon::parse($entry->emission_date)->format('d/m/Y') }}<br>
    <strong>Data da Entrada:</strong> {{ \Carbon\Carbon::parse($entry->entry_date)->format('d/m/Y') }}<br>
    <strong>Valor Total da Nota:</strong> R$ {{ number_format($entry->total_value, 2, ',', '.') }}
  </p>

  <hr>

  <h3>Itens da Entrada</h3>
  <table border="1" style="width:100%;">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço de Custo (un.)</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($entry->items as $item)
        <tr>
          {{-- Aqui usamos a relação aninhada: $item->product->name --}}
          <td>{{ $item->product->name }}</td>
          <td>{{ $item->quantity }}</td>
          <td>R$ {{ number_format($item->purchase_price, 2, ',', '.') }}</td>
          <td>R$ {{ number_format($item->quantity * $item->purchase_price, 2, ',', '.') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" style="text-align:center;">Nenhum item encontrado para esta entrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

</body>

</html>
