<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Entradas no Estoque</title>
</head>

<body>
  <h1>Entradas no Estoque</h1>
  <a href="{{ route('entradas.create') }}">Nova Entrada</a>
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
        <th>Nota</th>
        <th>Fornecedor</th>
        <th>Valor Total</th>
        <th>Data da Entrada</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($entries as $entry)
        <tr>
          <td>{{ $entry->id }}</td>
          <td>{{ $entry->note_number }}</td>
          {{-- Aqui usamos a relação para pegar o nome fantasia do fornecedor --}}
          <td>{{ $entry->supplier->fantasy_name ?? 'N/A' }}</td>
          <td>R$ {{ number_format($entry->total_value, 2, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('d/m/Y') }}</td>
          <td>
            <a href="{{ route('entradas.show', $entry) }}">Ver Itens</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center;">Nenhuma entrada registrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top: 1rem;">
    {{ $entries->links() }}
  </div>
</body>

</html>
