<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Saídas no Estoque</title>
</head>

<body>
  <h1>Saídas no Estoque</h1>
  <a href="{{ route('saidas.create') }}">Nova Saída</a>
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
        <th>Tipo</th>
        <th>Responsável</th>
        <th>Valor Total</th>
        <th>Data da Saída</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($exits as $exit)
        <tr>
          <td>{{ $exit->id }}</td>
          <td>{{ $exit->type }}</td>
          <td>{{ $exit->responsible }}</td>
          <td>R$ {{ number_format($exit->total_value, 2, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($exit->exit_date)->format('d/m/Y') }}</td>
          <td>
            <a href="#">Ver Itens</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center;">Nenhuma saída registrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top: 1rem;">
    {{ $exits->links() }}
  </div>
</body>

</html>
