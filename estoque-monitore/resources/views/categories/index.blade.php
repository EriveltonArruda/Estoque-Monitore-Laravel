<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias</title>
  {{-- Futuramente, podemos adicionar um CSS para deixar mais bonito --}}
</head>

<body>
  <h1>Lista de Categorias</h1>

  @if (session('success'))
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 1rem;">
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('categorias.create') }}">Nova Categoria</a>

  <hr>

  <table border="1" style="width:100%;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <a href="{{ route('categorias.edit', $category->id) }}">Editar</a>
            <form action="{{ route('categorias.destroy', $category) }}" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza que deseja apagar esta categoria? Isso não poderá ser desfeito.');">
              @csrf
              @method('DELETE')
              <button type="submit" style="color: red; border-color: red; cursor: pointer;">Apagar</button>
            </form>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" style="text-align:center;">Nenhuma categoria cadastrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top: 1rem;">
    {{-- Links da paginação --}}
    {{ $categories->links() }}
  </div>

</body>

</html>
