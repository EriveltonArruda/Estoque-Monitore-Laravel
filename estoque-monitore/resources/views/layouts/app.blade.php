<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- O @yield('title') é um espaço reservado para o título de cada página --}}
  <title>@yield('title', 'Controle de Estoque')</title>

  {{-- Adicionaremos o CSS do Bootstrap para um visual limpo e profissional --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: row;
      margin: 0;
      background-color: #f4f6f9;
    }

    .sidebar {
      width: 250px;
      background-color: #343a40;
      /* Cinza escuro do print */
      color: white;
      padding: 15px;
      flex-shrink: 0;
    }

    .sidebar a {
      color: #c2c7d0;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      border-radius: 4px;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #494e53;
      color: white;
    }

    .sidebar h5 {
      color: #6c757d;
      text-transform: uppercase;
      font-size: 0.8rem;
      margin-top: 15px;
    }

    .sidebar h3 {
      font-size: 24px;
    }

    .wrapper {
      /* <-- NOVO */
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .main-content {
      /* <-- ALTERADO */
      padding: 20px;
      flex-grow: 1;
    }

    .sidebar .menu {
      font-size: 24px;
    }

    .navbar {
      background-color: #343a40;
    }

    .nav-link {
      color: #fff;
    }
  </style>
</head>

<body>
  {{-- BARRA LATERAL (SIDEBAR) - Sem alterações --}}
  <div class="sidebar">
    <h3>Estoque Monitore</h3>
    <hr style="border-color: #6c757d;">

    <h5>Gerenciamento</h5>
    <a href="{{ route('dashboard') }}">Página Inicial</a>
    <a href="{{ route('produtos.index') }}">Produtos</a>
    <a href="{{ route('categorias.index') }}">Categorias</a>
    <a href="{{ route('fornecedores.index') }}">Fornecedores</a>

    <h5>Movimentação</h5>
    <a href="{{ route('entradas.index') }}">Entradas</a>
    <a href="{{ route('saidas.index') }}">Saídas</a>
  </div>

  {{-- INVÓLUCRO PARA O CONTEÚDO PRINCIPAL E A NAVBAR --}}
  <div class="wrapper">

    {{-- NAVBAR SUPERIOR --}}
    <nav class="navbar navbar-expand-lg border-bottom">
      <div class="container-fluid">
        {{-- O ícone de hamburger pode ser usado no futuro para esconder/mostrar a sidebar --}}
        <span class="navbar-toggler-icon"></span>

        {{-- Este div empurra o conteúdo da direita para a direita --}}
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{-- TODO: Substituir por Auth::user()->name quando o login estiver pronto --}}
                Logado como: <strong>Admin</strong>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                {{-- TODO: Adicionar link para a página de perfil --}}
                <li><a class="dropdown-item" href="#">Meu Perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                {{-- TODO: Adicionar a rota de logout --}}
                <li><a class="dropdown-item" href="#">Sair</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    {{-- CONTEÚDO PRINCIPAL DA PÁGINA --}}
    <main class="main-content">
      @yield('content')
    </main>

  </div>

  {{-- SCRIPTS JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>
