<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Novo Fornecedor</title>
</head>

<body>
  <h1>Novo Fornecedor</h1>

  @if ($errors->any())
    <div style="color: red;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('fornecedores.store') }}" method="POST">
    @csrf
    <div style="display: flex; gap: 20px;">
      <div>
        <label for="fantasy_name">Nome Fantasia:*</label><br>
        <input type="text" name="fantasy_name" value="{{ old('fantasy_name') }}" required>
      </div>
      <div>
        <label for="corporate_name">Razão Social:*</label><br>
        <input type="text" name="corporate_name" value="{{ old('corporate_name') }}" required>
      </div>
    </div>
    <br>
    <div style="display: flex; gap: 20px;">
      <div>
        <label for="document">CPF/CNPJ:*</label><br>
        <input type="text" name="document" value="{{ old('document') }}" required>
      </div>
      <div>
        <label for="email">E-mail:</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
      </div>
    </div>
    <br>
    <div style="display: flex; gap: 20px;">
      <div>
        <label for="phone">Telefone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}">
      </div>
      <div>
        <label for="address">Endereço:</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
      </div>
    </div>
    <br>
    <div style="display: flex; gap: 20px;">
      <div>
        <label for="city">Cidade:*</label><br>
        <input type="text" name="city" value="{{ old('city') }}" required>
      </div>
      <div>
        <label for="state">Estado:*</label><br>
        <input type="text" name="state" maxlength="2" value="{{ old('state') }}" required>
      </div>
    </div>
    <br>
    <div>
      <label for="notes">Informações Adicionais:</label><br>
      <textarea name="notes" rows="4" style="width: 400px;">{{ old('notes') }}</textarea>
    </div>
    <br>
    <button type="submit">Gravar Dados</button>
    <a href="{{ route('fornecedores.index') }}">Cancelar</a>
  </form>
</body>

</html>
