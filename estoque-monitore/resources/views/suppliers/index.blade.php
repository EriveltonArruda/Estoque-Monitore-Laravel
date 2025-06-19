<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF--8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fornecedores</title>
</head>

<body>
  <h1>Lista de Fornecedores</h1>

  <a href="{{ route('fornecedores.create') }}">Novo Fornecedor</a>

  <hr>

  {{-- Bloco para futuras mensagens de sucesso --}}
  @if (session('success'))
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 1rem;">
      {{ session('success') }}
    </div>
  @endif

  <table border="1" style="width:100%;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome Fantasia</th>
        <th>Cidade/Estado</th>
        <th>CPF/CNPJ</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($suppliers as $supplier)
        <tr>
          <td>{{ $supplier->id }}</td>
          <td>{{ $supplier->fantasy_name }}</td>
          <td>{{ $supplier->city }} / {{ $supplier->state }}</td>
          <td>{{ $supplier->document }}</td>
          <td>
            <a href="{{ route('fornecedores.edit', $supplier) }}">Editar</a>
            <form action="{{ route('fornecedores.destroy', $supplier) }}" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza que deseja apagar este fornecedor?');">
              @csrf
              @method('DELETE')
              <button type="submit" style="color: red; border-color: red; cursor: pointer;">Apagar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" style="text-align:center;">Nenhum fornecedor cadastrado.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top: 1rem;">
    {{ $suppliers->links() }}
  </div>

</body>

</html>
