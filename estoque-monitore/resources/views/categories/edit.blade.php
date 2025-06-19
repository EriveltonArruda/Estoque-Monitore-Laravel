<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Categoria</title>
</head>

<body>
  <h1>Editar Categoria</h1>

  {{-- Se houver qualquer erro de validação, eles serão mostrados aqui --}}
  @if ($errors->any())
    <div style="color: red;">
      <strong>Opa!</strong> Houve alguns problemas com os dados.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- @dd($category) LINHA DE DEBUG --}}

  <form action="{{ route('categorias.update', $category) }}" method="POST">
    @csrf
    @method('PUT') {{-- Informa ao Laravel que a operação é de atualização --}}
    @csrf

    <div>
      <label for="name">Nome:</label><br>
      <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}">
    </div>
    <br>
    <div>
      <label for="description">Descrição:</label><br>
      <textarea id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
    </div>
    <br>
    <div>
      <button type="submit">Salvar Categoria</button>
      <a href="{{ route('categorias.index') }}">Cancelar</a>
    </div>
  </form>

</body>

</html>
